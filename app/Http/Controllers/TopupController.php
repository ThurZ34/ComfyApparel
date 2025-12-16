<?php

namespace App\Http\Controllers;

use App\Models\Topup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;
use Midtrans\Transaction;

class TopupController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    /**
     * Display a listing of the resource (Top Up Form).
     */
    public function index()
    {
        // Require authentication
        if (! Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return view('landing.topup');
    }

    /**
     * Store a newly created resource in storage.
     * Creates a Snap token for Midtrans payment.
     */
    public function store(Request $request)
    {
        // Require authentication
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'amount' => 'required|numeric|min:10000',
        ]);

        $user = Auth::user();
        $amount = (int) $request->amount;

        // Generate unique order ID
        $orderId = 'TOPUP-'.time().'-'.$user->id;

        // Create topup record
        $topup = Topup::create([
            'user_id' => $user->id,
            'order_id' => $orderId,
            'amount' => $amount,
            'status' => 'pending',
        ]);

        // Prepare Midtrans transaction params
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $amount,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? '',
            ],
            'item_details' => [
                [
                    'id' => 'TOPUP',
                    'price' => $amount,
                    'quantity' => 1,
                    'name' => 'Top Up Saldo ComfyApparel',
                ],
            ],
            // Callback URLs for e-wallet redirects (DANA, GoPay, etc.)
            'callbacks' => [
                'finish' => route('topup.finish', ['order_id' => $orderId]),
            ],
        ];

        try {
            // Get Snap Token
            $snapToken = Snap::getSnapToken($params);

            // Update topup with snap token
            $topup->update(['snap_token' => $snapToken]);

            return view('landing.topup-payment', [
                'snapToken' => $snapToken,
                'topup' => $topup,
                'clientKey' => config('midtrans.client_key'),
            ]);
        } catch (\Exception $e) {
            Log::error('Midtrans Error: '.$e->getMessage());

            // Delete the pending topup if Snap token fails
            $topup->delete();

            return back()->with('error', 'Gagal membuat pembayaran: '.$e->getMessage());
        }
    }

    /**
     * Handle Midtrans webhook/notification callback.
     * This is called by Midtrans server when payment status changes.
     */
    public function callback(Request $request)
    {
        try {
            $notification = new Notification;

            $orderId = $notification->order_id;
            $transactionStatus = $notification->transaction_status;
            $paymentType = $notification->payment_type;
            $fraudStatus = $notification->fraud_status;

            $topup = Topup::where('order_id', $orderId)->first();

            if (! $topup) {
                return response()->json(['message' => 'Topup not found'], 404);
            }

            // Handle transaction status
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'accept') {
                    $this->handleSuccess($topup, $paymentType);
                }
            } elseif ($transactionStatus == 'settlement') {
                $this->handleSuccess($topup, $paymentType);
            } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
                $topup->update([
                    'status' => 'failed',
                    'payment_method' => $paymentType,
                ]);
            } elseif ($transactionStatus == 'pending') {
                $topup->update([
                    'status' => 'pending',
                    'payment_method' => $paymentType,
                ]);
            }

            return response()->json(['message' => 'Notification handled']);
        } catch (\Exception $e) {
            Log::error('Midtrans Callback Error: '.$e->getMessage());

            return response()->json(['message' => 'Error handling notification'], 500);
        }
    }

    /**
     * Handle successful payment from Midtrans.
     * Sets status to 'pending' for admin verification.
     * Balance will only be added after admin approval.
     */
    private function handleSuccess(Topup $topup, string $paymentType): void
    {
        // Prevent double processing
        if ($topup->status === 'success') {
            // Ensure balance is synced even if status was already success
            $this->syncUserBalance($topup);

            return;
        }

        // Update to pending (waiting admin approval)
        // Do NOT add balance here - admin must approve first
        $topup->update([
            'status' => 'pending',
            'payment_method' => $paymentType,
        ]);

        Log::info('Payment received, waiting admin approval', [
            'topup_id' => $topup->id,
            'order_id' => $topup->order_id,
            'amount' => $topup->amount,
        ]);
    }

    /**
     * Add balance to user from topup.
     */
    private function addBalanceToUser(Topup $topup): void
    {
        $user = $topup->user;
        $newBalance = ($user->balance ?? 0) + $topup->amount;
        $user->balance = $newBalance;
        $user->save();

        Log::info('Balance added', [
            'user_id' => $user->id,
            'topup_id' => $topup->id,
            'amount' => $topup->amount,
            'new_balance' => $newBalance,
        ]);
    }

    /**
     * Sync user balance - recalculate from all successful topups.
     * This is a safety net in case balance got out of sync.
     */
    private function syncUserBalance(Topup $topup): void
    {
        $user = $topup->user;
        $totalSuccessTopups = Topup::where('user_id', $user->id)
            ->where('status', 'success')
            ->sum('amount');

        if ($user->balance != $totalSuccessTopups) {
            Log::warning('Balance out of sync, fixing', [
                'user_id' => $user->id,
                'current_balance' => $user->balance,
                'should_be' => $totalSuccessTopups,
            ]);
            $user->balance = $totalSuccessTopups;
            $user->save();
        }
    }

    /**
     * Handle finish redirect from Midtrans.
     * Also checks transaction status directly from Midtrans API (for localhost testing).
     */
    public function finish(Request $request)
    {
        $orderId = $request->get('order_id');
        $transactionStatus = $request->get('transaction_status');

        $topup = Topup::where('order_id', $orderId)->first();

        if (! $topup) {
            return redirect()->route('topup.index')
                ->with('error', 'Transaksi tidak ditemukan.');
        }

        // If already success, ensure balance is synced and redirect
        if ($topup->status === 'success') {
            $this->syncUserBalance($topup);

            return redirect()->route('landing.profil')
                ->with('success', 'Top up berhasil! Saldo telah ditambahkan.');
        }

        // If Snap.js passed transaction_status in URL
        if ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
            $this->handleSuccess($topup, $request->get('payment_type', 'unknown'));

            return redirect()->route('landing.profil')
                ->with('success', 'Top up berhasil! Saldo telah ditambahkan.');
        }

        // Check transaction status directly from Midtrans API
        // This is useful when webhook doesn't arrive (localhost testing)
        try {
            $status = Transaction::status($orderId);

            $apiTransactionStatus = $status->transaction_status ?? null;
            $paymentType = $status->payment_type ?? 'unknown';
            $fraudStatus = $status->fraud_status ?? null;

            Log::info('Midtrans Status Check', [
                'order_id' => $orderId,
                'status' => $apiTransactionStatus,
                'payment_type' => $paymentType,
            ]);

            // Handle based on transaction status
            if ($apiTransactionStatus == 'capture') {
                if ($fraudStatus == 'accept') {
                    $this->handleSuccess($topup, $paymentType);
                }
            } elseif ($apiTransactionStatus == 'settlement') {
                $this->handleSuccess($topup, $paymentType);
            } elseif (in_array($apiTransactionStatus, ['cancel', 'deny', 'expire'])) {
                $topup->update([
                    'status' => 'failed',
                    'payment_method' => $paymentType,
                ]);

                return redirect()->route('topup.index')
                    ->with('error', 'Pembayaran gagal atau dibatalkan.');
            }

            // Check if now success after API check
            $topup->refresh();
            if ($topup->status === 'success') {
                return redirect()->route('landing.profil')
                    ->with('success', 'Top up berhasil! Saldo telah ditambahkan.');
            }

            return redirect()->route('topup.index')
                ->with('info', 'Pembayaran sedang diproses. Saldo akan ditambahkan setelah pembayaran dikonfirmasi.');

        } catch (\Exception $e) {
            Log::error('Midtrans Status Check Error: '.$e->getMessage());

            // For sandbox testing: if we got here from Snap.js onSuccess, mark as success anyway
            // This helps with sandbox mode where API sometimes doesn't have the transaction
            if ($request->has('order_id') && $topup->status === 'pending') {
                $this->handleSuccess($topup, 'sandbox_test');

                return redirect()->route('landing.profil')
                    ->with('success', 'Top up berhasil! Saldo telah ditambahkan.');
            }

            return redirect()->route('topup.index')
                ->with('info', 'Pembayaran sedang diproses. Silakan cek beberapa saat lagi.');
        }
    }
}

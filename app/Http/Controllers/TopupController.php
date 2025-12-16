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
     * Handle successful payment - update topup status and user balance.
     */
    private function handleSuccess(Topup $topup, string $paymentType): void
    {
        // Prevent double processing
        if ($topup->status === 'success') {
            return;
        }

        $topup->update([
            'status' => 'success',
            'payment_method' => $paymentType,
        ]);

        // Add balance to user
        $user = $topup->user;
        $user->update([
            'balance' => ($user->balance ?? 0) + $topup->amount,
        ]);
    }

    /**
     * Handle finish redirect from Midtrans.
     */
    public function finish(Request $request)
    {
        $orderId = $request->get('order_id');
        $topup = Topup::where('order_id', $orderId)->first();

        if ($topup && $topup->status === 'success') {
            return redirect()->route('landing.profil')
                ->with('success', 'Top up berhasil! Saldo telah ditambahkan.');
        }

        return redirect()->route('topup.index')
            ->with('info', 'Pembayaran sedang diproses. Saldo akan ditambahkan setelah pembayaran dikonfirmasi.');
    }
}

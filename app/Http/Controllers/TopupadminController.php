<?php

namespace App\Http\Controllers;

use App\Models\Topup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TopupadminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        $topups = Topup::with('user')
            ->when($query, function ($q) use ($query) {
                return $q->where('order_id', 'LIKE', "%$query%")
                    ->orWhereHas('user', function ($userQuery) use ($query) {
                        $userQuery->where('name', 'LIKE', "%$query%")
                            ->orWhere('email', 'LIKE', "%$query%");
                    });
            })
            ->latest()
            ->get();

        return view('admin.topup.index', compact('topups'));
    }

    /**
     * Update the specified resource in storage.
     * Admin approves or rejects topup here.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:pending,success,failed',
        ]);

        $topup = Topup::findOrFail($id);
        $oldStatus = $topup->status;
        $newStatus = $request->status;

        // Update status
        $topup->status = $newStatus;
        $topup->save();

        // If admin approves (change to success), add balance to user
        if ($newStatus === 'success' && $oldStatus !== 'success') {
            $user = $topup->user;
            $user->balance = ($user->balance ?? 0) + $topup->amount;
            $user->save();

            Log::info('Admin approved topup, balance added', [
                'topup_id' => $topup->id,
                'user_id' => $user->id,
                'amount' => $topup->amount,
                'new_balance' => $user->balance,
            ]);

            return redirect()->route('topup-admin.index')
                ->with('success', 'Top up disetujui! Saldo telah ditambahkan ke akun user.');
        }

        // If rejected
        if ($newStatus === 'failed') {
            Log::info('Admin rejected topup', [
                'topup_id' => $topup->id,
                'order_id' => $topup->order_id,
            ]);

            return redirect()->route('topup-admin.index')
                ->with('success', 'Top up ditolak.');
        }

        return redirect()->route('topup-admin.index')
            ->with('success', 'Status top up berhasil diupdate.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

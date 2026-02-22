<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // 1. Daftar Semua Pesanan
    public function index()
    {
        // Ambil data transaksi, urutkan yang terbaru di atas
        $transactions = Transaction::with(['user', 'package'])->latest()->get();
        return view('admin.transactions.index', compact('transactions'));
    }

    // 2. Lihat Detail & Bukti Bayar
    public function show(Transaction $transaction)
    {
        return view('admin.transactions.show', compact('transaction'));
    }

    // 3. Proses Validasi (Approve/Reject)
    public function update(Request $request, Transaction $transaction)
    {
        // Validasi input cuma boleh 'approved' atau 'rejected'
        $request->validate([
            'status' => 'required|in:approved,rejected'
        ]);

        $transaction->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Status transaksi berhasil diperbarui!');
    }
}

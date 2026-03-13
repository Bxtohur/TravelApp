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
        $transactions = Transaction::with(["user", "package"])
            ->latest()
            ->get();
        return view("admin.transactions.index", compact("transactions"));
    }

    // 2. Lihat Detail & Bukti Bayar
    public function show(Transaction $transaction)
    {
        return view("admin.transactions.show", compact("transaction"));
    }

    // 3. Proses Validasi (Approve/Reject)
    public function update(Request $request, Transaction $transaction)
    {
        // Validasi input cuma boleh 'approved' atau 'rejected'
        $request->validate([
            "status" => "required|in:approved,rejected",
        ]);

        // LOGIKA PENAMBAHAN POIN
        // Cek: Jika request minta 'approved' DAN status sebelumnya BUKAN 'approved'
        if (
            $request->status === "approved" &&
            $transaction->status !== "approved"
        ) {
            $user = $transaction->user;
            $user->points += 10; // Tambah 10 poin
            $user->save();
        }

        // LOGIKA PENGURANGAN POIN (Opsional & Keamanan)
        // Cek: Jika sebelumnya sudah 'approved' (poin sudah masuk), tapi tiba-tiba admin merubahnya jadi 'rejected'
        if (
            $request->status === "rejected" &&
            $transaction->status === "approved"
        ) {
            $user = $transaction->user;
            // Tarik kembali 10 poinnya agar tidak minus jika poinnya kurang dari 10
            if ($user->points >= 10) {
                $user->points -= 10;
                $user->save();
            }
        }

        // Update status transaksi
        $transaction->update([
            "status" => $request->status,
        ]);

        return redirect()
            ->route("admin.transactions.index")
            ->with("success", "Status transaksi berhasil diperbarui!");
    }
}

<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    // 1. Simpan Pesanan Baru
    public function store(Request $request, Package $package)
    {
        $request->validate([
            "tour_date" => "required|date|after:today",
            "pax_count" => "required|integer|min:1",
        ]);

        $totalPrice = $package->price * $request->pax_count;

        $transaction = Transaction::create([
            "user_id" => Auth::id(),
            "package_id" => $package->id,
            "tour_date" => $request->tour_date,
            "pax_count" => $request->pax_count,
            "total_price" => $totalPrice,
            "status" => "pending",
        ]);

        return redirect()
            ->route("customer.transactions.show", $transaction->id)
            ->with("success", "Booking berhasil! Silakan lakukan pembayaran.");
    }

    // 2. List Riwayat Pesanan
    public function index()
    {
        $transactions = Transaction::where("user_id", Auth::id())
            ->with("package")
            ->latest()
            ->get();
        return view("customer.transactions.index", compact("transactions"));
    }

    // 3. Halaman Pembayaran (Detail Transaksi)
    public function show(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }
        return view("customer.transactions.show", compact("transaction"));
    }

    // 4. Upload Bukti Bayar
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            "payment_proof" => "required|image|mimes:jpeg,png,jpg|max:2048",
        ]);

        if ($request->hasFile("payment_proof")) {
            $path = $request
                ->file("payment_proof")
                ->store("payment_proofs", "public");

            $transaction->update([
                "payment_proof" => $path,
                "status" => "waiting_approval",
            ]);
        }

        return redirect()
            ->route("customer.transactions.index")
            ->with(
                "success",
                "Bukti pembayaran berhasil diupload! Tunggu konfirmasi admin.",
            );
    }

    // 5. Halaman Cetak/Lihat Invoice
    public function invoice(Transaction $transaction)
    {
        // Pastikan yang buka cuma pemilik transaksi
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        // Load view HTML dan masukkan datanya ke dalam PDF
        $pdf = Pdf::loadView(
            "customer.transactions.invoice",
            compact("transaction"),
        );

        // Atur ukuran kertas (opsional, defaultnya A4)
        $pdf->setPaper("A4", "portrait");

        // Kembalikan response berupa paksaan download file PDF
        return $pdf->download(
            "Invoice-INV-" .
                str_pad($transaction->id, 5, "0", STR_PAD_LEFT) .
                ".pdf",
        );
    }
}

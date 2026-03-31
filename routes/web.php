<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Customer\PackageController as CustomerPackageController;
use App\Models\Transaction;
use App\Models\Package;
use App\Http\Controllers\Customer\TransactionController as CustomerTransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\ReportController as OwnerReportController;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Auth;

Route::get("/", function () {
    // Ambil 3 paket buat ditampilkan di halaman depan
    $packages = Package::take(3)->get();
    return view("welcome", compact("packages"));
});

Route::get("/dashboard", function () {
    $user = Auth::user();

    // JIKA ADMIN ATAU OWNER -> Tampilkan Statistik
    if ($user->role === "admin" || $user->role === "owner") {
        $stats = [
            "income" => Transaction::where("status", "approved")->sum("total_price"),
            "pending" => Transaction::where("status", "waiting_approval")->count(),
            "packages" => Package::count(),
            "customers" => \App\Models\User::where("role", "customer")->count(),
        ];

        // Ambil 5 transaksi terbaru (Semua status)
        $recentTransactions = Transaction::with(["user", "package"])
            ->latest()
            ->take(5)
            ->get();

        // --- LOGIKA LAPORAN BULANAN DETAIL ---
        $selectedMonth = request('month', date('m')); // Default bulan ini
        $selectedYear = request('year', date('Y'));   // Default tahun ini

        // Query transaksi khusus bulan & tahun yang dipilih (Hanya yang Lunas/Selesai)
        $monthlyTransactions = Transaction::with(["user", "package"])
            ->where('status', 'approved')
            ->whereMonth('created_at', $selectedMonth)
            ->whereYear('created_at', $selectedYear)
            ->latest()
            ->get();

        // Hitung total untuk laporan bulan tersebut
        $monthlyStats = [
            'income' => $monthlyTransactions->sum('total_price'),
            'trx_count' => $monthlyTransactions->count(),
            'pax_count' => $monthlyTransactions->sum('pax_count'),
        ];

        return view("dashboard", compact(
            "stats", 
            "recentTransactions", 
            "monthlyTransactions", 
            "monthlyStats", 
            "selectedMonth", 
            "selectedYear"
        ));
    }

    // JIKA CUSTOMER -> Tampilkan Riwayat Trip
    else {
        $myTransactions = Transaction::where("user_id", $user->id)
            ->with("package")
            ->latest()
            ->take(3)
            ->get();

        return view("dashboard", compact("myTransactions"));
    }
})
    ->middleware(["auth", "verified"])
    ->name("dashboard");

Route::get("/dashboard/export", function () {
    $user = Auth::user();

    // Pastikan hanya admin/owner yang bisa akses
    if ($user->role !== "admin" && $user->role !== "owner") {
        abort(403, 'Unauthorized action.');
    }

    $selectedMonth = request('month', date('m'));
    $selectedYear = request('year', date('Y'));

    // Ambil data sesuai bulan & tahun yang difilter
    $monthlyTransactions = Transaction::with(["user", "package"])
        ->where('status', 'approved')
        ->whereMonth('created_at', $selectedMonth)
        ->whereYear('created_at', $selectedYear)
        ->latest()
        ->get();

    $fileName = "Laporan_Brookal_Travel_{$selectedMonth}_{$selectedYear}.xlsx";

    // Langsung generate & download Excel
    return (new FastExcel($monthlyTransactions))->download($fileName, function ($trx) {
        return [
            'Tanggal Transaksi' => $trx->created_at->format('d M Y'),
            'Pelanggan'         => $trx->user->name,
            'Paket Wisata'      => $trx->package->name,
            'Pax'               => $trx->pax_count,
            'Nominal (Rp)'      => $trx->total_price,
        ];
    });
})
    ->middleware(["auth", "verified"])
    ->name("dashboard.export");


// --- GROUP ROUTE KHUSUS ADMIN ---
Route::middleware(["auth"])
    ->prefix("admin")
    ->name("admin.")
    ->group(function () {
        // Kelola Paket Wisata
        Route::resource("packages", AdminPackageController::class);
        // Validasi Transaksi
        Route::resource(
            "transactions",
            AdminTransactionController::class,
        )->only(["index", "update", "show"]);
    });

// --- GROUP ROUTE KHUSUS CUSTOMER ---
Route::middleware(["auth"])
    ->prefix("customer")
    ->name("customer.")
    ->group(function () {
        // 1. Katalog & Detail Paket
        Route::get("/packages", [
            CustomerPackageController::class,
            "index",
        ])->name("packages.index");
        Route::get("/package/{package:slug}", [
            CustomerPackageController::class,
            "show",
        ])->name("packages.show");

        // 2. Proses Booking (Simpan Pesanan)
        Route::post("/book/{package}", [
            CustomerTransactionController::class,
            "store",
        ])->name("transactions.store");

        // 3. Riwayat & Bayar
        Route::get("/transactions", [
            CustomerTransactionController::class,
            "index",
        ])->name("transactions.index"); // List Pesanan
        Route::get("/transactions/{transaction}", [
            CustomerTransactionController::class,
            "show",
        ])->name("transactions.show"); // Halaman Bayar
        Route::patch("/transactions/{transaction}", [
            CustomerTransactionController::class,
            "update",
        ])->name("transactions.update"); // Upload Bukti
        Route::get("/transactions/{transaction}/invoice", [
            CustomerTransactionController::class,
            "invoice",
        ])->name("transactions.invoice"); // Invoice
    });

Route::middleware(["auth"])
    ->prefix("owner")
    ->name("owner.")
    ->group(function () {
        Route::get("/reports", [OwnerReportController::class, "index"])->name(
            "reports.index",
        );
    });

Route::middleware("auth")->group(function () {
    Route::get("/profile", [ProfileController::class, "edit"])->name(
        "profile.edit",
    );
    Route::patch("/profile", [ProfileController::class, "update"])->name(
        "profile.update",
    );
    Route::delete("/profile", [ProfileController::class, "destroy"])->name(
        "profile.destroy",
    );
});

require __DIR__ . "/auth.php";

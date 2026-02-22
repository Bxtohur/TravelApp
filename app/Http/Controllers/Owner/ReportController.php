<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil input tanggal dari form filter
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // 2. Query Dasar: Hanya ambil yang statusnya APPROVED (Uang sudah masuk)
        $query = Transaction::with(['user', 'package'])
                    ->where('status', 'approved');

        // 3. Jika ada filter tanggal, tambahkan kondisi
        if ($startDate && $endDate) {
            $query->whereBetween('tour_date', [$startDate, $endDate]);
        }

        // 4. Eksekusi Query
        $transactions = $query->latest()->get();

        // 5. Hitung Total Pemasukan dari data yang difilter
        $totalRevenue = $transactions->sum('total_price');

        return view('owner.reports.index', compact('transactions', 'totalRevenue', 'startDate', 'endDate'));
    }
}

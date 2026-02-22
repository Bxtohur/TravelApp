<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight print:hidden">
            {{ __('Laporan Keuangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-6 print:hidden">
                <form action="{{ route('owner.reports.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                    <div class="w-full md:w-1/3">
                        <label class="block text-sm font-bold text-gray-700 mb-1">Dari Tanggal</label>
                        <input type="date" name="start_date" value="{{ $startDate }}" class="w-full rounded-lg border-gray-300 focus:ring-primary-600 focus:border-primary-600">
                    </div>
                    <div class="w-full md:w-1/3">
                        <label class="block text-sm font-bold text-gray-700 mb-1">Sampai Tanggal</label>
                        <input type="date" name="end_date" value="{{ $endDate }}" class="w-full rounded-lg border-gray-300 focus:ring-primary-600 focus:border-primary-600">
                    </div>
                    <div class="w-full md:w-auto flex gap-2">
                        <button type="submit" class="bg-primary-600 text-white px-6 py-2.5 rounded-lg font-bold hover:bg-primary-700 transition">
                            Filter
                        </button>
                        <button type="button" onclick="window.print()" class="bg-gray-800 text-white px-6 py-2.5 rounded-lg font-bold hover:bg-gray-900 transition flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            Cetak
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden p-8 print:shadow-none print:border-none print:p-0">
                
                <div class="hidden print:block text-center mb-8 border-b-2 border-gray-800 pb-4">
                    <h1 class="text-3xl font-bold uppercase tracking-widest">PT. Brookal Sukses Abadi</h1>
                    <p class="text-sm text-gray-600">Jalan Wisata Indah No. 123, Jakarta, Indonesia</p>
                    <p class="text-sm text-gray-600">Telp: 0812-3456-7890 | Email: admin@brookaltravel.com</p>
                </div>

                <div class="flex justify-between items-end mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Laporan Transaksi</h3>
                        @if($startDate && $endDate)
                            <p class="text-sm text-gray-500">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
                        @else
                            <p class="text-sm text-gray-500">Periode: Semua Waktu</p>
                        @endif
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Total Pemasukan</p>
                        <p class="text-3xl font-bold text-primary-600 print:text-black">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600 border border-gray-200">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 print:bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 border">No</th>
                                <th class="px-4 py-3 border">Tanggal Tour</th>
                                <th class="px-4 py-3 border">Pelanggan</th>
                                <th class="px-4 py-3 border">Paket Wisata</th>
                                <th class="px-4 py-3 border text-center">Pax</th>
                                <th class="px-4 py-3 border text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $index => $trx)
                            <tr class="bg-white border-b print:border-gray-300">
                                <td class="px-4 py-3 border text-center">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 border">{{ $trx->tour_date->format('d/m/Y') }}</td>
                                <td class="px-4 py-3 border font-bold">{{ $trx->user->name }}</td>
                                <td class="px-4 py-3 border">{{ $trx->package->name }}</td>
                                <td class="px-4 py-3 border text-center">{{ $trx->pax_count }}</td>
                                <td class="px-4 py-3 border text-right font-bold">Rp {{ number_format($trx->total_price, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-gray-500">Tidak ada data transaksi lunas pada periode ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                        @if($transactions->isNotEmpty())
                        <tfoot>
                            <tr class="bg-gray-50 font-bold print:bg-gray-100">
                                <td colspan="5" class="px-4 py-3 border text-right text-gray-800">GRAND TOTAL</td>
                                <td class="px-4 py-3 border text-right text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>

                <div class="hidden print:flex justify-end mt-16">
                    <div class="text-center">
                        <p class="mb-20">Jakarta, {{ date('d F Y') }}</p>
                        <p class="font-bold underline">{{ Auth::user()->name }}</p>
                        <p>Owner</p>
                    </div>
                </div>

            </div>

        </div>
    </div>
    
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .py-12, .py-12 * {
                visibility: visible;
            }
            .py-12 {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
            }
            /* Hilangkan tombol filter saat print */
            .print\:hidden {
                display: none !important;
            }
            /* Munculkan elemen khusus print */
            .print\:block {
                display: block !important;
            }
            .print\:flex {
                display: flex !important;
            }
        }
    </style>
</x-app-layout>

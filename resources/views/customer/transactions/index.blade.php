<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pesanan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if($transactions->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-gray-500 mb-4">Kamu belum memesan paket wisata apapun.</p>
                        <a href="{{ route('customer.packages.index') }}" class="text-primary-600 hover:underline">Cari Paket Wisata Sekarang &rarr;</a>
                    </div>
                @else
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Tanggal Tour</th>
                                    <th scope="col" class="px-6 py-3">Paket Wisata</th>
                                    <th scope="col" class="px-6 py-3">Total Bayar</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        {{ $transaction->tour_date->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $transaction->package->name }}
                                        <span class="text-xs text-gray-500 block">({{ $transaction->pax_count }} Orang)</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($transaction->status == 'pending')
                                            <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">Belum Bayar</span>
                                        @elseif($transaction->status == 'waiting_approval')
                                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">Menunggu Konfirmasi</span>
                                        @elseif($transaction->status == 'approved')
                                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Lunas / Siap Berangkat</span>
                                        @else
                                            <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">Dibatalkan</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('customer.transactions.show', $transaction->id) }}" class="font-medium text-blue-600 hover:underline">
                                            @if($transaction->status == 'pending')
                                                Bayar Sekarang
                                            @else
                                                Lihat Detail
                                            @endif
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>

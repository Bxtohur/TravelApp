<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Validasi Pesanan Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">Tanggal Order</th>
                                <th class="px-6 py-3">Pelanggan</th>
                                <th class="px-6 py-3">Paket</th>
                                <th class="px-6 py-3">Total</th>
                                <th class="px-6 py-3">Bukti</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $transaction->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">{{ $transaction->user->name }}</div>
                                    <div class="text-xs">{{ $transaction->user->email }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $transaction->package->name }}
                                    <div class="text-xs text-gray-500">Tgl Tour: {{ $transaction->tour_date->format('d M Y') }}</div>
                                </td>
                                <td class="px-6 py-4 font-bold text-gray-900">
                                    Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($transaction->payment_proof)
                                        <span class="text-green-600 font-bold text-xs">Ada Bukti</span>
                                    @else
                                        <span class="text-red-500 text-xs">Belum Upload</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($transaction->status == 'pending')
                                        <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded">Pending</span>
                                    @elseif($transaction->status == 'waiting_approval')
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-0.5 rounded animate-pulse">Perlu Cek</span>
                                    @elseif($transaction->status == 'approved')
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-0.5 rounded">Lunas</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2 py-0.5 rounded">Ditolak</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.transactions.show', $transaction->id) }}" class="font-medium text-blue-600 hover:underline">
                                        Proses
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

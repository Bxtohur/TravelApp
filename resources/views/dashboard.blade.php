<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-8">
                <div class="flex items-center gap-6">
                    <div class="w-16 h-16 bg-primary-50 rounded-2xl flex items-center justify-center text-primary-600 shadow-inner shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">Halo, {{ Auth::user()->name }}!</h3>
                        <p class="text-gray-500">Selamat datang kembali di <span class="text-primary-600 font-medium">Brookal Travel</span>. Siap untuk petualangan hari ini?</p>
                    </div>
                </div>
            </div>

            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'owner')

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="text-gray-500 text-sm font-medium mb-1">Total Pendapatan</div>
                        <div class="text-2xl font-bold text-primary-600">Rp {{ number_format($stats['income'], 0, ',', '.') }}</div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="text-gray-500 text-sm font-medium mb-1">Menunggu Validasi</div>
                        <div class="text-2xl font-bold text-yellow-600">{{ $stats['pending'] }} Pesanan</div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="text-gray-500 text-sm font-medium mb-1">Paket Wisata</div>
                        <div class="text-2xl font-bold text-gray-800">{{ $stats['packages'] }} Aktif</div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="text-gray-500 text-sm font-medium mb-1">Total Pelanggan</div>
                        <div class="text-2xl font-bold text-gray-800">{{ $stats['customers'] }} Orang</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800 text-lg">5 Transaksi Terbaru</h3>
                        <a href="{{ route('admin.transactions.index') }}" class="text-sm text-primary-600 hover:underline">Lihat Semua</a>
                    </div>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3">Pelanggan</th>
                                    <th class="px-6 py-3">Paket</th>
                                    <th class="px-6 py-3">Total</th>
                                    <th class="px-6 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentTransactions as $trx)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $trx->user->name }}</td>
                                    <td class="px-6 py-4">{{ $trx->package->name }}</td>
                                    <td class="px-6 py-4">Rp {{ number_format($trx->total_price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        @if($trx->status == 'pending') <span class="text-gray-500 font-bold text-xs bg-gray-100 px-2 py-1 rounded">Pending</span>
                                        @elseif($trx->status == 'waiting_approval') <span class="text-yellow-600 font-bold text-xs bg-yellow-100 px-2 py-1 rounded">Cek Bukti</span>
                                        @elseif($trx->status == 'approved') <span class="text-green-600 font-bold text-xs bg-green-100 px-2 py-1 rounded">Lunas</span>
                                        @else <span class="text-red-600 font-bold text-xs bg-red-100 px-2 py-1 rounded">Ditolak</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            @else

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">

                    <div class="space-y-6">

                        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm relative overflow-hidden group hover:shadow-md transition">
                            <div class="absolute right-0 top-0 w-24 h-24 bg-primary-50 rounded-bl-full -z-0 group-hover:scale-110 transition-transform duration-500"></div>

                            <div class="relative z-10 flex items-center gap-5">
                                <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center text-primary-600 shrink-0 shadow-inner">
                                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Membership Points</p>
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-3xl font-extrabold text-primary-600">{{ number_format(Auth::user()->points ?? 0, 0, ',', '.') }}</span>
                                        <span class="text-sm font-bold text-gray-400">Pts</span>
                                    </div>
                                </div>
                            </div>

                            <p class="relative z-10 text-xs text-gray-500 mt-4 border-t border-gray-50 pt-3">
                                <span class="text-primary-600 font-bold">+10 Poin</span> otomatis ditambahkan setiap kali transaksimu lunas.
                            </p>
                        </div>

                        <div class="bg-primary-600 rounded-2xl p-8 text-white shadow-xl shadow-primary-500/20 relative overflow-hidden group">
                            <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full group-hover:scale-150 transition duration-500"></div>
                            <div class="absolute -left-10 -bottom-10 w-24 h-24 bg-white/10 rounded-full group-hover:scale-150 transition duration-500 delay-100"></div>

                            <div class="relative z-10">
                                <h3 class="text-2xl font-bold mb-3">Mau liburan ke mana?</h3>
                                <p class="text-primary-100 mb-8 leading-relaxed">Temukan ratusan destinasi menarik di seluruh Indonesia dan buat kenangan tak terlupakan.</p>

                                <a href="{{ route('customer.packages.index') }}" class="inline-flex items-center justify-center w-full bg-white text-primary-600 font-bold py-3.5 px-6 rounded-xl hover:bg-gray-50 transition shadow-sm group-hover:shadow-md">
                                    <span>Cari Paket Wisata</span>
                                    <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </a>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600 shrink-0">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">Butuh Bantuan?</h3>
                                    <p class="text-gray-500 text-sm mb-3">Hubungi admin kami jika ada kendala.</p>

                                    <a href="https://wa.me/6285720031617?text=Halo%20Admin%20Brookal%20Travel,%20saya%20butuh%20bantuan."
                                       target="_blank"
                                       class="inline-flex items-center gap-2 text-green-600 font-bold hover:text-green-700 hover:underline transition">
                                        +62 8572-0031-617
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden h-full flex flex-col">
                        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Pesanan Terakhir Saya
                            </h3>
                            <a href="{{ route('customer.transactions.index') }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700 hover:underline">Lihat Semua</a>
                        </div>

                        <div class="flex-grow">
                            @if($myTransactions->isEmpty())
                                <div class="h-full flex flex-col items-center justify-center p-12 text-center min-h-[300px]">
                                    <div class="inline-block p-4 rounded-full bg-gray-50 mb-4 text-gray-300">
                                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                    </div>
                                    <h4 class="text-gray-900 font-bold text-lg">Belum ada pesanan</h4>
                                    <p class="text-gray-500 mt-2">Yuk mulai petualangan pertamamu sekarang!</p>
                                    <a href="{{ route('customer.packages.index') }}" class="mt-6 px-6 py-2 bg-gray-900 text-white rounded-lg text-sm font-bold hover:bg-gray-800 transition">Booking Sekarang</a>
                                </div>
                            @else
                                <div class="divide-y divide-gray-100">
                                    @foreach($myTransactions as $trx)
                                    <div class="p-6 hover:bg-gray-50 transition flex flex-col sm:flex-row gap-4 items-start">
                                        <div class="shrink-0">
                                            <img src="{{ Str::startsWith($trx->package->image, 'http') ? $trx->package->image : asset('storage/' . $trx->package->image) }}" class="w-20 h-20 rounded-xl object-cover shadow-sm">
                                        </div>

                                        <div class="flex-grow">
                                            <div class="flex justify-between items-start">
                                                <h4 class="font-bold text-gray-900 text-lg">{{ $trx->package->name }}</h4>
                                                @if($trx->status == 'pending')
                                                    <span class="px-2.5 py-0.5 rounded-md text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">UNPAID</span>
                                                @elseif($trx->status == 'approved')
                                                    <span class="px-2.5 py-0.5 rounded-md text-xs font-bold bg-green-100 text-green-700 border border-green-200">LUNAS</span>
                                                @else
                                                    <span class="px-2.5 py-0.5 rounded-md text-xs font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">PROSES</span>
                                                @endif
                                            </div>

                                            <div class="flex items-center gap-4 mt-1 text-sm text-gray-500">
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    {{ $trx->tour_date->format('d M Y') }}
                                                </span>
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                    {{ $trx->pax_count }} Pax
                                                </span>
                                            </div>

                                            <div class="flex justify-between items-end mt-3">
                                                <div class="text-primary-600 font-bold text-lg">Rp {{ number_format($trx->total_price, 0, ',', '.') }}</div>

                                                @if($trx->status == 'pending')
                                                    <a href="{{ route('customer.transactions.show', $trx->id) }}" class="text-sm font-bold text-red-600 hover:text-red-700 hover:underline">Bayar Sekarang &rarr;</a>
                                                @else
                                                    <a href="{{ route('customer.transactions.show', $trx->id) }}" class="text-sm font-semibold text-gray-500 hover:text-gray-800">Detail &rarr;</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            @endif

        </div>
    </div>
</x-app-layout>

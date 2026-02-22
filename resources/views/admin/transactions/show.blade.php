<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="h-8 w-8 bg-primary-500 rounded-lg flex items-center justify-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
            </div>
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                Detail Transaksi <span class="text-primary-600">#{{ $transaction->id }}</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="bg-white shadow-sm sm:rounded-2xl p-6 border border-gray-100">
                    <div class="flex items-center gap-2 mb-4 border-b pb-3">
                        <span class="p-1.5 bg-blue-50 text-blue-600 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </span>
                        <h3 class="text-lg font-bold text-gray-800">Bukti Pembayaran</h3>
                    </div>

                    @if($transaction->payment_proof)
                        <div class="group relative overflow-hidden rounded-xl border border-gray-200">
                            <img src="{{ asset('storage/' . $transaction->payment_proof) }}" alt="Bukti Transfer" class="w-full transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <a href="{{ asset('storage/' . $transaction->payment_proof) }}" target="_blank" class="bg-white text-gray-900 px-4 py-2 rounded-lg text-sm font-bold shadow-xl">
                                    Buka Foto
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="h-64 bg-gray-50 flex flex-col items-center justify-center text-gray-400 rounded-xl border-2 border-dashed border-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mb-2 opacity-20">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            <p class="text-sm font-medium">Belum ada unggahan</p>
                        </div>
                    @endif
                </div>

                <div class="bg-white shadow-sm sm:rounded-2xl p-6 border border-gray-100">
                    <div class="flex items-center gap-2 mb-6 border-b pb-3">
                        <span class="p-1.5 bg-primary-50 text-primary-600 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75V18m-3-9.75V18m-3-3V18m3-15.75a9 9 0 1 1 0 18 9 9 0 0 1 0-18Z" />
                            </svg>
                        </span>
                        <h3 class="text-lg font-bold text-gray-800">Rincian Perjalanan</h3>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div>
                            <span class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Nama Pemesan</span>
                            <p class="font-bold text-gray-900">{{ $transaction->user->name }}</p>
                        </div>
                        <div>
                            <span class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Status</span>
                            <p class="font-bold {{ $transaction->status == 'approved' ? 'text-green-600' : ($transaction->status == 'rejected' ? 'text-red-600' : 'text-amber-600') }} uppercase italic">
                                {{ $transaction->status }}
                            </p>
                        </div>
                        <div class="col-span-2">
                            <span class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Paket Wisata</span>
                            <p class="font-bold text-gray-900">{{ $transaction->package->name }}</p>
                        </div>
                        <div>
                            <span class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Jadwal</span>
                            <p class="font-bold text-gray-900">{{ $transaction->tour_date->format('d F Y') }}</p>
                        </div>
                        <div>
                            <span class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Tagihan ({{ $transaction->pax_count }} Pax)</span>
                            <p class="text-xl font-black text-primary-600">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <h4 class="font-bold text-gray-800 mb-3 text-sm">Validasi Pembayaran</h4>
                        <div class="flex gap-3">
                            <form action="{{ route('admin.transactions.update', $transaction->id) }}" method="POST" class="flex-1">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-2.5 px-4 rounded-lg shadow-lg shadow-primary-500/30 transition-all active:scale-95 text-sm" onclick="return confirm('Validasi LUNAS?')">
                                    Terima & Lunas
                                </button>
                            </form>

                            <form action="{{ route('admin.transactions.update', $transaction->id) }}" method="POST" class="flex-1">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="w-full bg-white border border-red-200 hover:bg-red-50 text-red-600 font-bold py-2.5 px-4 rounded-lg transition-all active:scale-95 text-sm" onclick="return confirm('Tolak pembayaran ini?')">
                                    Tolak
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

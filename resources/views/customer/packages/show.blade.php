<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="md:col-span-2 bg-white shadow-sm sm:rounded-lg overflow-hidden">
                    <img src="{{ Str::startsWith($package->image, 'http') ? $package->image : asset('storage/' . $package->image) }}" class="w-full h-80 object-cover">
                    <div class="p-8">
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $package->name }}</h1>
                        
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-primary-600 mb-2">Destinasi Wisata:</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $package->destinations }}</p>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-primary-600 mb-2">Fasilitas Termasuk:</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $package->facilities }}</p>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-1">
                    <div class="bg-white shadow-sm sm:rounded-lg p-6 sticky top-4">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 border-b pb-2">Form Pemesanan</h3>
                        <p class="text-3xl font-bold text-primary-600 mb-6">Rp {{ number_format($package->price, 0, ',', '.') }} <span class="text-sm text-gray-500 font-normal">/ orang</span></p>

                        <form action="{{ route('customer.transactions.store', $package->id) }}" method="POST">
                            @csrf
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Keberangkatan</label>
                                <input type="date" name="tour_date" class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary-500 focus:ring-primary-500" required>
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Jumlah Peserta (Pax)</label>
                                <input type="number" name="pax_count" min="1" value="1" class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary-500 focus:ring-primary-500" required>
                            </div>

                            <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-4 rounded-lg transition">
                                Booking Sekarang
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

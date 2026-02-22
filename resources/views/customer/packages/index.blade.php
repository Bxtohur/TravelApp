<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pilih Paket Liburanmu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($packages as $package)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition duration-300">
                    <img src="{{ Str::startsWith($package->image, 'http') ? $package->image : asset('storage/' . $package->image) }}" alt="{{ $package->name }}" class="w-full h-48 object-cover">
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $package->name }}</h3>
                        <p class="text-primary-600 font-bold text-lg mb-4">Rp {{ number_format($package->price, 0, ',', '.') }} / Pax</p>
                        
                        <div class="text-gray-600 text-sm mb-4 h-12 overflow-hidden">
                            {{ Str::limit($package->destinations, 80) }}
                        </div>

                        <a href="{{ route('customer.packages.show', $package->slug) }}" class="block text-center w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Paket Wisata') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-900">Daftar Paket Tersedia</h3>
                    <a href="{{ route('admin.packages.create') }}" class="px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:ring ring-primary-300 disabled:opacity-25 transition ease-in-out duration-150">
                        + Tambah Paket
                    </a>
                </div>

                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Gambar</th>
                                <th scope="col" class="px-6 py-3">Nama Paket</th>
                                <th scope="col" class="px-6 py-3">Harga</th>
                                <th scope="col" class="px-6 py-3">Destinasi</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($packages as $package)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <img src="{{ Str::startsWith($package->image, 'http') ? $package->image : asset('storage/' . $package->image) }}" alt="" class="w-20 h-16 object-cover rounded">
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $package->name }}
                                </td>
                                <td class="px-6 py-4">
                                    Rp {{ number_format($package->price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 truncate max-w-xs">
                                    {{ $package->destinations }}
                                </td>
                                <td class="px-6 py-4 space-x-2">
                                    <a href="{{ route('admin.packages.edit', $package->id) }}" class="font-medium text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus paket ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
                                    </form>
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

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Paket: {{ $package->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('admin.packages.update', $package->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Paket</label>
                        <input type="text" name="name" value="{{ $package->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Harga per Pax (Rp)</label>
                        <input type="number" name="price" value="{{ $package->price }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Ganti Foto (Kosongkan jika tidak ubah)</label>
                        <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                        <p class="text-xs text-gray-500 mt-1">Foto saat ini: {{ $package->image }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Fasilitas</label>
                        <textarea name="facilities" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ $package->facilities }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Destinasi</label>
                        <textarea name="destinations" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ $package->destinations }}</textarea>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('admin.packages.index') }}" class="text-gray-600 hover:underline mr-4">Batal</a>
                        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Update Paket
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

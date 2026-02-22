<section class="space-y-6">
    <div class="bg-red-50 text-red-700 text-sm p-4 rounded-lg">
        {{ __('Peringatan: Setelah akun Anda dihapus, semua data akan hilang permanen. Silakan unduh data penting sebelum melanjutkan.') }}
    </div>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" 
        class="text-red-600 hover:text-red-800 font-semibold text-sm hover:underline transition">
        &rarr; {{ __('Saya mengerti, lanjut Hapus Akun') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-xl font-bold text-gray-900 mb-2">
                {{ __('Konfirmasi Penghapusan') }}
            </h2>

            <p class="text-sm text-gray-600 mb-6">
                {{ __('Masukkan password Anda untuk mengonfirmasi bahwa Anda benar-benar ingin menghapus akun ini secara permanen.') }}
            </p>

            <div class="mb-6">
                <label for="password" class="sr-only">Password</label>
                <input id="password" name="password" type="password" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500 py-2.5" placeholder="Password Anda" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium text-sm transition">
                    {{ __('Batal') }}
                </button>

                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium text-sm transition shadow">
                    {{ __('Ya, Hapus Akun') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>

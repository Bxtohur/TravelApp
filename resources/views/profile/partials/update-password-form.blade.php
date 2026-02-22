<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-semibold text-gray-700 mb-2">Password Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 transition duration-150" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
            <input id="update_password_password" name="password" type="password" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 transition duration-150" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password Baru</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 transition duration-150" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="px-6 py-2.5 bg-gray-900 hover:bg-gray-800 text-white font-medium rounded-lg text-sm transition duration-150 shadow-md hover:shadow-lg">
                {{ __('Update Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 font-bold flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Password Berhasil Diganti!
                </p>
            @endif
        </div>
    </form>
</section>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Pengaturan Akun') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ step: 1 }">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-center mb-8">
                <div class="flex items-center space-x-4 select-none">
                    <div class="flex flex-col items-center cursor-pointer transition transform hover:scale-105" @click="step = 1">
                        <div :class="step === 1 ? 'bg-primary-600 text-white shadow-lg shadow-primary-500/30' : 'bg-gray-200 text-gray-500'" class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-base transition-colors duration-300">1</div>
                        <span :class="step === 1 ? 'text-primary-600 font-bold' : 'text-gray-400'" class="text-xs mt-2 uppercase tracking-wide">Profil</span>
                    </div>
                    <div class="w-16 h-1 bg-gray-200 rounded overflow-hidden">
                        <div :class="step >= 2 ? 'w-full bg-primary-600' : 'w-0'" class="h-full transition-all duration-500 ease-out"></div>
                    </div>
                    <div class="flex flex-col items-center cursor-pointer transition transform hover:scale-105" @click="step = 2">
                        <div :class="step === 2 ? 'bg-primary-600 text-white shadow-lg shadow-primary-500/30' : (step > 2 ? 'bg-primary-600 text-white' : 'bg-gray-200 text-gray-500')" class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-base transition-colors duration-300">2</div>
                        <span :class="step === 2 ? 'text-primary-600 font-bold' : 'text-gray-400'" class="text-xs mt-2 uppercase tracking-wide">Password</span>
                    </div>
                    <div class="w-16 h-1 bg-gray-200 rounded overflow-hidden">
                         <div :class="step >= 3 ? 'w-full bg-primary-600' : 'w-0'" class="h-full transition-all duration-500 ease-out"></div>
                    </div>
                    <div class="flex flex-col items-center cursor-pointer transition transform hover:scale-105" @click="step = 3">
                        <div :class="step === 3 ? 'bg-red-600 text-white shadow-lg shadow-red-500/30' : 'bg-gray-200 text-gray-500'" class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-base transition-colors duration-300">3</div>
                        <span :class="step === 3 ? 'text-red-600 font-bold' : 'text-gray-400'" class="text-xs mt-2 uppercase tracking-wide">Hapus</span>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-xl sm:rounded-2xl border border-gray-100 relative min-h-[580px] overflow-hidden flex flex-col">
                
                <div x-show="step === 1" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 -translate-x-10"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 -translate-x-10"
                     class="absolute inset-0 flex flex-col p-8 md:p-10">
                    
                    <div class="flex items-center gap-4 mb-6 border-b pb-6">
                        <div class="w-12 h-12 bg-primary-50 rounded-2xl flex items-center justify-center text-primary-600 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">Profil Saya</h3>
                            <p class="text-sm text-gray-500">Perbarui foto dan informasi data diri Anda.</p>
                        </div>
                    </div>

                    <div class="flex-grow">
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex justify-end">
                        <button @click="step = 2" class="group flex items-center gap-2 px-6 py-3 bg-gray-50 text-gray-700 rounded-xl font-bold hover:bg-primary-50 hover:text-primary-700 transition duration-300">
                            Lanjut ke Password
                            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </button>
                    </div>
                </div>

                <div x-show="step === 2" style="display: none;"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-x-10"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-10"
                     class="absolute inset-0 flex flex-col p-8 md:p-10">

                    <div class="flex items-center gap-4 mb-6 border-b pb-6">
                        <div class="w-12 h-12 bg-yellow-50 rounded-2xl flex items-center justify-center text-yellow-600 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">Keamanan</h3>
                            <p class="text-sm text-gray-500">Buat password yang kuat dan tidak mudah ditebak.</p>
                        </div>
                    </div>

                    <div class="flex-grow">
                        @include('profile.partials.update-password-form')
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex justify-between items-center">
                        <button @click="step = 1" class="group flex items-center gap-2 px-4 py-2 text-gray-400 hover:text-gray-600 font-semibold transition">
                            <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>
                            Kembali
                        </button>
                        
                        <button @click="step = 3" class="group flex items-center gap-2 px-6 py-3 bg-red-50 text-red-600 rounded-xl font-bold hover:bg-red-100 transition duration-300">
                            Hapus Akun
                            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </button>
                    </div>
                </div>

                <div x-show="step === 3" style="display: none;"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-x-10"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-10"
                     class="absolute inset-0 flex flex-col p-8 md:p-10">

                    <div class="flex items-center gap-4 mb-6 border-b border-red-100 pb-6">
                        <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center text-red-600 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-red-600">Hapus Akun</h3>
                            <p class="text-sm text-red-400">Tindakan ini bersifat permanen dan tidak bisa dibatalkan.</p>
                        </div>
                    </div>

                    <div class="flex-grow">
                        @include('profile.partials.delete-user-form')
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex justify-start">
                        <button @click="step = 2" class="group flex items-center gap-2 px-4 py-2 text-gray-400 hover:text-gray-600 font-semibold transition">
                            <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path></svg>
                            Kembali ke Password
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

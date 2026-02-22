<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun - Brookal Travel</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-white">
    
    <div class="min-h-screen flex flex-row-reverse">
        
        <div class="hidden lg:block lg:w-1/2 relative bg-gray-900">
            <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?q=80&w=1600&auto=format&fit=crop" 
                 alt="Travel Adventure" 
                 class="absolute inset-0 w-full h-full object-cover opacity-80">
            
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent flex flex-col justify-end p-12 text-white">
                <h2 class="text-4xl font-bold mb-4">Mulai Petualanganmu</h2>
                <p class="text-lg text-gray-200">Buat akun sekarang dan dapatkan akses ke ratusan destinasi wisata eksotis di Indonesia.</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white overflow-y-auto">
            <div class="w-full max-w-md">
                
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold text-gray-900">Buat Akun Baru</h2>
                    <p class="text-gray-500 mt-2">Isi data diri Anda untuk mendaftar.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <div class="relative">
                            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                                class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm py-3 transition duration-200" 
                                placeholder="Nama Lengkap Anda">
                        </div>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                            class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm py-3 transition duration-200" 
                            placeholder="nama@email.com">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm py-3 transition duration-200" 
                            placeholder="Minimal 8 karakter">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                            class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm py-3 transition duration-200" 
                            placeholder="Ulangi password di atas">
                        @error('password_confirmation')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-300 transform hover:-translate-y-0.5">
                            {{ __('Daftar Sekarang') }}
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-600">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="font-bold text-primary-600 hover:text-primary-800 hover:underline">
                            Masuk di sini
                        </a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</body>
</html>

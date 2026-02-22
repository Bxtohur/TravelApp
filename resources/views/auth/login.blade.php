<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Brookal Travel</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-white">
    
    <div class="min-h-screen flex">
        
        <div class="hidden lg:block lg:w-1/2 relative bg-gray-900">
            <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?q=80&w=1600&auto=format&fit=crop" 
                 alt="Background Travel" 
                 class="absolute inset-0 w-full h-full object-cover opacity-80">
            
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent flex flex-col justify-end p-12 text-white">
                <h2 class="text-4xl font-bold mb-4">Jelajahi Dunia Bersama Kami</h2>
                <p class="text-lg text-gray-200">Nikmati pengalaman liburan tak terlupakan dengan pelayanan terbaik dari PT. Brookal Sukses Abadi.</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                
                <div class="text-center mb-10">
                    <div class="mx-auto h-12 w-12 bg-primary-600 rounded-xl flex items-center justify-center rotate-45 mb-4 shadow-lg shadow-primary-500/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Selamat Datang!</h2>
                    <p class="text-gray-500 mt-2">Silakan login untuk mengatur liburanmu.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                                class="pl-10 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm py-3 transition duration-200" 
                                placeholder="nama@email.com">
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="current-password" 
                                class="pl-10 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm py-3 transition duration-200" 
                                placeholder="••••••••">
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Ingat Saya') }}</span>
                        </label>

                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-300 transform hover:-translate-y-0.5">
                            {{ __('Masuk Sekarang') }}
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-600">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="font-bold text-primary-600 hover:text-primary-800 hover:underline">
                            Daftar di sini
                        </a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</body>
</html>

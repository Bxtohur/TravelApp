<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Brookal Travel - Jelajahi Indonesia</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans text-gray-900 bg-white">

    <nav class="absolute top-0 left-0 w-full z-50 px-6 py-4 flex justify-between items-center">
        <a href="{{ url('/') }}" class="flex items-center group">
            <div class="h-16 w-auto flex items-center justify-center transition-transform duration-300 group-hover:scale-105">
                <img src="{{ asset('images/Main_logo.png') }}" 
                    alt="PT. Brookal Sukses Abadi Logo" 
                    class="h-full w-auto object-contain">
            </div>
        </a>

        <div class="flex items-center gap-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-white font-semibold hover:text-primary-400 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-white font-semibold hover:text-primary-400 transition">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-5 py-2 bg-primary-600 text-white font-bold rounded-full hover:bg-primary-500 transition shadow-lg hover:shadow-primary-500/50">
                            Daftar
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <div class="relative h-screen flex items-center justify-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=80&w=2070&auto=format&fit=crop" 
             class="absolute inset-0 w-full h-full object-cover" 
             alt="Travel Background">
        
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/40 to-white"></div>

        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto mt-10">
            <span class="inline-block py-1 px-3 rounded-full bg-primary-600/20 border border-primary-500 text-primary-300 text-sm font-semibold mb-6 backdrop-blur-sm">
                #1 Travel Agent Terpercaya
            </span>
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight drop-shadow-lg">
                Temukan Surga <br> Tersembunyi Indonesia
            </h1>
            <p class="text-lg text-gray-200 mb-10 max-w-2xl mx-auto leading-relaxed">
                Kami menyediakan paket wisata terbaik ke Bali, Bromo, Dieng, dan destinasi impian lainnya dengan harga terjangkau dan fasilitas premium.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="px-8 py-4 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-500 transition shadow-lg hover:shadow-primary-500/50 text-lg">
                    Booking Sekarang
                </a>
                <a href="#popular" class="px-8 py-4 bg-white/10 backdrop-blur-md border border-white/30 text-white font-bold rounded-xl hover:bg-white/20 transition text-lg">
                    Lihat Paket
                </a>
            </div>
        </div>
    </div>

    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="p-6 rounded-2xl bg-gray-50 hover:bg-primary-50 transition duration-300 group">
                    <div class="w-16 h-16 bg-primary-100 text-primary-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-primary-600 group-hover:text-white transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Harga Terbaik</h3>
                    <p class="text-gray-600">Jaminan harga paling kompetitif dengan fasilitas all-in tanpa biaya tersembunyi.</p>
                </div>

                <div class="p-6 rounded-2xl bg-gray-50 hover:bg-primary-50 transition duration-300 group">
                    <div class="w-16 h-16 bg-primary-100 text-primary-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-primary-600 group-hover:text-white transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Aman & Terpercaya</h3>
                    <p class="text-gray-600">Setiap transaksi diverifikasi manual oleh admin untuk keamanan maksimal.</p>
                </div>

                <div class="p-6 rounded-2xl bg-gray-50 hover:bg-primary-50 transition duration-300 group">
                    <div class="w-16 h-16 bg-primary-100 text-primary-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-primary-600 group-hover:text-white transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-8a2 2 0 012-2h14a2 2 0 012 2v8M10 5a2 2 0 114 0 2 2 0 01-4 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Fasilitas Premium</h3>
                    <p class="text-gray-600">Bus AC terbaru, Hotel nyaman, dan Pemandu wisata berpengalaman.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popular" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Destinasi Terpopuler</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Pilih paket liburan favoritmu dan buat kenangan indah bersama orang tercinta.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    @foreach($packages as $package)
    <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition duration-300 group flex flex-col">
        <div class="relative h-64 overflow-hidden">
            <img src="{{ Str::startsWith($package->image, 'http') ? $package->image : asset('storage/' . $package->image) }}" 
                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500" 
                 alt="{{ $package->name }}">
            
            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur text-gray-900 px-3 py-1 rounded-full text-sm font-bold shadow-sm">
                Best Seller
            </div>
        </div>
        
        <div class="p-6 flex-1 flex flex-col justify-between">
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $package->name }}</h3>
                <p class="text-gray-600 mb-4 line-clamp-2">
                    {{ Str::limit($package->destinations, 80) }}
                </p>
            </div>
            
            <div class="flex justify-between items-center mt-auto border-t pt-4">
                <div>
                    <span class="text-xs text-gray-500 block">Mulai dari</span>
                    <span class="text-xl font-bold text-primary-600">
                        Rp {{ number_format($package->price, 0, ',', '.') }}
                    </span>
                </div>
                
                @auth
                    <a href="{{ route('customer.packages.show', $package->slug) }}" class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-primary-600 transition">
                        Pesan
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-primary-600 transition">
                        Detail
                    </a>
                @endauth
            </div>
        </div>
    </div>
    @endforeach
</div>

            <div class="mt-12 text-center">
                <a href="{{ route('login') }}" class="inline-flex items-center text-primary-600 font-bold hover:text-primary-700 hover:underline text-lg">
                    Lihat Semua Paket Wisata
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </div>

    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="col-span-1 md:col-span-2">
                <div class="mb-4 flex items-center gap-3">
                    <div class="h-16 w-auto flex items-center justify-center">
                        <img src="{{ asset('images/Main_logo.png') }}" 
                            alt="Logo PT. Brookal Sukses Abadi" 
                            class="h-full w-auto object-contain">
                    </div>
                </div>
                
                <p class="text-gray-400 max-w-sm leading-relaxed">
                    <span class="text-blue-500 font-semibold">PT. BROOKAL SUKSES ABADI</span>. 
                    Sahabat perjalanan terbaik Anda untuk menjelajahi keindahan alam Indonesia.
                </p>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-4">Navigasi</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="hover:text-primary-500 transition">Beranda</a></li>
                    <li><a href="#" class="hover:text-primary-500 transition">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-primary-500 transition">Paket Wisata</a></li>
                    <li><a href="#" class="hover:text-primary-500 transition">Kontak</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-4">Hubungi Kami</h4>
                <ul class="space-y-2 text-gray-400">
                    <li>support@brookaltravel.com</li>
                    <li>+62 812-3456-7890</li>
                    <li>Jakarta, Indonesia</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-500 text-sm">
            &copy; 2025 Brookal Travel. All rights reserved.
        </div>
    </footer>
</body>
</html>

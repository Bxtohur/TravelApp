<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="scrollbar-gutter: stable;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* 1. Kustomisasi Scrollbar biar lebih tipis & elegan (Chrome/Safari/Edge) */
            ::-webkit-scrollbar {
                width: 10px;
            }
            ::-webkit-scrollbar-track {
                background: transparent;
            }
            ::-webkit-scrollbar-thumb {
                background-color: #cbd5e1; /* Warna abu soft */
                border-radius: 20px;
                border: 3px solid transparent;
                background-clip: content-box;
            }
            ::-webkit-scrollbar-thumb:hover {
                background-color: #94a3b8; /* Lebih gelap pas di-hover */
            }

            /* 2. BACKGROUND PREMIUM: Dot Pattern */
            body {
                background-color: #f8fafc; /* Warna dasar Slate-50 (putih kebiruan dikit) */
                /* Membuat pola titik-titik halus */
                background-image: radial-gradient(#e2e8f0 1px, transparent 1px); 
                background-size: 24px 24px; /* Jarak antar titik */
            }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-900">
        
        <div class="min-h-screen">
            
            @include('layouts.navigation')

            @if (isset($header))
                <header class="bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-20 z-40 shadow-sm">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>

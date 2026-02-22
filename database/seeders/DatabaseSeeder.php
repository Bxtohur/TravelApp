<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Package;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        User::create([
            'name' => 'Admin Travel',
            'email' => 'admin@travel.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // 2. Akun Customer
        User::create([
            'name' => 'Budi Pelanggan',
            'email' => 'budi@gmail.com',
            'role' => 'customer',
            'password' => Hash::make('password'),
        ]);

        // 3. Akun Owner (INI YANG BARU)
        User::create([
            'name' => 'Owner Travel',
            'email' => 'owner@travel.com',
            'role' => 'owner',
            'password' => Hash::make('password'),
        ]);

        // 4. Data Paket Wisata
        $packages = [
            [
                'name' => 'DIENG WONOSOBO',
                'price' => 950000,
                'facilities' => 'Hotel (1 Kamar 2 Orang), Bus 59 Seat (AC/TV/Karaoke), Tiket Masuk, Makan 5x, Shuttle, Guide, Dokumentasi',
                'destinations' => 'Sunrise Batu Angkruk, Kawah Sikidang, Candi Arjuna, Batu Ratapan Angin, Telaga Warna',
                'image' => 'https://images.unsplash.com/photo-1582657233895-0f37a369bacc?q=80&w=800'
            ],
            [
                'name' => 'BALI (5 Hari 4 Malam)',
                'price' => 1950000,
                'facilities' => 'Hotel 3H2M, Bus 48 Seat, Tiket Masuk, Makan 13x, Guide, Penyeberangan, Spanduk',
                'destinations' => 'Pura Ulundanu, Pantai Jimbaran, Tanjung Benoa, Tanah Lot, Desa Panglipura, Pantai Pandawa, GWK, Krisna Mall',
                'image' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?q=80&w=800'
            ],
            [
                'name' => 'KARIMUN JAWA',
                'price' => 1520000,
                'facilities' => 'Homestay, Bus 48 Seat, Tiket Wisata, Makan 3x, Kapal Express PP, Shuttle, Kapal Tour Laut, Guide',
                'destinations' => 'Spot Ikan Nemo, Snorkeling, Pantai Tanjung Gelam, Bukit Love, Alun-alun Karimun Jawa',
                'image' => 'https://images.unsplash.com/photo-1605634289871-332e6750372b?q=80&w=800'
            ],
            [
                'name' => 'BROMO',
                'price' => 939000,
                'facilities' => 'Homestay, Bus 39 Seat, Tiket Masuk, Makan 2x, Snack, Petik Apel, Shuttle Jeep',
                'destinations' => 'Spot Sunrise Bukit Love, Widodaren, Bukit Batok, Kawah Bromo, Pasir Berbisik, Bukit Teletubies',
                'image' => 'https://images.unsplash.com/photo-1588668214407-6ea9e6d8c27c?q=80&w=800'
            ],
             [
                'name' => 'YOGYAKARTA',
                'price' => 900000,
                'facilities' => 'Hotel, Bus 59 Seat, Tiket Wisata, Makan 4x, Tour Leader, Spanduk',
                'destinations' => 'Pantai Slili, Heha Sky View, Malioboro, Kota Tua Semarang, Masjid Agung Jawa Tengah',
                'image' => 'https://images.unsplash.com/photo-1586724237569-f3d0c1dee8c6?q=80&w=800'
            ],
        ];

        foreach ($packages as $pkg) {
            Package::create([
                'name' => $pkg['name'],
                'slug' => Str::slug($pkg['name']),
                'price' => $pkg['price'],
                'facilities' => $pkg['facilities'],
                'destinations' => $pkg['destinations'],
                'image' => $pkg['image']
            ]);
        }
    }
}

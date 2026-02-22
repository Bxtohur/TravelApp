<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    // 1. Tampilkan Semua Paket
    public function index()
    {
        $packages = Package::all();
        return view('admin.packages.index', compact('packages'));
    }

    // 2. Form Tambah Paket
    public function create()
    {
        return view('admin.packages.create');
    }

    // 3. Simpan Paket Baru ke Database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'facilities' => 'required',
            'destinations' => 'required',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        
        // Upload Gambar
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('packages', 'public');
        }

        Package::create($data);

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil ditambahkan!');
    }

    // 4. Form Edit Paket
    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    // 5. Update Paket ke Database
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'facilities' => 'required',
            'destinations' => 'required',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        // Cek kalau ada ganti gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama dulu kalau bukan url dari internet (seeder)
            if ($package->image && !Str::startsWith($package->image, 'http')) {
                Storage::disk('public')->delete($package->image);
            }
            $data['image'] = $request->file('image')->store('packages', 'public');
        }

        $package->update($data);

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil diupdate!');
    }

    // 6. Hapus Paket
    public function destroy(Package $package)
    {
        if ($package->image && !Str::startsWith($package->image, 'http')) {
            Storage::disk('public')->delete($package->image);
        }
        $package->delete();
        return redirect()->route('admin.packages.index')->with('success', 'Paket dihapus!');
    }
}

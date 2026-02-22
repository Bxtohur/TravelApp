<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('customer.packages.index', compact('packages'));
    }

    public function show(Package $package)
    {
        return view('customer.packages.show', compact('package'));
    }
}

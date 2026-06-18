<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function index(Request $request)
    {
        $query = Store::with('user');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('kategori') && $request->kategori !== 'Semua Kategori') {
            $query->where('category', $request->kategori);
        }
        if ($request->filled('provinsi') && $request->provinsi !== 'Semua Provinsi') {
            $query->where('city', 'like', '%' . $request->provinsi . '%');
        }

        $stores = $query->get();
        return view('umkm.index', compact('stores'));
    }

    public function show($id)
    {
        $store    = Store::with(['products', 'user'])->findOrFail($id);
        $qrCode   = $store->qrCode;
        return view('umkm.show', compact('store', 'qrCode'));
    }

    public function qr($id)
    {
        $store  = Store::findOrFail($id);
        $qrCode = $store->qrCode;
        return view('umkm.qr', compact('store', 'qrCode'));
    }
}

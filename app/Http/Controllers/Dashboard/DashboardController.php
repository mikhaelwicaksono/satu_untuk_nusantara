<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Store;

class DashboardController extends Controller
{
    public function index()
    {
        $store = Store::where('user_id', session('user_id'))->first();
        $totalProducts = $store ? $store->products()->count() : 0;
        $totalPromos   = $store ? $store->promos()->count() : 0;
        $activePromos  = $store ? $store->promos()->where('status', 'aktif')->count() : 0;
        $qrActive      = $store && $store->qrCode ? 1 : 0;
        $activities    = [];

        if ($store) {
            $latestProduct = $store->products()->latest()->first();
            if ($latestProduct) $activities[] = 'Produk "' . $latestProduct->name . '" berhasil ditambahkan';
            $latestPromo = $store->promos()->latest()->first();
            if ($latestPromo) $activities[] = 'Promo "' . ($latestPromo->code ?? $latestPromo->title) . '" telah dibuat';
            if ($store->qrCode) $activities[] = 'QR Toko aktif';
        }

        return view('dashboard.index', compact('store', 'totalProducts', 'totalPromos', 'activePromos', 'qrActive', 'activities'));
    }
}

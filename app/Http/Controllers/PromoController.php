<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index(Request $request)
    {
        // Auto-expire promo yang sudah melewati tanggal berlaku
        Promo::where('status', 'aktif')
            ->whereNotNull('expires_at')
            ->where('expires_at', '<', now()->startOfDay())
            ->update(['status' => 'berakhir']);

        $query = Promo::with('store');
        if ($request->filled('kategori') && $request->kategori !== 'Semua Promo') {
            $query->whereHas('store', fn($q) => $q->where('category', $request->kategori));
        }
        $promos = $query->get();
        return view('promo.index', compact('promos'));
    }
}

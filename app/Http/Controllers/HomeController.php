<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\Store;

class HomeController extends Controller
{
    public function index()
    {
        $stores   = Store::with('user')->take(3)->get();
        $promos   = Promo::with('store')->where('status', 'aktif')->take(3)->get();
        return view('home', compact('stores', 'promos'));
    }
}

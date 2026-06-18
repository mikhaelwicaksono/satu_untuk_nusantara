<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('store');
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('kategori') && $request->kategori !== 'Semua') {
            $query->where('category', $request->kategori);
        }
        $products = $query->get();
        return view('produk.index', compact('products'));
    }

    public function show($storeId, $productId)
    {
        $store   = Store::findOrFail($storeId);
        $product = Product::where('store_id', $storeId)->findOrFail($productId);
        $others  = Product::where('store_id', $storeId)->where('id', '!=', $productId)->take(4)->get();
        return view('produk.show', compact('store', 'product', 'others'));
    }
}

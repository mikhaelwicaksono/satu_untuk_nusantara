<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $store = Store::where('user_id', session('user_id'))->firstOrFail();
        $query = $store->products();
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $products = $query->get();
        return view('dashboard.produk', compact('store', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $store = Store::where('user_id', session('user_id'))->firstOrFail();
        $data  = $request->only(['name', 'category', 'price', 'description', 'social_link']);
        $data['store_id'] = $store->id;

        if ($request->hasFile('photo')) {
            $file     = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $filename);
            $data['photo'] = 'uploads/products/' . $filename;
        }

        Product::create($data);
        return redirect()->route('dashboard.produk')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $store   = Store::where('user_id', session('user_id'))->firstOrFail();
        $product = Product::where('store_id', $store->id)->findOrFail($id);

        $data = $request->only(['name', 'category', 'price', 'description', 'social_link']);

        if ($request->hasFile('photo')) {
            $file     = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $filename);
            $data['photo'] = 'uploads/products/' . $filename;
        }

        $product->update($data);
        return redirect()->route('dashboard.produk')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $store   = Store::where('user_id', session('user_id'))->firstOrFail();
        $product = Product::where('store_id', $store->id)->findOrFail($id);
        $product->delete();
        return redirect()->route('dashboard.produk')->with('success', 'Produk berhasil dihapus!');
    }
}

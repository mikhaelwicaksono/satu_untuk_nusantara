<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use App\Models\Store;
use Illuminate\Http\Request;

class PromoDashboardController extends Controller
{
    public function index()
    {
        $store = Store::where('user_id', session('user_id'))->firstOrFail();

        // Auto-expire promos that have passed their expires_at date
        $store->promos()
            ->where('status', 'aktif')
            ->whereNotNull('expires_at')
            ->where('expires_at', '<', now()->startOfDay())
            ->update(['status' => 'berakhir']);

        $promos  = $store->promos()->orderBy('created_at', 'desc')->get();
        $total   = $promos->count();
        $aktif   = $promos->where('status', 'aktif')->count();
        $selesai = $promos->where('status', 'berakhir')->count();
        return view('dashboard.promo', compact('store', 'promos', 'total', 'aktif', 'selesai'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'code'      => 'nullable|string|max:50',
            'promo_link'=> 'nullable|string',
            'expires_at'=> 'nullable|date',
            'banner'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $store = Store::where('user_id', session('user_id'))->firstOrFail();
        $data  = $request->only(['title', 'code', 'promo_link', 'expires_at', 'status']);
        $data['store_id'] = $store->id;

        if ($request->hasFile('banner')) {
            $file     = $request->file('banner');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/banners'), $filename);
            $data['banner'] = 'uploads/banners/' . $filename;
        }

        Promo::create($data);
        return redirect()->route('dashboard.promo')->with('success', 'Promo berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'banner'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'expires_at'=> 'nullable|date',
        ]);

        $store = Store::where('user_id', session('user_id'))->firstOrFail();
        $promo = Promo::where('store_id', $store->id)->findOrFail($id);
        $data  = $request->only(['title', 'code', 'promo_link', 'expires_at', 'status']);

        if ($request->hasFile('banner')) {
            $file     = $request->file('banner');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/banners'), $filename);
            $data['banner'] = 'uploads/banners/' . $filename;
        }

        $promo->update($data);
        return redirect()->route('dashboard.promo')->with('success', 'Promo berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $store = Store::where('user_id', session('user_id'))->firstOrFail();
        $promo = Promo::where('store_id', $store->id)->findOrFail($id);
        $promo->delete();
        return redirect()->route('dashboard.promo')->with('success', 'Promo berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    public function edit()
    {
        $store = Store::where('user_id', session('user_id'))->firstOrFail();
        return view('dashboard.toko', compact('store'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'category'  => 'required|string',
            'address'   => 'nullable|string',
            'city'      => 'nullable|string',
            'phone'     => 'nullable|string',
            'instagram' => 'nullable|string',
            'logo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $store = Store::where('user_id', session('user_id'))->firstOrFail();

        $data = $request->only(['name', 'category', 'description', 'address', 'city', 'phone', 'instagram']);

        if ($request->hasFile('logo')) {
            $file    = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/logos'), $filename);
            $data['logo'] = 'uploads/logos/' . $filename;
        }

        $store->update($data);
        return redirect()->route('dashboard.toko')->with('success', 'Informasi toko berhasil diperbarui!');
    }
}

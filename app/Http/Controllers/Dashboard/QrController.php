<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\QrCode;
use App\Models\Store;
use Illuminate\Http\Request;

class QrController extends Controller
{
    public function index()
    {
        $store  = Store::where('user_id', session('user_id'))->firstOrFail();
        $qrCode = $store->qrCode;
        return view('dashboard.qr', compact('store', 'qrCode'));
    }

    public function upload(Request $request)
    {
        $request->validate(['qr_image' => 'required|image|mimes:jpg,png|max:2048']);
        $store = Store::where('user_id', session('user_id'))->firstOrFail();

        $file     = $request->file('qr_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/qr'), $filename);

        $qrCode = $store->qrCode ?? new QrCode(['store_id' => $store->id]);
        $qrCode->qr_image = 'uploads/qr/' . $filename;
        $qrCode->save();

        return redirect()->route('dashboard.qr')->with('success', 'QR Code berhasil diupload!');
    }

    public function saveLinks(Request $request)
    {
        $store  = Store::where('user_id', session('user_id'))->firstOrFail();
        $qrCode = $store->qrCode ?? new QrCode(['store_id' => $store->id]);
        $qrCode->instagram_link = $request->instagram_link;
        $qrCode->facebook_link  = $request->facebook_link;
        $qrCode->save();

        return redirect()->route('dashboard.qr')->with('success', 'Link sosial media berhasil disimpan!');
    }

    public function deleteQr()
    {
        $store  = Store::where('user_id', session('user_id'))->firstOrFail();
        if ($store->qrCode) {
            $store->qrCode->delete();
        }
        return redirect()->route('dashboard.qr')->with('success', 'QR Code berhasil dihapus!');
    }
}

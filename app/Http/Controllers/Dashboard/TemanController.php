<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Friend;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class TemanController extends Controller
{
    public function index(Request $request)
    {
        $userId = session('user_id');

        $accepted = Friend::where(function ($q) use ($userId) {
            $q->where('user_id', $userId)->orWhere('friend_id', $userId);
        })->where('status', 'accepted')->with(['user', 'friendUser'])->get();

        $incoming = Friend::where('friend_id', $userId)->where('status', 'pending')->with('user')->get();
        $outgoing = Friend::where('user_id', $userId)->where('status', 'pending')->with('friendUser')->get();

        $friendIds = $accepted->map(function ($f) use ($userId) {
            return $f->user_id == $userId ? $f->friend_id : $f->user_id;
        })->toArray();
        $pendingIds   = Friend::where('user_id', $userId)->pluck('friend_id')->toArray();
        $incomingIds  = $incoming->pluck('user_id')->toArray();
        $excludeIds   = array_unique(array_merge($friendIds, $pendingIds, $incomingIds));

        $suggestions = User::where('id', '!=', $userId)
            ->whereNotIn('id', $excludeIds)
            ->where('role', 'umkm')
            ->with('store')
            ->take(8)
            ->get();

        $totalUmkm = User::where('role', 'umkm')->count();

        return view('dashboard.teman', compact('accepted', 'incoming', 'outgoing', 'suggestions', 'totalUmkm'));
    }

    public function daftarTeman()
    {
        $userId   = session('user_id');
        $accepted = Friend::where(function ($q) use ($userId) {
            $q->where('user_id', $userId)->orWhere('friend_id', $userId);
        })->where('status', 'accepted')->with(['user.store', 'friendUser.store'])->get();

        $incoming = Friend::where('friend_id', $userId)->where('status', 'pending')->with('user.store')->get();
        $outgoing = Friend::where('user_id', $userId)->where('status', 'pending')->count();

        return view('dashboard.daftar-teman', compact('accepted', 'incoming', 'outgoing', 'userId'));
    }

    public function add($friendId)
    {
        $userId = session('user_id');

        if ($friendId == $userId) {
            return back()->with('error', 'Tidak dapat menambahkan diri sendiri.');
        }

        $exists = Friend::where('user_id', $userId)->where('friend_id', $friendId)->exists()
                || Friend::where('user_id', $friendId)->where('friend_id', $userId)->exists();

        if (!$exists) {
            Friend::create(['user_id' => $userId, 'friend_id' => $friendId, 'status' => 'pending']);
        }
        return back()->with('success', 'Permintaan pertemanan terkirim!');
    }

    public function accept($friendId)
    {
        $userId = session('user_id');
        Friend::where('user_id', $friendId)->where('friend_id', $userId)->update(['status' => 'accepted']);
        return back()->with('success', 'Permintaan diterima!');
    }

    public function remove($friendId)
    {
        $userId = session('user_id');
        Friend::where(function ($q) use ($userId, $friendId) {
            $q->where('user_id', $userId)->where('friend_id', $friendId);
        })->orWhere(function ($q) use ($userId, $friendId) {
            $q->where('user_id', $friendId)->where('friend_id', $userId);
        })->delete();

        return back()->with('success', 'Teman berhasil dihapus!');
    }
}

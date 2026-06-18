<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProdukController;
use App\Http\Controllers\Dashboard\PromoDashboardController;
use App\Http\Controllers\Dashboard\QrController;
use App\Http\Controllers\Dashboard\TemanController;
use App\Http\Controllers\Dashboard\TokoController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/umkm', [UmkmController::class, 'index'])->name('umkm.index');
Route::get('/umkm/{id}', [UmkmController::class, 'show'])->name('umkm.show');
Route::get('/umkm/{id}/qr', [UmkmController::class, 'qr'])->name('umkm.qr');

Route::get('/produk', [ProductController::class, 'index'])->name('produk.index');
Route::get('/umkm/{storeId}/produk/{productId}', [ProductController::class, 'show'])->name('produk.show');

Route::get('/promo', [PromoController::class, 'index'])->name('promo.index');

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/services/provider-umkm', [PageController::class, 'providerUmkm'])->name('services.provider');
Route::get('/services/managing-store', [PageController::class, 'managingStore'])->name('services.managing');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard routes (protected)
Route::middleware('auth.manual')->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/toko', [TokoController::class, 'edit'])->name('toko');
    Route::post('/toko', [TokoController::class, 'update'])->name('toko.update');
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::post('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
    Route::get('/qr', [QrController::class, 'index'])->name('qr');
    Route::post('/qr/upload', [QrController::class, 'upload'])->name('qr.upload');
    Route::post('/qr/links', [QrController::class, 'saveLinks'])->name('qr.links');
    Route::delete('/qr', [QrController::class, 'deleteQr'])->name('qr.delete');
    Route::get('/teman', [TemanController::class, 'index'])->name('teman');
    Route::get('/daftar-teman', [TemanController::class, 'daftarTeman'])->name('daftar-teman');
    Route::post('/teman/{id}/add', [TemanController::class, 'add'])->name('teman.add');
    Route::post('/teman/{id}/accept', [TemanController::class, 'accept'])->name('teman.accept');
    Route::delete('/teman/{id}', [TemanController::class, 'remove'])->name('teman.remove');
    Route::get('/promo', [PromoDashboardController::class, 'index'])->name('promo');
    Route::post('/promo', [PromoDashboardController::class, 'store'])->name('promo.store');
    Route::post('/promo/{id}', [PromoDashboardController::class, 'update'])->name('promo.update');
    Route::delete('/promo/{id}', [PromoDashboardController::class, 'destroy'])->name('promo.destroy');
});

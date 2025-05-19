<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/booking/{id_lapang}/{id_sesi}', [HomeController::class, 'addToCart'])->name('addToCart');

Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::post('cart', [HomeController::class, 'checkout'])->name('checkout');
Route::post('cart/remove/{id}', [HomeController::class, 'remove_cart'])->name('remove_cart');
Route::get('/sesi', [HomeController::class, 'all_sesi'])->name('sesi');


Route::get('diskon', [DiskonController::class, 'show'])->name('diskon.show');

Route::get('/lapangan/{id}', [LapanganController::class, 'show'])->name('lapangan.detail');


Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::get('/jadwal/{tgl}' , [OrderController::class, 'get_jadwal_per_hari'])->name('jadwal');
Route::get('/order/detail/{id}', [OrderController::class, 'detail'])->name('order.detail');
Route::post('/booking', [OrderController::class, 'store'])->name('booking.store');

Route::get('profile', [UserController::class, 'profile'])->name('profile');
Route::get('profile/{id}', [UserController::class, 'profile_by_id'])->name('profile.id');
Route::put('profile/{id}', [UserController::class, 'profile_update'])->name('profile.update');


//login google
Route::controller(GoogleController::class)->group(function () {
    Route::get('/auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('/auth/google/callback', 'handleGoogleCallback');
});

Route::prefix('admin')->group(function () {
    // Route::get('absensi', [DashboardController::class, 'index'])->('dashboard.absensi');
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard.absensi');
    Route::get('artikel', [ArtikelController::class, 'index'])->name('artikel.index');
    Route::get('artikel-create', [ArtikelController::class, 'create'])->name('artikel.create');
    Route::post('artikel-create', [ArtikelController::class, 'store'])->name('artikel.store');

    Route::get('approval', [ApprovalController::class, 'index'])->name('admin.approval');
    Route::put('approval/{id}', [ApprovalController::class, 'update_setuju'])->name('admin.setuju');
    Route::put('approval/reject/{id}', [ApprovalController::class, 'update_batal'])->name('admin.batal');
});
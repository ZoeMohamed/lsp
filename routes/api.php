<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




// Without Token
Route::post('register', [App\Http\Controllers\ApiController\UserController::class, 'register']);
Route::post('login', [App\Http\Controllers\ApiController\UserController::class, 'login']);



// User Route
Route::middleware(['auth:sanctum', 'role:user'])->prefix('user')->group(function () {

    Route::post('logout', [App\Http\Controllers\ApiController\UserController::class, 'logout']);

    // Peminjaman
    Route::prefix('peminjaman')->controller(App\Http\Controllers\ApiController\PeminjamanController::class)->group(function () {
        Route::post('store', 'store_peminjaman');
        Route::get('/', 'show_peminjaman');
        // Route::get('/{buku_id}', 'spec_peminjaman');
    });

    // Pengembalian
    Route::prefix('pengembalian')->controller(App\Http\Controllers\ApiController\PeminjamanController::class)->group(function () {
        Route::post('store', 'store_pengembalian');
        Route::get('/', 'show_pengembalian');
    });

    // User Profile Update


    Route::prefix('profile')->controller(App\Http\Controllers\ApiController\ProfileController::class)->group(function () {
        Route::post('update', 'update_profile');
        Route::get('/', 'show_profile');
    });
});

// Admin Route
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {


    Route::post('logout', [App\Http\Controllers\ApiController\UserController::class, 'logout']);

    // Buku

    
    Route::prefix('buku')->controller(App\Http\Controllers\ApiController\BukuController::class)->group(function () {
        Route::post('store', 'store');
        Route::post('update/{id}', 'update');
        Route::post('delete/{id}', 'destroy');
        Route::get('/', 'all');
        // Route::get('/{id}', 'show');
    });


    //Penerbit
    Route::prefix('penerbit')->controller(App\Http\Controllers\ApiController\PenerbitController::class)->group(function () {
        Route::post('store',  'store');
        Route::post('update/{id}', 'update');
        Route::post('delete/{id}', 'destroy');
        Route::get('/', 'all');
    });

    // Kategori
    Route::prefix('kategori')->controller(App\Http\Controllers\ApiController\KategoriController::class)->group(function () {
        Route::post('store',  'store');
        Route::post('update/{id}', 'update');
        Route::post('delete/{id}', 'destroy');
        Route::get('/', 'all');
    });

    // Pesan
    Route::prefix('pesan')->controller(App\Http\Controllers\ApiController\PesanController::class)->group(function () {
        Route::post('store',  'store');
        Route::post('update/{id}', 'update');
        Route::post('delete/{id}', 'destroy');
        Route::get('/', 'all');
    });

    // Anggota
    Route::prefix('anggota')->controller(App\Http\Controllers\ApiController\UserController::class)->group(function () {
        Route::post('store',  'store_anggota');
        Route::post('update/{id}', 'update_anggota');
        Route::post('delete/{id}', 'destroy_anggota');
        Route::get('/', 'all_anggota');
    });

    // Data Peminjam
    Route::prefix('peminjam')->controller(App\Http\Controllers\ApiController\PeminjamanController::class)->group(function () {
        Route::get('/', 'all_peminjam');
    });

    // Administrator
    Route::prefix('admin')->controller(App\Http\Controllers\ApiController\UserController::class)->group(function () {
        Route::post('store',  'store_admin');
        Route::post('update/{id}', 'update_admin');
        Route::post('delete/{id}', 'destroy_admin');
        Route::get('/', 'all_admin');
    });

    // Identitas
    Route::prefix('identitas')->controller(App\Http\Controllers\ApiController\IdentitasController::class)->group(function () {
        Route::post('update/{id}', 'update');
        Route::get('/', 'all');
    });


    // Pemberitahuan
    Route::prefix('pemberitahuan')->controller(App\Http\Controllers\ApiController\PemberitahuanController::class)->group(function () {
        Route::get('/', 'all');
    });
});

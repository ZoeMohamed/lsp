<?php

use Illuminate\Support\Facades\Auth;
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



Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes();



Route::get('/home', function () {
    if (Auth::user()->role == 'admin') {

        return redirect()->route('admin.dashboard');
    }
    if (Auth::user()->role == 'user') {
        return redirect()->route('user.dashboard');
    }
})->middleware('auth');


Route::group(['middleware' => 'auth'], function () {
    // User Route
    Route::prefix('/user')->group(function () {

        Route::group(['middleware' => 'role:user'], function () {
            // Dashboard
            Route::get('dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('user.dashboard');

            // Peminjaman
            Route::controller(App\Http\Controllers\User\PeminjamanController::class)->group(function () {
                Route::get('peminjaman', 'all_history')->name('user.peminjaman.index');
                Route::get('form_peminjaman', 'form_peminjaman_get')->name('user.form_peminjaman');
                Route::post('form_peminjaman', 'form_peminjaman_post')->name('user.form_peminjaman_dashboard');
                Route::post('submit_peminjaman', 'submit_peminjaman')->name('user.submit_peminjaman');
            });

            // Pengembalian
            Route::controller(App\Http\Controllers\User\PengembalianController::class)->group(function () {
                Route::get('pengembalian', 'all_history')->name('user.pengembalian');
                Route::get('form_pengembalian', 'form_pengembalian_get')->name('user.form_pengembalian');
                Route::post('form_pengembalian', 'form_pengembalian_post')->name('user.form_pengembalian');
                Route::post('submit_pengembalian', 'submit_pengembalian')->name('user.submit_pengembalian');
            });

            // Pesan
            Route::controller(App\Http\Controllers\User\PesanController::class)->group(function () {
                Route::get('pesan_terkirim', 'pesan_terkirim')->name('user.pesan_terkirim');
                Route::get('pesan_masuk', 'pesan_masuk')->name('user.pesan_masuk');
                Route::post('kirim_pesan', 'kirim_pesan')->name('user.kirim_pesan');
                Route::post('delete_pesan/{id}', 'delete_pesan')->name('user.delete_pesan');
                Route::post('edit_status_pesan/{id}', 'edit_status')->name('user.edit_status_pesan');
            });

            // Profile
            Route::controller(App\Http\Controllers\User\ProfileController::class)->group(function () {
                Route::get('profile', 'show_profile')->name('user.profile');
                Route::get('edit_password', 'show_password')->name('user.password');
                Route::post('edit_password', 'update_password')->name('user.password.update');
                Route::put('profile', 'update_profile')->name('user.profil.update');
            });
        });
    });

    Route::group(['middleware' => 'auth'], function () {
        // Admin Route
        Route::prefix('/admin')->group(function () {
            Route::group(['middleware' => 'role:admin'], function () {

                // Dashboard
                Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

                // Anggota
                Route::prefix('data_anggota')->controller(App\Http\Controllers\Admin\AnggotaController::class)->group(function () {
                    Route::get('/', 'index')->name('admin.data_anggota');
                    Route::post('/store', 'store')->name('admin.tambah_anggota');
                    Route::post('/update{id}', 'update')->name('admin.update_anggota');
                    Route::post('/delete{id}', 'destroy')->name('admin.delete_anggota');
                    Route::post('/update_status/{id}', 'update_status')->name('admin.update_status_anggota');
                });

                // Penerbit
                Route::prefix('data_penerbit')->controller(App\Http\Controllers\Admin\PenerbitController::class)->group(function () {
                    Route::get('/', 'index')->name('admin.data_penerbit');
                    Route::post('/store', 'store')->name('admin.tambah_penerbit');
                    Route::post('/update{id}', 'update')->name('admin.update_penerbit');
                    Route::post('/delete{id}', 'destroy')->name('admin.delete_penerbit');
                    Route::post('/update_status/{id}', 'update_status')->name('admin.update_status_penerbit');
                });

                // Administrator
                Route::prefix('data_admin')->controller(App\Http\Controllers\Admin\AdministratorController::class)->group(function () {
                    Route::get('/', 'index')->name('admin.data_admin');
                    Route::post('/store', 'store')->name('admin.tambah_admin');
                    Route::post('/update{id}', 'update')->name('admin.update_admin');
                    Route::post('/delete{id}', 'destroy')->name('admin.delete_admin');
                });

                // Data Peminjaman
                Route::prefix('data_peminjaman')->controller(App\Http\Controllers\Admin\PeminjamanController::class)->group(function () {
                    Route::get('/', 'index')->name('admin.data_peminjaman');
                });

                // Buku
                Route::prefix('data_buku')->controller(App\Http\Controllers\Admin\BukuController::class)->group(function () {
                    Route::get('/', 'index')->name('admin.data_buku');
                    Route::post('/store', 'store')->name('admin.tambah_buku');
                    Route::post('/update{id}', 'update')->name('admin.update_buku');
                    Route::post('/delete{id}', 'destroy')->name('admin.delete_buku');
                });

                // Kategori
                Route::prefix('data_kategori')->controller(App\Http\Controllers\Admin\KategoriController::class)->group(function () {
                    Route::get('/', 'index')->name('admin.data_kategori');
                    Route::post('/store', 'store')->name('admin.tambah_kategori');
                    Route::post('/update{id}', 'update')->name('admin.update_kategori');
                    Route::post('/delete{id}', 'destroy')->name('admin.delete_kategori');
                });

                // Pesan
                Route::controller(App\Http\Controllers\Admin\PesanController::class)->group(function () {
                    Route::get('pesan_terkirim', 'pesan_terkirim')->name('admin.pesan_terkirim');
                    Route::get('pesan_masuk', 'pesan_masuk')->name('admin.pesan_masuk');
                    Route::post('kirim_pesan', 'kirim_pesan')->name('admin.kirim_pesan');
                    Route::post('delete_pesan/{id}', 'delete_pesan')->name('admin.delete_pesan');
                    Route::post('edit_status_pesan/{id}', 'edit_status')->name('admin.edit_status_pesan');
                });

                // Report
                Route::controller(App\Http\Controllers\Admin\PdfController::class)->group(function () {
                    Route::get('report_peminjaman', 'get_peminjaman')->name('admin.report_peminjaman');
                    Route::post('report_peminjaman', 'download_peminjaman')->name('admin.download_peminjaman');
                    Route::get('report_pengembalian', 'get_pengembalian')->name('admin.report_pengembalian');
                    Route::post('report_pengembalian', 'download_pengembalian')->name('admin.download_pengembalian');
                    Route::get('report_user', 'get_user')->name('admin.report_user');
                    Route::post('report_user', 'download_user')->name('admin.download_user');
                });

                // Identitas
                Route::controller(App\Http\Controllers\Admin\IdentitasController::class)->group(function () {
                    Route::get('identitas', 'get_identitas')->name('admin.identitas');
                    Route::put('identitas', 'update_identitas')->name('admin.identitas.update');
                });
            });
        });
    });
});

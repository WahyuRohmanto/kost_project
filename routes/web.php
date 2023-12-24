<?php

use Illuminate\Support\Facades\Route;
// import controller
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\KostController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ProfileController;
// import controller subfolder
use App\Http\Controllers\Customer\InfoKostController;
use App\Http\Controllers\Auth\UsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RekomendasiKostController;
use App\Http\Controllers\Admin\RekomendasikanController;
use App\Http\Middleware\Role;

use App\Http\Controllers\Customer\DetailTersediaController;
use App\Http\Controllers\Pemilik\PemilikController;
use Illuminate\Http\Resources\Json\ResourceCollection;




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

Auth::routes();

// Landing Page
Route::view('/daftar', 'landingpage.daftar');
Route::view('/register-pemilik', 'auth.register-pemilik');

// Owner Dashboard
Route::middleware(['auth', 'owner'])->group(function () {
    Route::view('dashboards', 'landingpage.dashboard');
    Route::get('dashboards', [PembayaranController::class, 'penyewa']);
    Route::get('detail-customer/{id}', [InfoKostController::class, 'show']);
    // Route::get('detail-tersedia/{id}', [DetailTersediaController::class, 'detail_tersedia']);
    Route::resource('kamar', InfoKostController::class);
    Route::resource('/data-pemilik', PemilikController::class);
    Route::get('pesanan', [PemilikController::class, 'pesanan']);
    Route::get('kost-pdf-pemilik', [PemilikController::class, 'cetakKost']);
    Route::get('kost-excel-pemilik', [PemilikController::class, 'print']);
    Route::put('/pembayaran_pemilik/{totalBayar}', [PembayaranController::class, 'pemPemilik'])->name('pembayaran.pembayaran_pemilik');
});

// Admin Dashboard
Route::middleware(['auth', 'isadmin'])->group(function () {
    Route::get('/administrator', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/fasilitas', FasilitasController::class);
    Route::resource('/kost', KostController::class);
    Route::resource('/rekomendasi', RekomendasikanController::class);
    Route::get('kost-edit/{id}', [KostController::class, 'edit']);
    Route::get('fasilitas-edit/{id}', [FasilitasController::class, 'edit']);
    Route::get('detail_product/{id}', [KostController::class, 'detail']);
    Route::get('generate-pdf', [KostController::class, 'generatePDF']);
    Route::get('kost-pdf', [KostController::class, 'kostPDF']);
    Route::get('kost-excel', [KostController::class, 'exportExcel']);
    Route::get('fasilitas-pdf', [FasilitasController::class, 'fasilitasPDF']);
    Route::get('fasilitas-excel', [FasilitasController::class, 'fasilitasExcel']);
    Route::get('pembayaran-pdf', [PembayaranController::class, 'pembayaranPDF']);
    Route::get('pembayaran-excel', [PembayaranController::class, 'pembayaranExcel']);
    Route::get('users-pdf', [UsersController::class, 'usersPDF']);
    Route::get('users-excel', [UsersController::class, 'usersExcel']);
    Route::resource('/users', UsersController::class);
    Route::get('/user-edit/{id}', [UsersController::class, 'edit']);
    Route::get('dashboard', [DashboardController::class, 'index']);
});

// Access Denied
Route::get('/access-denied', function () {
    return view('admin.access_denied');
})->middleware('auth')->name('access-denied');

// Landing Page and InfoKost for Customers
Route::resource('/', InfoKostController::class);
Route::resource('/beranda', InfoKostController::class);
Route::resource('kamar', InfoKostController::class)->middleware('auth');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/invoice', [PembayaranController::class, 'invoiceCustomer'])->name('invoice');
Route::get('history', [PembayaranController::class, 'transaksiCustomer'])->name('history');
Route::resource('/detailCustomer', InfoKostController::class)->middleware('auth');
Route::resource('/pembayaran', PembayaranController::class);
Route::resource('/pembayaran', PembayaranController::class);
Route::resource('customer-profile', ProfileController::class);







// Auth::routes();

// // Routing Landing Page
// // Route::get('/coba/{id}', [UsersController::class], 'show');

// Route::resource('/', InfoKostController::class ); //well
// Route::resource('/beranda', InfoKostController::class ); //well

// Route::view('/daftar', 'landingpage.daftar'); //well
// // route register pemilik
// Route::view('/register-pemilik', 'auth.register-pemilik'); //well
// Route::view('dashboards', 'landingpage.dashboard')->middleware(['auth', 'owner']); //well
// Route::get('dashboards', [PembayaranController::class, 'penyewa'])->middleware(['auth', 'owner']); //well
// Route::get('detail-customer/{id}', [InfoKostController::class, 'show']
// ); //well

// Route::get('detail-tersedia/{id}', [DetailTersediaController::class, 'detail_tersedia']
// ); //well

// // Route::get('pemilik-edit/{id}', [PemilikController::class, 'edit'])->middleware(['auth', 'owner']);;

// // ROUTE ADMIN
// Route::middleware(['auth', 'isadmin'])->group(function () {
//     Route::get('/administrator', [DashboardController::class, 'index'])->name('admin.dashboard');
//     Route::resource('/fasilitas', FasilitasController::class);
//     Route::resource('/kost', KostController::class);
//     Route::resource('/pembayaran', PembayaranController::class);
//     Route::resource('/rekomendasi', RekomendasikanController::class);
//     Route::get('kost-edit/{id}', [KostController::class, 'edit']);
//     Route::get('fasilitas-edit/{id}', [FasilitasController::class, 'edit']);
//     Route::get('detail_product/{id}', [KostController::class, 'detail']);
//     Route::get('generate-pdf', [KostController::class, 'generatePDF']);
//     Route::get('kost-pdf', [KostController::class, 'kostPDF']);
//     Route::get('kost-excel', [KostController::class, 'exportExcel']);
//     Route::get('fasilitas-pdf', [FasilitasController::class, 'fasilitasPDF']);
//     Route::get('fasilitas-excel', [FasilitasController::class, 'fasilitasExcel']);
//     Route::get('pembayaran-pdf', [PembayaranController::class, 'pembayaranPDF']);
//     Route::get('pembayaran-excel', [PembayaranController::class, 'pembayaranExcel']);
//     Route::get('users-pdf', [UsersController::class, 'usersPDF'] );
//     Route::get('users-excel', [UsersController::class, 'usersExcel'] );
//     Route::resource('/users', UsersController::class);
//     Route::get('/user-edit/{id}', [UsersController::class, 'edit']);
//     Route::get('dashboard', [DashboardController::class, 'index']);
// });


// // Route Access Denied
// Route::get('/access-denied', function () {
//     return view('admin.access_denied');
// })->middleware('auth')->name('access-denied');

// /**
//  * ROUTE CUSTOMER
//  * - info kos
//  * - detail kamar
//  */
// Route::resource('kamar', InfoKostController::class)->middleware('auth');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); 

// Route::resource('/data-pemilik', PemilikController::class)->middleware(['auth', 'owner']);
// Route::get('pesanan', [PemilikController::class, 'pesanan'])->middleware(['auth', 'owner']);
// Route::get('kost-pdf-pemilik', [PemilikController::class, 'cetakKost'])->middleware(['auth', 'owner']);
// Route::get('kost-excel-pemilik', [PemilikController::class, 'print'])->middleware(['auth', 'owner']);
// Route::resource('/detailCustomer', InfoKostController::class); //well
// Route::resource('/pembayaran', PembayaranController::class)->middleware('auth');
// Route::get('/invoice', [PembayaranController::class, 'invoiceCustomer'])->name('invoice')->middleware('auth');
// Route::get('history' ,[PembayaranController::class, 'transaksiCustomer'])->name('history')->middleware('auth');

// // Route::view('history', 'landingpage.history')->name('history');
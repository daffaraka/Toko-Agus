<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\{
    PelunasanPembelianController,
    PenjualanController,
    TransaksiPembelianController,
    TransaksiPenjualanController,
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboardbootstrap', function () {
    return view('dashboardbootstrap');
})->middleware(['auth', 'verified'])->name('dashboardbootstrap');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    // untuk master data pelanggan
    Route::resource('pelanggan', App\Http\Controllers\PelangganController::class)->middleware(['auth']);
    Route::get('/pelanggan/destroy/{id}', [App\Http\Controllers\PelangganController::class, 'destroy'])->middleware(['auth']);

    // untuk master data coa
    // jika ingin menambahkan routes baru selain default resource di tambah di awal
    // sebelum route resource
    Route::get('/coa/fetchcoa', [App\Http\Controllers\CoaController::class, 'fetchcoa'])->middleware(['auth']);
    Route::get('/coa/edit/{id}', [App\Http\Controllers\CoaController::class, 'edit'])->middleware(['auth']);
    Route::get('/coa/destroy/{id}', [App\Http\Controllers\CoaController::class, 'destroy'])->middleware(['auth']);

    Route::resource('supplier', App\Http\Controllers\SupplierController::class)->middleware(['auth']);
    Route::get('/fetchsupplier', [App\Http\Controllers\SupplierController::class, 'fetchsupplier'])->middleware(['auth']);
    Route::get('/supplier/edit/{id}', [App\Http\Controllers\SupplierController::class, 'edit'])->middleware(['auth']);
    Route::get('/supplier/destroy/{id}', [App\Http\Controllers\SupplierController::class, 'destroy'])->middleware(['auth']);

    // untuk master data barang
    // jika ingin menambahkan routes baru selain default resource di tambah di awal
    // sebelum route resource
    Route::resource('barang', App\Http\Controllers\BarangController::class)->middleware(['auth']);
    Route::get('/barang/fetchbarang', [App\Http\Controllers\BarangController::class, 'fetchbarang'])->middleware(['auth']);
    Route::get('/barang/edit/{id}', [App\Http\Controllers\BarangController::class, 'edit'])->middleware(['auth']);
    Route::get('/barang/destroy/{id}', [App\Http\Controllers\BarangController::class, 'destroy'])->middleware(['auth']);
    // untuk transaksi penjualan


    Route::get('transaksi-penjualan', [TransaksiPenjualanController::class, 'index'])->name('penjualan.index');
    Route::get('transaksi-penjualan/create', [TransaksiPenjualanController::class, 'create'])->name('penjualan.create');
    Route::post('transaksi-penjualan/store', [TransaksiPenjualanController::class, 'store'])->name('penjualan.store');
    Route::get('transaksi-penjualan/edit/{id}', [TransaksiPenjualanController::class, 'edit'])->name('penjualan.edit');
    Route::post('transaksi-penjualan/update/{id}', [TransaksiPenjualanController::class, 'update'])->name('penjualan.update');
    Route::get('transaksi-penjualan/delete/{id}', [TransaksiPenjualanController::class, 'destroy'])->name('penjualan.delete');


    Route::get('transaksi-pembelian', [TransaksiPembelianController::class, 'index'])->name('pembelian.index');
    Route::get('transaksi-pembelian/create', [TransaksiPembelianController::class, 'create'])->name('pembelian.create');
    Route::post('transaksi-pembelian/store', [TransaksiPembelianController::class, 'store'])->name('pembelian.store');
    Route::get('transaksi-pembelian/edit/{id}', [TransaksiPembelianController::class, 'edit'])->name('pembelian.edit');
    Route::post('transaksi-pembelian/update/{id}', [TransaksiPembelianController::class, 'update'])->name('pembelian.update');
    Route::get('transaksi-pembelian/delete/{id}', [TransaksiPembelianController::class, 'destroy'])->name('pembelian.delete');


    Route::get('pelunasan-pembelian', [PelunasanPembelianController::class, 'index'])->name('pelunasanPembelian.index');
    Route::get('pelunasan-pembelian/create', [PelunasanPembelianController::class, 'create'])->name('pelunasanPembelian.create');
    Route::post('pelunasan-pembelian/store', [PelunasanPembelianController::class, 'store'])->name('pelunasanPembelian.store');
    Route::get('pelunasan-pembelian/edit/{id}', [PelunasanPembelianController::class, 'edit'])->name('pelunasanPembelian.edit');
    Route::get('pelunasan-pembelian/pembayaran/{id}', [PelunasanPembelianController::class, 'pembayaran'])->name('pelunasanPembelian.pembayaran');

    Route::post('pelunasan-pembelian/update/{id}', [PelunasanPembelianController::class, 'update'])->name('pelunasanPembelian.update');
    Route::get('pelunasan-pembelian/delete/{id}', [PelunasanPembelianController::class, 'destroy'])->name('pelunasanPembelian.delete');
});

// Route::get('/penjualan', [App\Http\Controllers\PenjualanController::class, 'index'])->name('penjualan.index');
// Route::post('/penjualan', [App\Http\Controllers\PenjualanController::class, 'store'])->name('penjualan.store');



Route::resource('coa', App\Http\Controllers\CoaController::class)->middleware(['auth']);

Route::get('/transaksi/baru', [PenjualanController::class, 'create'])->name('transaksi.baru');
// Route::resource('/penjualan', PenjualanController::class)->except('show');
// Route::resource('/pelunasan', PelunasanController::class)->except('show');
require __DIR__ . '/auth.php';

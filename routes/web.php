<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Exports\CardStockExport;
use App\Exports\MasterStockExport;
use App\Exports\MutasiStockExport;
use App\Exports\PesananUserExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/dashboard', function () {
    $role = Auth::user()->role;

    return match($role) {
        'admin' => view('admin.dashboard'),
        'user' => view('user.dashboard'),
        'petugas_gudang' => view('petugas.dashboard'),
        default => abort(403),
    };
})->middleware(['auth'])->name('dashboard');

Route::get('/reports', function () {
    $role = Auth::user()->role;

    return match($role) {
        'admin' => view('admin.reports'),
        'user' => view('user.reports'),
        'petugas_gudang' => view('petugas.reports'),
        default => abort(403),
    };
})->middleware(['auth'])->name('master');

Route::get('/master', function () {
    $role = Auth::user()->role;

    return match($role) {
        'admin' => view('admin.master'),
        'user' => view('user.master'),
        'petugas_gudang' => view('petugas.master'),
        default => abort(403),
    };
})->middleware(['auth'])->name('master');

Route::get('/mutasi', function () {
    $role = Auth::user()->role;

    return match($role) {
        'admin' => view('admin.mutasi'),
        'user' => view('user.mutasi'),
        'petugas_gudang' => view('petugas.mutasi'),
        default => abort(403),
    };
})->middleware(['auth'])->name('mutasi');

Route::get('/card', function () {
    $role = Auth::user()->role;

    return match($role) {
        'admin' => view('admin.card'),
        'user' => view('user.card'),
        'petugas_gudang' => view('petugas.card'),
    };
})->middleware(['auth'])->name('card');

Route::get('/detail', function () {
    $role = Auth::user()->role;

    return match($role) {
        'admin' => view('admin.detail'),
        
    };
})->middleware(['auth'])->name('detail');



Route::get('/export-card-stock', function () {
    $kode_barang = request('kode_barang', '');
    $nama_barang = request('nama_barang', '');
    $periode_awal = request('periode_awal', now()->subMonth()->format('Y-m-d'));
    $periode_akhir = request('periode_akhir', now()->format('Y-m-d'));

    return Excel::download(
        new CardStockExport($kode_barang, $nama_barang, $periode_awal, $periode_akhir),
        'card_stock.xlsx'
    );
})->name('card-stock.export');

Route::get('/export-master-stock', function () {
    return Excel::download(new MasterStockExport, 'master_stock.xlsx');
})->name('master-stock.export');

Route::get('/export-mutasi-stock', function () {
    return Excel::download(new MutasiStockExport, 'mutasi_stock.xlsx');
})->name('mutasi-stock.export');

Route::get('/export-pesanan-user', function () {
    return Excel::download(new PesananUserExport, 'pesanan_user.xlsx');
})->name('pesanan-user.export');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
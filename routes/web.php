<?php

/**
 * Licensed to Pinayungan Sadewa Buwana
 * All rights reserved.
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterLokasiController;
use App\Http\Controllers\MasterRuanganController;
use App\Http\Controllers\MasterKlasifikasiController;
use App\Http\Controllers\MasterJenisBarangController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\MutasiAsetController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Api\DropdownController;

// ─── Auth (Public) ───────────────────────────────────────────
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// ─── Public: QR Inventaris Ruangan (bisa diakses tanpa login) ─
Route::get('ruangan/{ruangan}/inventaris', [QrCodeController::class, 'inventaris'])->name('ruangan.inventaris');

// ─── Protected Routes (harus login) ─────────────────────────
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data
    Route::resource('master/lokasi', MasterLokasiController::class)->names('master.lokasi')->parameters(['lokasi' => 'lokasi']);
    Route::resource('master/ruangan', MasterRuanganController::class)->names('master.ruangan')->parameters(['ruangan' => 'ruangan']);
    Route::resource('master/klasifikasi', MasterKlasifikasiController::class)->names('master.klasifikasi')->parameters(['klasifikasi' => 'klasifikasi']);
    Route::resource('master/jenis-barang', MasterJenisBarangController::class)->names('master.jenis-barang')->parameters(['jenis-barang' => 'jenisBarang']);

    // Aset
    Route::resource('aset', AsetController::class);

    // Mutasi
    Route::get('mutasi', [MutasiAsetController::class, 'index'])->name('mutasi.index');
    Route::get('mutasi/create', [MutasiAsetController::class, 'create'])->name('mutasi.create');
    Route::post('mutasi', [MutasiAsetController::class, 'store'])->name('mutasi.store');

    // QR Code Ruangan (batch & PDF — admin only)
    Route::get('qr/batch', [QrCodeController::class, 'printBatch'])->name('qr.batch');
    Route::get('qr/download-pdf', [QrCodeController::class, 'downloadPdf'])->name('qr.download-pdf');

    // Laporan
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/export/excel', [LaporanController::class, 'exportExcel'])->name('laporan.export.excel');
    Route::get('laporan/export/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export.pdf');

    // API (for dependent dropdowns)
    Route::group(
        ['prefix' => 'api'],
        function () {
            Route::get('ruangan', [DropdownController::class, 'ruangan']);
            Route::get('jenis-barang', [DropdownController::class, 'jenisBarang']);
        }
    );
});
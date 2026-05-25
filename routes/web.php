<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZakatController;

Route::get('/', function () {
    return view('zakat');
})->name('zakat');

Route::post('/simpan', [ZakatController::class, 'simpan'])->name('simpan');

Route::get('/riwayat', [ZakatController::class, 'riwayat'])->name('riwayat');

Route::get('/laporan', [ZakatController::class, 'laporan'])->name('laporan');

Route::get('/cetak/{id}', [ZakatController::class, 'cetak'])->name('cetak');

/* TAMBAHAN UNTUK EDIT DAN HAPUS */

Route::get('/edit/{id}', [ZakatController::class, 'edit'])->name('edit');

Route::put('/update/{id}', [ZakatController::class, 'update'])->name('update');

Route::delete('/hapus/{id}', [ZakatController::class, 'hapus'])->name('hapus');
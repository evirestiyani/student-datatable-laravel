<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;

Route::get('/', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('/siswa/data', [SiswaController::class, 'getData'])->name('siswa.data');
Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestBookController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\AuthController;

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Kecamatan Routes (Protected with auth + admin middleware)
Route::middleware('auth')->group(function () {
    Route::get('/kecamatan', [KecamatanController::class, 'index'])->name('kecamatan.index');
    Route::middleware(\App\Http\Middleware\Admin::class)->group(function () {
        Route::get('/kecamatan/create', [KecamatanController::class, 'create'])->name('kecamatan.create');
        Route::post('/kecamatan', [KecamatanController::class, 'store'])->name('kecamatan.store');
        Route::get('/kecamatan/{kecamatan}/edit', [KecamatanController::class, 'edit'])->name('kecamatan.edit');
        Route::put('/kecamatan/{kecamatan}', [KecamatanController::class, 'update'])->name('kecamatan.update');
        Route::delete('/kecamatan/{kecamatan}', [KecamatanController::class, 'destroy'])->name('kecamatan.destroy');
    });
    Route::get('/kecamatan/{kecamatan}', [KecamatanController::class, 'show'])->name('kecamatan.show');
});

// Guest Book Routes (Protected with auth middleware)
Route::middleware('auth')->group(function () {
    Route::redirect('/', '/guest-books', 301);
    Route::get('/guest-books', [GuestBookController::class, 'index'])->name('guest-books.index');
    Route::get('/guest-books/create', [GuestBookController::class, 'create'])->name('guest-books.create');
    Route::post('/guest-books', [GuestBookController::class, 'store'])->name('guest-books.store');
    Route::get('/guest-books/export/pdf', [GuestBookController::class, 'exportPdf'])->name('guest-books.export-pdf');
    Route::get('/guest-books/export/excel', [GuestBookController::class, 'exportExcel'])->name('guest-books.export-excel');
});


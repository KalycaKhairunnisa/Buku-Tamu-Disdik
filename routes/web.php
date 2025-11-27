<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestBookController;
use App\Http\Controllers\AuthController;

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Guest Book Routes (Protected with auth middleware)
Route::middleware('auth')->group(function () {
    Route::redirect('/', '/guest-books', 301);
    Route::get('/guest-books', [GuestBookController::class, 'index'])->name('guest-books.index');
    Route::get('/guest-books/create', [GuestBookController::class, 'create'])->name('guest-books.create');
    Route::post('/guest-books', [GuestBookController::class, 'store'])->name('guest-books.store');
    Route::get('/guest-books/export/pdf', [GuestBookController::class, 'exportPdf'])->name('guest-books.export-pdf');
    Route::get('/guest-books/export/excel', [GuestBookController::class, 'exportExcel'])->name('guest-books.export-excel');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\ProductController;

// Rutas públicas
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Rutas protegidas
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Cotizador
    Route::get('/cotizador', [QuoteController::class, 'index'])->name('cotizador');
    Route::get('/productos', [ProductController::class, 'index'])->name('productos.index');
    Route::post('/cotizacion', [QuoteController::class, 'store'])->name('cotizacion.store');
    Route::get('/cotizacion/{id}/pdf', [QuoteController::class, 'generatePDF'])->name('cotizacion.pdf');
});

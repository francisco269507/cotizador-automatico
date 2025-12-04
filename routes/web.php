<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;

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
    
    // Rutas de Usuario Normal
    Route::get('/user/dashboard', [AdminController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/user/quotes', [AdminController::class, 'userQuotes'])->name('user.quotes');
    Route::get('/user/quotes/{id}', [AdminController::class, 'showUserQuote'])->name('user.quotes.show');
    Route::get('/user/settings', [AdminController::class, 'userSettings'])->name('user.settings');
    Route::post('/user/settings/password', [AdminController::class, 'updateUserPassword'])->name('user.settings.password');
    Route::post('/user/settings/email', [AdminController::class, 'updateUserEmail'])->name('user.settings.email');
    
    // Rutas de SuperAdmin
    Route::middleware('superadmin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Gestión de usuarios
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('users.destroy');
        
        // Gestión de cotizaciones
        Route::get('/quotes', [AdminController::class, 'quotes'])->name('quotes');
        Route::get('/quotes/{id}', [AdminController::class, 'showQuote'])->name('quotes.show');
        
        // Gestión de productos
        Route::get('/products', [AdminController::class, 'products'])->name('products');
        Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('products.edit');
        Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('products.update');
        Route::post('/products/{id}/toggle', [AdminController::class, 'toggleProduct'])->name('products.toggle');
        
        // Configuración
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
    });
});


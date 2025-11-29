<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BicicletaController;
use App\Http\Controllers\AlquilerController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/bicicletas', [BicicletaController::class, 'catalogo'])->name('bicicletas.catalogo');
Route::get('/bicicletas/{bicicleta}', [BicicletaController::class, 'showPublic'])->name('bicicletas.show.public');

Route::get('/mantenimientos', [MantenimientoController::class, 'indexPublic'])->name('mantenimientos.public');

Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrito/agregar/{bicicleta}', [CartController::class, 'add'])->name('cart.add');
Route::post('/carrito/actualizar/{bicicleta}', [CartController::class, 'update'])->name('cart.update');
Route::post('/carrito/eliminar/{bicicleta}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/carrito/checkout', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');
Route::get('/carrito/historial', [CartController::class, 'historial'])->name('cart.historial')->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::get('/mis-alquileres', [AlquilerController::class, 'misAlquileres'])->name('alquileres.mis');
    Route::get('/mis-mantenimientos', [MantenimientoController::class, 'misMantenimientos'])->name('mantenimientos.mis');

    Route::get('/alquiler/individual/nuevo', [AlquilerController::class, 'createIndividual'])->name('alquileres.create.individual');
    Route::post('/alquiler/individual', [AlquilerController::class, 'storeIndividual'])->name('alquileres.store.individual');

    Route::get('/alquiler/corporativo/nuevo', [AlquilerController::class, 'createCorporativo'])->name('alquileres.create.corporativo');
    Route::post('/alquiler/corporativo', [AlquilerController::class, 'storeCorporativo'])->name('alquileres.store.corporativo');

    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::prefix('admin')->name('admin.')->group(function () {
            Route::resource('bicicletas', BicicletaController::class)->except(['show']);
            Route::resource('alquileres', AlquilerController::class)->except(['show', 'create', 'store']);
            Route::resource('mantenimientos', MantenimientoController::class);
        });
    });
});

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

/*
|--------------------------------------------------------------------------
| Autenticación
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

/*
|--------------------------------------------------------------------------
| Páginas públicas
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/bicicletas', [BicicletaController::class, 'catalogo'])->name('bicicletas.catalogo');
Route::get('/bicicletas/{bicicleta}', [BicicletaController::class, 'showPublic'])->name('bicicletas.show.public');

Route::get('/mantenimientos', [MantenimientoController::class, 'indexPublic'])
    ->name('mantenimientos.public');

/*
|--------------------------------------------------------------------------
| Carrito de compras
|--------------------------------------------------------------------------
*/
Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrito/agregar/{bicicleta}', [CartController::class, 'add'])->name('cart.add');
Route::post('/carrito/actualizar/{bicicleta}', [CartController::class, 'update'])->name('cart.update');
Route::post('/carrito/eliminar/{bicicleta}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/carrito/checkout', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Rutas protegidas por autenticación (clientes + admin)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Panel y CRUDs solo para administradores
    Route::middleware('admin')->group(function () {

        Route::get('/admin/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        // CRUD Bicicletas
        Route::resource('/admin/bicicletas', BicicletaController::class)
            ->except(['show']);

        // CRUD Alquileres
        Route::resource('/admin/alquileres', AlquilerController::class);

        // CRUD Mantenimientos
        Route::resource('/admin/mantenimientos', MantenimientoController::class);
    });

    // Flujo principal para usuarios regulares
    Route::get('/mis-alquileres', [AlquilerController::class, 'misAlquileres'])
        ->name('alquileres.mis');

    Route::get('/mis-mantenimientos', [MantenimientoController::class, 'misMantenimientos'])
        ->name('mantenimientos.mis');
});

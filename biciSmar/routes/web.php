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
use App\Http\Controllers\SolicitudCorporativaController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Login / Registro
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Bicicletas públicas
Route::get('/bicicletas', [BicicletaController::class, 'catalogo'])->name('bicicletas.catalogo');
Route::get('/bicicletas/{bicicleta}', [BicicletaController::class, 'showPublic'])->name('bicicletas.show.public');

// Mantenimientos públicos
Route::get('/mantenimientos', [MantenimientoController::class, 'indexPublic'])->name('mantenimientos.public');

// Formulario de solicitud de mantenimiento
Route::middleware('auth')->group(function () {
    Route::get('/mantenimientos/solicitar/{mantenimiento}', [MantenimientoController::class, 'solicitarForm'])
        ->name('mantenimientos.solicitar');
    Route::post('/mantenimientos/solicitar/{mantenimiento}', [MantenimientoController::class, 'enviarSolicitud'])
        ->name('mantenimientos.enviar');
});

// Carrito
Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrito/agregar/{bicicleta}', [CartController::class, 'add'])->name('cart.add');
Route::post('/carrito/actualizar/{bicicleta}', [CartController::class, 'update'])->name('cart.update');
Route::post('/carrito/eliminar/{bicicleta}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/carrito/checkout', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');
Route::get('/carrito/historial', [CartController::class, 'historial'])->name('cart.historial')->middleware('auth');


/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Mis alquileres / mantenimientos
    Route::get('/mis-alquileres', [AlquilerController::class, 'misAlquileres'])->name('alquileres.mis');
    Route::get('/mis-mantenimientos', [MantenimientoController::class, 'misMantenimientos'])->name('mantenimientos.mis');

    /*
    |--------------------------------------------------------------------------
    | Alquiler individual
    |--------------------------------------------------------------------------
    */
    Route::get('/alquiler/individual/nuevo', [AlquilerController::class, 'createIndividual'])
        ->name('alquileres.create.individual');

    Route::post('/alquiler/individual', [AlquilerController::class, 'storeIndividual'])
        ->name('alquileres.store.individual');


    /*
    |--------------------------------------------------------------------------
    | Alquiler corporativo CLÁSICO (el antiguo)
    |--------------------------------------------------------------------------
    */
    Route::get('/alquiler/corporativo/nuevo', [AlquilerController::class, 'createCorporativo'])
        ->name('alquileres.create.corporativo');

    Route::post('/alquiler/corporativo', [AlquilerController::class, 'storeCorporativo'])
        ->name('alquileres.store.corporativo');


    /*
    |--------------------------------------------------------------------------
    | NUEVO MÓDULO: Gestión Corporativa Premium
    |--------------------------------------------------------------------------
    |
    | Las empresas usan este formulario PREMIUM creado en el ZIP.
    |
    */

    // Empresa → formulario premium
    Route::get('/corporativo/solicitar', [SolicitudCorporativaController::class, 'create'])
        ->name('corporativo.create');

    // Empresa → guardar solicitud
    Route::post('/corporativo/solicitar', [SolicitudCorporativaController::class, 'store'])
        ->name('corporativo.store');

    // Empresa → ver solicitudes enviadas
    Route::get('/corporativo/mis-solicitudes', [SolicitudCorporativaController::class, 'misSolicitudes'])
        ->name('corporativo.mis');


    /*
    |--------------------------------------------------------------------------
    | ADMIN Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('admin')->group(function () {

        // Panel principal admin
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // CRUD (ya existentes)
        Route::prefix('admin')->name('admin.')->group(function () {

            Route::resource('bicicletas', BicicletaController::class)->except(['show']);
            Route::resource('alquileres', AlquilerController::class)->except(['show']);
            Route::resource('mantenimientos', MantenimientoController::class);
            Route::get('alquileres-historial', [AlquilerController::class, 'historialAdmin'])->name('alquileres.historial');

            /*
            |--------------------------------------------------------------------------
            | ADMIN — Gestión Corporativa (nuevo módulo premium)
            |--------------------------------------------------------------------------
            */

            Route::get('/corporativo', [SolicitudCorporativaController::class, 'index'])
                ->name('corporativo.index');

            Route::get('/corporativo/{solicitud}', [SolicitudCorporativaController::class, 'show'])
                ->name('corporativo.show');

            Route::put('/corporativo/{solicitud}/estado', [SolicitudCorporativaController::class, 'updateEstado'])
                ->name('corporativo.estado');
        });
    });
});

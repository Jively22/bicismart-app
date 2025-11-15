<?php

use App\Http\Controllers\BicicletaController;
use App\Http\Controllers\AlquilerController;
use App\Http\Controllers\AlquilerCorporativoController;
use App\Http\Controllers\MantenimientoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Auth::routes();

// ✅ RUTAS PÚBLICAS PARA ALQUILER CORPORATIVO (accesibles sin login)
Route::get('/alquiler-corporativo', [AlquilerCorporativoController::class, 'create'])->name('alquiler-corporativo.create');
Route::post('/alquiler-corporativo', [AlquilerCorporativoController::class, 'store'])->name('alquiler-corporativo.store');

// ✅ RUTAS PARA EMPRESAS LOGUEADAS
Route::middleware(['auth'])->group(function () {
    Route::get('/mis-alquileres', [AlquilerCorporativoController::class, 'misAlquileres'])->name('mis-alquileres');
    Route::get('/alquiler-corporativo/confirmacion', [AlquilerCorporativoController::class, 'confirmacion'])->name('alquiler-corporativo.confirmacion');
});

// ✅ RUTAS PROTEGIDAS PARA ADMIN (3 CRUDs completos)
Route::middleware(['auth', 'admin'])->group(function () {
    // CRUD 1: Bicicletas
    Route::resource('bicicletas', BicicletaController::class);
    
    // CRUD 2: Alquileres
    Route::resource('alquileres', AlquilerController::class);
    
    // ✅ CRUD 3: Mantenimientos (NUEVO)
    Route::resource('mantenimientos', MantenimientoController::class);
});

// Ruta del dashboard
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
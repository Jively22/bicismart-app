<?php

use App\Http\Controllers\BicicletaController;
use App\Http\Controllers\AlquilerController;
use App\Http\Controllers\AlquilerCorporativoController;
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

// ✅ RUTAS PROTEGIDAS PARA ADMIN (esto ya existe)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('bicicletas', BicicletaController::class);
    Route::resource('alquileres', AlquilerController::class);
});

// Ruta del dashboard
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
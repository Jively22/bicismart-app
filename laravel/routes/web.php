<?php

use App\Http\Controllers\BicicletaController;
use App\Http\Controllers\AlquilerController;
use App\Http\Controllers\AlquilerCorporativoController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/alquiler-corporativo', [AlquilerCorporativoController::class, 'create'])->name('alquiler-corporativo.create');
Route::post('/alquiler-corporativo', [AlquilerCorporativoController::class, 'store'])->name('alquiler-corporativo.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/mis-alquileres', [AlquilerCorporativoController::class, 'misAlquileres'])->name('mis-alquileres');
    Route::get('/alquiler-corporativo/confirmacion', [AlquilerCorporativoController::class, 'confirmacion'])->name('alquiler-corporativo.confirmacion');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('bicicletas', BicicletaController::class);
    
    Route::resource('alquileres', AlquilerController::class);
    
    Route::resource('mantenimientos', MantenimientoController::class);
    Route::put('/mantenimientos/{mantenimiento}/completar', [MantenimientoController::class, 'completar'])->name('mantenimientos.completar');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
<?php

use App\Http\Controllers\BicicletaController;
use App\Http\Controllers\AlquilerController;
use App\Http\Controllers\AlquilerCorporativoController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CarritoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/alquiler-corporativo', [AlquilerCorporativoController::class, 'create'])->name('alquiler-corporativo.create');
Route::post('/alquiler-corporativo', [AlquilerCorporativoController::class, 'store'])->name('alquiler-corporativo.store');
Route::get('/alquiler-corporativo/confirmacion', [AlquilerCorporativoController::class, 'confirmacion'])->name('alquiler-corporativo.confirmacion');

Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo');

Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/agregar', [CarritoController::class, 'add'])->name('carrito.add');
Route::patch('/carrito/{bicicletaId}', [CarritoController::class, 'update'])->name('carrito.update');
Route::delete('/carrito/{bicicletaId}', [CarritoController::class, 'remove'])->name('carrito.remove');
Route::delete('/carrito', [CarritoController::class, 'clear'])->name('carrito.clear');

Route::view('/nosotros', 'static.nosotros')->name('nosotros');
Route::view('/servicios', 'static.servicios')->name('servicios');
Route::view('/contacto', 'static.contacto')->name('contacto');

Route::middleware(['auth'])->group(function () {
    Route::get('/mis-alquileres', [AlquilerCorporativoController::class, 'misAlquileres'])->name('mis-alquileres');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('bicicletas', BicicletaController::class);
    
    Route::resource('alquileres', AlquilerController::class);
    
    Route::resource('mantenimientos', MantenimientoController::class);
    Route::put('/mantenimientos/{mantenimiento}/completar', [MantenimientoController::class, 'completar'])->name('mantenimientos.completar');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
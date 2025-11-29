@extends('layouts.app')

@section('content')
<h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-6">Panel de administrador</h1>

<div class="grid md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white/90 rounded-3xl shadow-md border border-gray-100 p-4">
        <p class="text-xs text-gray-500 mb-1">Bicicletas registradas</p>
        <p class="text-2xl font-bold text-green-700">{{ $totalBicicletas }}</p>
    </div>
    <div class="bg-white/90 rounded-3xl shadow-md border border-gray-100 p-4">
        <p class="text-xs text-gray-500 mb-1">Alquileres totales</p>
        <p class="text-2xl font-bold text-green-700">{{ $totalAlquileres }}</p>
    </div>
    <div class="bg-white/90 rounded-3xl shadow-md border border-gray-100 p-4">
        <p class="text-xs text-gray-500 mb-1">Servicios de mantenimiento</p>
        <p class="text-2xl font-bold text-green-700">{{ $totalServicios }}</p>
    </div>
    <div class="bg-white/90 rounded-3xl shadow-md border border-gray-100 p-4">
        <p class="text-xs text-gray-500 mb-1">Total vendido</p>
        <p class="text-2xl font-bold text-green-700">S/ {{ number_format($totalVentas, 2) }}</p>
    </div>
</div>

<p class="text-xs text-gray-500">Desde aquí puedes administrar bicicletas, alquileres, mantenimientos y revisar las métricas generales del sistema.</p>
@endsection

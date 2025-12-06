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

<div class="bg-white/90 rounded-3xl shadow-md border border-gray-100 p-4 mb-4">
    <h2 class="text-sm font-semibold text-gray-800 mb-2">Accesos rápidos</h2>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-2 text-sm">
        <a href="{{ route('admin.bicicletas.index') }}" class="px-3 py-2 rounded-lg bg-green-700 text-white text-center hover:bg-green-800">Bicicletas</a>
        <a href="{{ route('admin.alquileres.index') }}" class="px-3 py-2 rounded-lg bg-blue-700 text-white text-center hover:bg-blue-800">Alquileres</a>
        <a href="{{ route('admin.mantenimientos.index') }}" class="px-3 py-2 rounded-lg bg-amber-600 text-white text-center hover:bg-amber-700">Mantenimientos</a>
        <a href="{{ route('admin.corporativo.index') }}" class="px-3 py-2 rounded-lg bg-slate-700 text-white text-center hover:bg-slate-800">Solicitudes corporativas</a>
    </div>
</div>

<p class="text-xs text-gray-500">Desde aquí puedes administrar bicicletas, alquileres, mantenimientos y revisar las métricas generales del sistema.</p>
@endsection

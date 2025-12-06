@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <span class="pill mb-2 inline-flex">Panel</span>
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900">Panel de administrador</h1>
        <p class="text-sm text-gray-600">Resumen de inventario, alquileres y servicios.</p>
    </div>
</div>

<div class="grid md:grid-cols-4 gap-4 mb-6">
    <div class="surface-card border border-green-50 p-4">
        <p class="text-xs text-gray-500 mb-1">Bicicletas registradas</p>
        <p class="text-2xl font-bold text-green-700">{{ $totalBicicletas }}</p>
    </div>
    <div class="surface-card border border-green-50 p-4">
        <p class="text-xs text-gray-500 mb-1">Alquileres totales</p>
        <p class="text-2xl font-bold text-green-700">{{ $totalAlquileres }}</p>
    </div>
    <div class="surface-card border border-green-50 p-4">
        <p class="text-xs text-gray-500 mb-1">Servicios de mantenimiento</p>
        <p class="text-2xl font-bold text-green-700">{{ $totalServicios }}</p>
    </div>
    <div class="surface-card border border-green-50 p-4">
        <p class="text-xs text-gray-500 mb-1">Total vendido</p>
        <p class="text-2xl font-bold text-green-700">S/ {{ number_format($totalVentas, 2) }}</p>
    </div>
</div>

<div class="surface-card border border-green-50 p-4 mb-4">
    <h2 class="text-sm font-semibold text-gray-800 mb-2">Accesos rápidos</h2>
    <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-3 text-sm">
        <a href="{{ route('admin.bicicletas.index') }}" class="btn-brand justify-center">Bicicletas</a>
        <a href="{{ route('admin.alquileres.index') }}" class="btn-ghost justify-center">Alquileres</a>
        <a href="{{ route('admin.mantenimientos.index') }}" class="btn-ghost justify-center">Mantenimientos</a>
        <a href="{{ route('admin.accesories.index') }}" class="btn-ghost justify-center">Accesorios</a>
        <a href="{{ route('admin.ventas.index') }}" class="btn-ghost justify-center">Ventas</a>
    </div>
</div>

<p class="text-xs text-gray-500">Administra bicicletas, alquileres, mantenimientos y revisa métricas generales del sistema.</p>
@endsection

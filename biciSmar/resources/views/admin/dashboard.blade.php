@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-green-700 mb-6">Dashboard administrador</h1>

<div class="grid md:grid-cols-4 gap-6">
    <div class="bg-white rounded-xl shadow p-4">
        <p class="text-gray-500 text-sm">Bicicletas</p>
        <p class="text-2xl font-bold text-green-700">{{ $totalBicicletas }}</p>
    </div>
    <div class="bg-white rounded-xl shadow p-4">
        <p class="text-gray-500 text-sm">Alquileres</p>
        <p class="text-2xl font-bold text-green-700">{{ $totalAlquileres }}</p>
    </div>
    <div class="bg-white rounded-xl shadow p-4">
        <p class="text-gray-500 text-sm">Servicios</p>
        <p class="text-2xl font-bold text-green-700">{{ $totalServicios }}</p>
    </div>
    <div class="bg-white rounded-xl shadow p-4">
        <p class="text-gray-500 text-sm">Total vendido</p>
        <p class="text-2xl font-bold text-green-700">S/ {{ number_format($totalVentas, 2) }}</p>
    </div>
</div>
@endsection

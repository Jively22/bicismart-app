@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-green-700 mb-6">Servicios de mantenimiento</h1>

<div class="grid md:grid-cols-3 gap-6">
    @foreach($mantenimientos as $m)
        <div class="bg-white rounded-xl shadow p-4">
            <h2 class="font-bold text-lg text-green-700">{{ $m->nombre }}</h2>
            <p class="text-gray-600 text-sm mb-2">{{ $m->descripcion }}</p>
            <p class="text-gray-800"><strong>Precio:</strong> S/ {{ number_format($m->precio, 2) }}</p>
            <p class="text-gray-500 text-sm mt-2">
                <strong>Tipo:</strong> {{ ucfirst($m->tipo_servicio) }}<br>
                <strong>Técnico:</strong> {{ $m->tecnico }}
            </p>
        </div>
    @endforeach
</div>
@endsection

@extends('layouts.app')

@section('content')
<h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-4">Servicios de mantenimiento</h1>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($mantenimientos as $m)
        <div class="bg-white/90 rounded-3xl shadow-md border border-gray-100 p-4 flex flex-col justify-between">
            <div>
                <p class="text-xs uppercase text-gray-500 mb-1">{{ strtoupper($m->tipo_servicio) }}</p>
                <h2 class="font-bold text-sm text-gray-900 mb-1">{{ $m->nombre }}</h2>
                <p class="text-[11px] text-gray-600 mb-2">{{ $m->descripcion }}</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-sm font-semibold text-green-700">S/ {{ number_format($m->precio, 2) }}</p>
                <p class="text-[10px] text-gray-500">{{ $m->proveedor }}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection

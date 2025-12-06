@extends('layouts.app')

@section('content')
<div class="mb-4">
    <span class="pill mb-2 inline-flex">Mantenimiento</span>
    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900">Servicios de mantenimiento</h1>
    <p class="text-sm text-gray-600">Aliados, técnicos internos y externos listos para mantener tus bicicletas y flotas.</p>
</div>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($mantenimientos as $m)
        <div class="surface-card border border-green-50 p-4 flex flex-col justify-between">
            <div>
                <p class="text-xs uppercase text-gray-500 mb-1">{{ strtoupper($m->tipo_servicio) }}</p>
                <h2 class="font-bold text-base text-gray-900 mb-1">{{ $m->nombre }}</h2>
                <p class="text-xs text-gray-600 mb-2">{{ $m->descripcion }}</p>
                @if($m->proveedor)
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[11px] font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                        <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                        Asociado externo: {{ $m->proveedor }}
                    </span>
                @else
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[11px] font-semibold bg-green-50 text-green-700 border border-green-100">
                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                        Técnico oficial BiciSmart
                    </span>
                @endif
            </div>
            <div class="flex items-center justify-between">
                <p class="text-sm font-semibold text-green-700">S/ {{ number_format($m->precio, 2) }}</p>
            </div>
            <div class="mt-3">
                @auth
                    <a href="{{ route('mantenimientos.solicitar', $m) }}"
                       class="btn-brand w-full justify-center text-sm py-2.5">
                        Solicitar este servicio
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="btn-ghost w-full justify-center text-sm py-2.5">
                        Inicia sesión para solicitar
                    </a>
                @endauth
            </div>
        </div>
    @endforeach
</div>
@endsection

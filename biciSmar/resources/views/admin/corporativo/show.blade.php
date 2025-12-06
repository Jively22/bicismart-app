@extends('layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.corporativo.index') }}" class="text-sm text-emerald-700">&larr; Volver a solicitudes</a>
    <h1 class="text-3xl font-extrabold text-gray-900 mt-2">Solicitud corporativa</h1>
    <p class="text-sm text-slate-500">
        {{ \Carbon\Carbon::parse($solicitud->fecha_evento)->format('d/m/Y') }} ·
        {{ $solicitud->tipo_evento }}
    </p>
</div>

<div class="surface-card border border-green-50 p-6 space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-xs text-slate-500 uppercase">Empresa</p>
            <p class="text-xl font-bold text-gray-900">{{ $solicitud->razon_social }}</p>
            <p class="text-sm text-slate-600">RUC: {{ $solicitud->ruc }}</p>
        </div>
        <div>
            @php
                $color = [
                    'pendiente' => 'bg-amber-100 text-amber-800',
                    'aprobado' => 'bg-emerald-100 text-emerald-800',
                    'rechazado' => 'bg-rose-100 text-rose-800',
                ][$solicitud->estado] ?? 'bg-slate-100 text-slate-700';
            @endphp
            <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold {{ $color }}">
                {{ ucfirst($solicitud->estado) }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h2 class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-2">Contacto</h2>
            <p class="font-semibold text-slate-900">{{ $solicitud->contacto_nombre }}</p>
            <p class="text-sm text-slate-600">{{ $solicitud->contacto_email }}</p>
            <p class="text-sm text-slate-600">{{ $solicitud->contacto_telefono }}</p>
        </div>
        <div>
            <h2 class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-2">Evento</h2>
            <dl class="grid grid-cols-2 gap-3 text-sm text-slate-700">
                <div>
                    <dt class="font-semibold">Tipo</dt>
                    <dd>{{ $solicitud->tipo_evento }}</dd>
                </div>
                <div>
                    <dt class="font-semibold">Fecha</dt>
                    <dd>{{ \Carbon\Carbon::parse($solicitud->fecha_evento)->format('d/m/Y') }}</dd>
                </div>
                <div>
                    <dt class="font-semibold">Duración</dt>
                    <dd>{{ $solicitud->duracion_horas }} horas</dd>
                </div>
                <div>
                    <dt class="font-semibold">Cantidad</dt>
                    <dd>{{ $solicitud->cantidad_bicicletas }} bicicletas</dd>
                </div>
            </dl>
        </div>
    </div>

    <div>
        <h2 class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-2">Ubicación</h2>
        <p class="text-sm text-slate-700">{{ $solicitud->ubicacion_evento }}</p>
    </div>

    @if ($solicitud->observaciones)
        <div>
            <h2 class="text-sm font-semibold text-slate-500 uppercase tracking-wide mb-2">Observaciones</h2>
            <p class="text-sm text-slate-700 whitespace-pre-line">{{ $solicitud->observaciones }}</p>
        </div>
    @endif

    <div class="flex items-center justify-between pt-4 border-t border-slate-100">
        <div>
            <p class="text-sm text-slate-500">Precio total estimado</p>
            <p class="text-2xl font-bold text-emerald-700">S/ {{ number_format($solicitud->precio_total, 2) }}</p>
        </div>
    </div>
</div>
@endsection

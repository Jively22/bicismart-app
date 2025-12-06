@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-4">
    <div>
        <span class="pill mb-2 inline-flex">Gestión corporativa</span>
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900">Mis solicitudes corporativas</h1>
        <p class="mt-1 text-gray-600 text-sm">Revisa el estado de tus solicitudes de alquiler corporativo.</p>
    </div>
    <a href="{{ route('corporativo.create') }}"
       class="btn-brand text-sm px-4">
        + Nueva solicitud
    </a>
</div>

@if (session('success'))
    <div class="surface-card border border-green-100 px-4 py-3 text-green-800 mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="table-shell bg-white/90">
    <table class="text-sm">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Evento</th>
                <th>Bicicletas</th>
                <th>Duración</th>
                <th>Total (S/)</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($solicitudes as $solicitud)
                <tr>
                    <td class="text-slate-700">
                        {{ \Carbon\Carbon::parse($solicitud->fecha_evento)->format('d/m/Y') }}
                    </td>
                    <td class="text-slate-700">
                        {{ $solicitud->tipo_evento }}
                    </td>
                    <td class="text-slate-700">
                        {{ $solicitud->cantidad_bicicletas }}
                    </td>
                    <td class="text-slate-700">
                        {{ $solicitud->duracion_horas }} h
                    </td>
                    <td class="text-slate-700">
                        S/ {{ number_format($solicitud->precio_total, 2) }}
                    </td>
                    <td>
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
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-6 text-center text-slate-500">
                        Aún no tienes solicitudes corporativas registradas.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

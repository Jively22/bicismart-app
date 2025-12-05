@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-10">
    <div class="max-w-5xl mx-auto px-4">
        <div class="flex items-center justify-between mb-6">
            <div>
                <p class="text-sm font-semibold text-emerald-700 uppercase tracking-wider">Gestión corporativa</p>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Mis solicitudes corporativas</h1>
                <p class="mt-1 text-gray-600">Revisa el estado de tus solicitudes de alquiler corporativo.</p>
            </div>
            <a href="{{ route('corporativo.create') }}"
               class="inline-flex items-center px-4 py-2 rounded-xl bg-emerald-600 text-white text-sm font-semibold shadow hover:bg-emerald-700">
                + Nueva solicitud
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 rounded-lg bg-emerald-100 border border-emerald-300 px-4 py-3 text-emerald-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-slate-100">
            <table class="min-w-full divide-y divide-slate-100 text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Fecha</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Evento</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Bicicletas</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Duración</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Total (S/)</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($solicitudes as $solicitud)
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap text-slate-700">
                                {{ \Carbon\Carbon::parse($solicitud->fecha_evento)->format('d/m/Y') }}
                            </td>
                            <td class="px-4 py-3 text-slate-700">
                                {{ $solicitud->tipo_evento }}
                            </td>
                            <td class="px-4 py-3 text-slate-700">
                                {{ $solicitud->cantidad_bicicletas }}
                            </td>
                            <td class="px-4 py-3 text-slate-700">
                                {{ $solicitud->duracion_horas }} h
                            </td>
                            <td class="px-4 py-3 text-slate-700">
                                S/ {{ number_format($solicitud->precio_total, 2) }}
                            </td>
                            <td class="px-4 py-3">
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
    </div>
</div>
@endsection

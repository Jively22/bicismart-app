@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-8">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex items-center justify-between mb-6">
            <div>
                <p class="text-sm font-semibold text-emerald-700 uppercase tracking-wider">Gestión corporativa</p>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Solicitudes corporativas</h1>
                <p class="mt-1 text-gray-600">Administra las solicitudes de alquiler corporativo realizadas por empresas.</p>
            </div>
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
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Empresa</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Evento</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Fecha</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Bicicletas</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Total (S/)</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Estado</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($solicitudes as $solicitud)
                        <tr>
                            <td class="px-4 py-3">
                                <div class="flex flex-col">
                                    <span class="font-semibold text-slate-800">{{ $solicitud->razon_social }}</span>
                                    <span class="text-xs text-slate-500">RUC: {{ $solicitud->ruc }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-slate-700">
                                {{ $solicitud->tipo_evento }}
                            </td>
                            <td class="px-4 py-3 text-slate-700">
                                {{ \Carbon\Carbon::parse($solicitud->fecha_evento)->format('d/m/Y') }}
                            </td>
                            <td class="px-4 py-3 text-slate-700">
                                {{ $solicitud->cantidad_bicicletas }}
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
                            <td class="px-4 py-3 text-right">
                                <form action="{{ route('admin.corporativo.estado', $solicitud) }}" method="POST" class="inline-flex items-center gap-1">
                                    @csrf
                                    @method('PUT')
                                    <select name="estado"
                                            class="text-xs rounded-lg border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                                        <option value="pendiente" @selected($solicitud->estado === 'pendiente')>Pendiente</option>
                                        <option value="aprobado" @selected($solicitud->estado === 'aprobado')>Aprobado</option>
                                        <option value="rechazado" @selected($solicitud->estado === 'rechazado')>Rechazado</option>
                                    </select>
                                    <button type="submit"
                                            class="ml-2 inline-flex items-center px-3 py-1 rounded-lg bg-emerald-600 text-white text-xs font-semibold hover:bg-emerald-700">
                                        Guardar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-slate-500">
                                Aún no hay solicitudes corporativas registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="px-4 py-3 bg-slate-50 border-t border-slate-100">
                {{ $solicitudes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

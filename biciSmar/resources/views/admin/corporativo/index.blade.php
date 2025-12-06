@extends('layouts.app')

@section('content')
<div class="mb-4">
    <span class="pill mb-2 inline-flex">Gestión corporativa</span>
    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900">Solicitudes corporativas</h1>
    <p class="mt-1 text-gray-600 text-sm">Administra las solicitudes de alquiler corporativo realizadas por empresas.</p>
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
                <th>Empresa</th>
                <th>Evento</th>
                <th>Fecha</th>
                <th>Bicicletas</th>
                <th>Total (S/)</th>
                <th>Estado</th>
                <th class="text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($solicitudes as $solicitud)
                <tr>
                    <td>
                        <div class="flex flex-col">
                            <span class="font-semibold text-slate-800">{{ $solicitud->razon_social }}</span>
                            <span class="text-xs text-slate-500">RUC: {{ $solicitud->ruc }}</span>
                        </div>
                    </td>
                    <td class="text-slate-700">
                        {{ $solicitud->tipo_evento }}
                    </td>
                    <td class="text-slate-700">
                        {{ \Carbon\Carbon::parse($solicitud->fecha_evento)->format('d/m/Y') }}
                    </td>
                    <td class="text-slate-700">
                        {{ $solicitud->cantidad_bicicletas }}
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
                    <td class="text-right">
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
                                    class="btn-brand text-xs px-3 py-2">
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
@endsection

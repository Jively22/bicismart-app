@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-4">
    <div>
        <span class="pill mb-2 inline-flex">Admin</span>
        <h1 class="text-3xl font-extrabold text-gray-900">Alquileres</h1>
        <p class="text-sm text-gray-600">Control de alquileres individuales y corporativos.</p>
    </div>
    <a href="{{ route('admin.alquileres.create') }}" class="btn-brand text-sm px-4">
       + Nuevo alquiler
    </a>
    </div>

<div class="table-shell bg-white/90 mb-8">
    <table>
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Bicicleta/Flota</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Fechas</th>
                <th>Entrega</th>
                <th>Pago</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alquileres as $alq)
                <tr class="border-b border-green-50">
                    <td class="text-sm text-gray-800">{{ $alq->usuario->name ?? 'N/A' }}</td>
                    <td class="text-sm text-gray-800">{{ $alq->bicicleta->nombre ?? 'N/A' }}</td>
                    <td class="text-sm text-gray-700">{{ ucfirst($alq->tipo_cliente) }}</td>
                    <td class="text-sm text-gray-700">{{ $alq->cantidad ?? 1 }}</td>
                    <td class="text-sm text-gray-700">
                        {{ $alq->fecha_inicio }} - {{ $alq->fecha_fin }}
                    </td>
                    <td class="text-sm text-gray-700">
                        {{ $alq->modo_entrega === 'entregar' ? 'Entrega' : 'Recoge' }}
                        @if($alq->direccion_entrega)
                            <div class="text-xs text-gray-500">{{ $alq->direccion_entrega }}</div>
                        @endif
                    </td>
                    <td class="text-sm text-gray-700 capitalize">{{ str_replace('_', ' ', $alq->metodo_pago) }}</td>
                    <td class="text-sm text-gray-800 font-semibold">S/ {{ number_format($alq->precio_total, 2) }}</td>
                    <td class="text-sm text-gray-700 space-x-2">
                        <a href="{{ route('admin.alquileres.edit', $alq->id) }}" class="text-green-700 font-semibold">Editar</a>
                        <form action="{{ route('admin.alquileres.destroy', $alq->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 font-semibold" onclick="return confirm('¿Eliminar alquiler?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="px-4 py-3 bg-green-50">
        {{ $alquileres->links() }}
    </div>
</div>

@if(isset($solicitudesCorporativas))
<div class="table-shell bg-white/90">
    <div class="px-4 py-2 bg-slate-50 border-b text-sm font-semibold text-slate-800">Solicitudes corporativas (Premium)</div>
    <table class="text-sm">
        <thead>
            <tr>
                <th>Empresa</th>
                <th>Evento / Fecha</th>
                <th>Bicicletas</th>
                <th>Total</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($solicitudesCorporativas as $solicitud)
                <tr class="border-b border-green-50">
                    <td class="px-3 py-2">
                        <div class="font-semibold">{{ $solicitud->razon_social }}</div>
                        <div class="text-xs text-gray-500">RUC: {{ $solicitud->ruc }}</div>
                    </td>
                    <td class="px-3 py-2">
                        {{ $solicitud->tipo_evento }}<br>
                        <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($solicitud->fecha_evento)->format('d/m/Y') }}</span>
                    </td>
                    <td class="px-3 py-2">{{ $solicitud->cantidad_bicicletas }}</td>
                    <td class="px-3 py-2">S/ {{ number_format($solicitud->precio_total, 2) }}</td>
                    <td class="px-3 py-2 capitalize">{{ $solicitud->estado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="px-4 py-2 bg-slate-50 border-t">
        {{ $solicitudesCorporativas->links() }}
    </div>
</div>
@endif
@endsection

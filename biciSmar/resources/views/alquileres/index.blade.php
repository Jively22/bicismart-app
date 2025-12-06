@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-green-700 mb-6">Alquileres (admin)</h1>

<a href="{{ route('admin.alquileres.create') }}"
   class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">
   + Nuevo alquiler
</a>

<div class="bg-white rounded shadow overflow-hidden mb-8">
    <div class="px-4 py-2 bg-green-50 border-b text-sm font-semibold text-green-800">Alquileres individuales y corporativos</div>
    <table class="w-full bg-white">
        <thead class="bg-green-700 text-white">
            <tr>
                <th class="px-4 py-2 text-left">Usuario</th>
                <th class="px-4 py-2 text-left">Bicicleta/Flota</th>
                <th class="px-4 py-2 text-left">Tipo</th>
                <th class="px-4 py-2 text-left">Cantidad</th>
                <th class="px-4 py-2 text-left">Fechas</th>
                <th class="px-4 py-2 text-left">Entrega</th>
                <th class="px-4 py-2 text-left">Pago</th>
                <th class="px-4 py-2 text-left">Total</th>
                <th class="px-4 py-2 text-left">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alquileres as $alq)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $alq->usuario->name ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $alq->bicicleta->nombre ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ ucfirst($alq->tipo_cliente) }}</td>
                    <td class="px-4 py-2">{{ $alq->cantidad ?? 1 }}</td>
                    <td class="px-4 py-2">
                        {{ $alq->fecha_inicio }} - {{ $alq->fecha_fin }}
                    </td>
                    <td class="px-4 py-2">
                        {{ $alq->modo_entrega === 'entregar' ? 'Entrega' : 'Recoge' }}
                        @if($alq->direccion_entrega)
                            <div class="text-xs text-gray-500">{{ $alq->direccion_entrega }}</div>
                        @endif
                    </td>
                    <td class="px-4 py-2 capitalize">{{ str_replace('_', ' ', $alq->metodo_pago) }}</td>
                    <td class="px-4 py-2">S/ {{ number_format($alq->precio_total, 2) }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('admin.alquileres.edit', $alq->id) }}" class="text-blue-600">Editar</a>
                        <form action="{{ route('admin.alquileres.destroy', $alq->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600" onclick="return confirm('¿Eliminar alquiler?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="px-4 py-2">
        {{ $alquileres->links() }}
    </div>
</div>

@if(isset($solicitudesCorporativas))
<div class="bg-white rounded shadow overflow-hidden">
    <div class="px-4 py-2 bg-slate-50 border-b text-sm font-semibold text-slate-800">Solicitudes corporativas (Premium)</div>
    <table class="w-full text-sm">
        <thead class="bg-slate-700 text-white">
            <tr>
                <th class="px-3 py-2 text-left">Empresa</th>
                <th class="px-3 py-2 text-left">Evento / Fecha</th>
                <th class="px-3 py-2 text-left">Bicicletas</th>
                <th class="px-3 py-2 text-left">Total</th>
                <th class="px-3 py-2 text-left">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($solicitudesCorporativas as $solicitud)
                <tr class="border-b">
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
    <div class="px-4 py-2">
        {{ $solicitudesCorporativas->links() }}
    </div>
</div>
@endif
@endsection

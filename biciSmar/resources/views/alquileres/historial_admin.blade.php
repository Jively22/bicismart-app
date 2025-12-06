@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-green-700 mb-6">Historial de alquileres</h1>

<div class="bg-white rounded-3xl shadow-md border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-green-700 text-white">
            <tr>
                <th class="px-3 py-2 text-left">ID</th>
                <th class="px-3 py-2 text-left">Usuario</th>
                <th class="px-3 py-2 text-left">Bicicleta</th>
                <th class="px-3 py-2 text-left">Tipo</th>
                <th class="px-3 py-2 text-left">Cantidad</th>
                <th class="px-3 py-2 text-left">Fechas</th>
                <th class="px-3 py-2 text-left">Entrega</th>
                <th class="px-3 py-2 text-left">Pago</th>
                <th class="px-3 py-2 text-left">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alquileres as $alq)
                <tr class="border-b">
                    <td class="px-3 py-2">{{ $alq->id }}</td>
                    <td class="px-3 py-2">{{ $alq->usuario->name ?? 'N/A' }}</td>
                    <td class="px-3 py-2">{{ $alq->bicicleta->nombre ?? 'N/A' }}</td>
                    <td class="px-3 py-2 capitalize">{{ $alq->tipo_cliente }}</td>
                    <td class="px-3 py-2">{{ $alq->cantidad ?? 1 }}</td>
                    <td class="px-3 py-2">
                        {{ $alq->fecha_inicio }} - {{ $alq->fecha_fin }}
                    </td>
                    <td class="px-3 py-2">
                        {{ $alq->modo_entrega === 'entregar' ? 'Entrega' : 'Recoge' }}
                        @if($alq->direccion_entrega)
                            <div class="text-xs text-gray-500">{{ $alq->direccion_entrega }}</div>
                        @endif
                    </td>
                    <td class="px-3 py-2 capitalize">{{ str_replace('_',' ', $alq->metodo_pago) }}</td>
                    <td class="px-3 py-2">S/ {{ number_format($alq->precio_total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $alquileres->links() }}
</div>
@endsection

@extends('layouts.app')

@section('content')
<h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-4">Mis alquileres</h1>

<table class="w-full text-xs bg-white/90 rounded-3xl shadow-md border border-gray-100 overflow-hidden">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-3 py-2 text-left">Bicicleta</th>
            <th class="px-3 py-2 text-left">Tipo</th>
            <th class="px-3 py-2 text-left">Cantidad</th>
            <th class="px-3 py-2 text-left">Inicio</th>
            <th class="px-3 py-2 text-left">Fin</th>
            <th class="px-3 py-2 text-left">Entrega</th>
            <th class="px-3 py-2 text-left">Pago</th>
            <th class="px-3 py-2 text-left">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($alquileres as $alquiler)
            <tr class="border-t">
                <td class="px-3 py-2">{{ $alquiler->bicicleta->nombre ?? 'N/A' }}</td>
                <td class="px-3 py-2 capitalize">{{ $alquiler->tipo_cliente }}</td>
                <td class="px-3 py-2">{{ $alquiler->cantidad ?? 1 }}</td>
                <td class="px-3 py-2">{{ $alquiler->fecha_inicio }}</td>
                <td class="px-3 py-2">{{ $alquiler->fecha_fin }}</td>
                <td class="px-3 py-2">
                    {{ $alquiler->modo_entrega === 'entregar' ? 'Entrega' : 'Recoge' }}
                    @if($alquiler->direccion_entrega)
                        <div class="text-[11px] text-gray-500">{{ $alquiler->direccion_entrega }}</div>
                    @endif
                </td>
                <td class="px-3 py-2 capitalize">{{ str_replace('_', ' ', $alquiler->metodo_pago) }}</td>
                <td class="px-3 py-2">S/ {{ number_format($alquiler->precio_total, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

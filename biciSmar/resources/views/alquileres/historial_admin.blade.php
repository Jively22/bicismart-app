@extends('layouts.app')

@section('content')
<div class="mb-4">
    <span class="pill mb-2 inline-flex">Admin</span>
    <h1 class="text-3xl font-extrabold text-gray-900">Historial de alquileres</h1>
</div>

<div class="table-shell bg-white/90">
    <table class="text-sm">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Bicicleta</th>
                <th>Fechas</th>
                <th>Entrega</th>
                <th>Pago</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alquileres as $alq)
                <tr>
                    <td>{{ $alq->usuario->name ?? 'N/A' }}</td>
                    <td>{{ $alq->bicicleta->nombre ?? 'N/A' }}</td>
                    <td>{{ $alq->fecha_inicio }} - {{ $alq->fecha_fin }}</td>
                    <td>{{ $alq->modo_entrega === 'entregar' ? 'Entrega' : 'Recoge' }}</td>
                    <td class="capitalize">{{ str_replace('_', ' ', $alq->metodo_pago) }}</td>
                    <td>S/ {{ number_format($alq->precio_total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

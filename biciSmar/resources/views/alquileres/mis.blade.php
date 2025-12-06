@extends('layouts.app')

@section('content')
<div class="mb-4">
    <span class="pill mb-2 inline-flex">Mis alquileres</span>
    <h1 class="text-3xl font-extrabold text-gray-900">Historial de alquileres</h1>
    <p class="text-sm text-gray-600">Seguimiento de tus reservas individuales o corporativas.</p>
</div>

<div class="table-shell bg-white/90">
    <table class="text-sm">
        <thead>
            <tr>
                <th>Fecha inicio</th>
                <th>Fecha fin</th>
                <th>Modo entrega</th>
                <th>Estado</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alquileres as $alquiler)
                <tr>
                    <td>{{ $alquiler->fecha_inicio }}</td>
                    <td>{{ $alquiler->fecha_fin }}</td>
                    <td>{{ $alquiler->modo_entrega === 'entregar' ? 'Entrega' : 'Recoge' }}</td>
                    <td>{{ ucfirst($alquiler->estado ?? 'pendiente') }}</td>
                    <td>S/ {{ number_format($alquiler->precio_total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

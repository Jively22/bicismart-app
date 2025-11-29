@extends('layouts.app')

@section('title','Mis alquileres')

@section('content')
<div class="container py-4">
    <h1 class="fw-bold text-success mb-3">Mis alquileres</h1>

    @if($alquileres->isEmpty())
        <p>Aún no tienes alquileres registrados.</p>
    @else
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Bicicleta</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Estado</th>
                    <th>Total (S/)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alquileres as $alq)
                    <tr>
                        <td>{{ $alq->bicicleta->nombre }}</td>
                        <td>{{ $alq->fecha_inicio }}</td>
                        <td>{{ $alq->fecha_fin }}</td>
                        <td>{{ ucfirst($alq->estado) }}</td>
                        <td>{{ number_format($alq->total,2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

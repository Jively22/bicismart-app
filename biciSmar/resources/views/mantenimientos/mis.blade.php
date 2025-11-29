@extends('layouts.app')

@section('title','Mis mantenimientos')

@section('content')
<div class="container py-4">
    <h1 class="fw-bold text-success mb-3">Mis mantenimientos</h1>

    @if($mantenimientos->isEmpty())
        <p>No tienes mantenimientos registrados.</p>
    @else
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Bicicleta</th>
                    <th>Tipo servicio</th>
                    <th>Fecha programada</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mantenimientos as $mnt)
                    <tr>
                        <td>{{ $mnt->bicicleta?->nombre ?? 'N/A' }}</td>
                        <td>{{ $mnt->tipo_servicio }}</td>
                        <td>{{ $mnt->fecha_programada }}</td>
                        <td>{{ ucfirst($mnt->estado) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

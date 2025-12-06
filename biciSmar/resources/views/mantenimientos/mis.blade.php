@extends('layouts.app')

@section('title','Mantenimientos')

@section('content')
<div class="container py-4">
    <h1 class="fw-bold text-success mb-3">Mantenimientos disponibles</h1>

    @if($mantenimientos->isEmpty())
        <p>No hay servicios de mantenimiento registrados.</p>
    @else
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo servicio</th>
                    <th>Proveedor</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mantenimientos as $mnt)
                    <tr>
                        <td>{{ $mnt->nombre }}</td>
                        <td>{{ ucfirst($mnt->tipo_servicio) }}</td>
                        <td>{{ $mnt->proveedor ?? 'Interno' }}</td>
                        <td>S/ {{ number_format($mnt->precio, 2) }}</td>
                        <td>{{ $mnt->descripcion ?? '—' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

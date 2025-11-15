@extends('layouts.dashboard')
@section('page-title', 'Gestión de Alquileres')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Gestión de Alquileres</h3>
                    <a href="{{ route('alquileres.create') }}" class="btn btn-primary">
                        Nuevo Alquiler
                    </a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($alquileres->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Bicicleta</th>
                                    <th>Tipo</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Estado</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alquileres as $alquiler)
                                <tr>
                                    <td>{{ $alquiler->usuario->name }}</td>
                                    <td>{{ $alquiler->bicicleta->marca }} {{ $alquiler->bicicleta->modelo }}</td>
                                    <td>
                                        <span class="badge bg-{{ $alquiler->tipo_alquiler == 'individual' ? 'info' : 'warning' }}">
                                            {{ $alquiler->tipo_alquiler }}
                                        </span>
                                    </td>
                                    <td>{{ $alquiler->fecha_inicio->format('d/m/Y H:i') }}</td>
                                    <td>{{ $alquiler->fecha_fin->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $alquiler->estado == 'activo' ? 'success' : ($alquiler->estado == 'pendiente' ? 'warning' : 'secondary') }}">
                                            {{ $alquiler->estado }}
                                        </span>
                                    </td>
                                    <td>S/ {{ number_format($alquiler->total, 2) }}</td>
                                    <td>
                                        <a href="{{ route('alquileres.show', $alquiler) }}" class="btn btn-sm btn-info">Ver</a>
                                        <a href="{{ route('alquileres.edit', $alquiler) }}" class="btn btn-sm btn-warning">Editar</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <p class="text-muted">No hay alquileres registrados.</p>
                        <a href="{{ route('alquileres.create') }}" class="btn btn-primary mt-2">
                            Crear el primer alquiler
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
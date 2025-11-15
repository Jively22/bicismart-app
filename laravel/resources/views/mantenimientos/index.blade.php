@extends('layouts.dashboard')

@section('page-title', 'Gestión de Mantenimientos')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestión de Mantenimientos</h1>
        <a href="{{ route('mantenimientos.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-2"></i>Nuevo Mantenimiento
        </a>
    </div>

    <!-- Tabla de Mantenimientos -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Lista de Mantenimientos</h6>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($mantenimientos->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="bg-light">
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Técnico</th>
                                <th>Bicicleta</th>
                                <th>Estado</th>
                                <th>Precio</th>
                                <th>Fecha Solicitud</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mantenimientos as $mantenimiento)
                            <tr>
                                <td><strong>#{{ $mantenimiento->id }}</strong></td>
                                <td>
                                    <div class="fw-bold">{{ $mantenimiento->usuario->name }}</div>
                                    <small class="text-muted">{{ $mantenimiento->usuario->email }}</small>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $mantenimiento->tecnico->name }}</div>
                                    <small class="text-muted">{{ $mantenimiento->tecnico->email }}</small>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $mantenimiento->marca_bicicleta }}</div>
                                    <small class="text-muted">{{ $mantenimiento->modelo_bicicleta }}</small>
                                </td>
                                <td>
                                    @php
                                        $estadoColors = [
                                            'pendiente' => 'warning',
                                            'aceptado' => 'info',
                                            'en_proceso' => 'primary',
                                            'completado' => 'success',
                                            'cancelado' => 'danger'
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $estadoColors[$mantenimiento->estado] ?? 'secondary' }}">
                                        {{ ucfirst(str_replace('_', ' ', $mantenimiento->estado)) }}
                                    </span>
                                </td>
                                <td>
                                    @if($mantenimiento->precio_pactado)
                                        <strong>S/ {{ number_format($mantenimiento->precio_pactado, 2) }}</strong>
                                    @else
                                        <span class="text-muted">Por cotizar</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $mantenimiento->created_at->format('d/m/Y') }}
                                    <br>
                                    <small class="text-muted">{{ $mantenimiento->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('mantenimientos.show', $mantenimiento) }}" class="btn btn-info btn-sm" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('mantenimientos.edit', $mantenimiento) }}" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-tools fa-4x text-muted mb-4"></i>
                    <h4 class="text-muted">No hay mantenimientos registrados</h4>
                    <p class="text-muted mb-4">Comienza creando el primer mantenimiento</p>
                    <a href="{{ route('mantenimientos.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus me-2"></i>Crear Primer Mantenimiento
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
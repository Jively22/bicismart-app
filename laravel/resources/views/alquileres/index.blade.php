@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 fw-bold text-primary">
                        <i class="fas fa-calendar-check me-2"></i>Gestión de Alquileres
                    </h1>
                    <p class="text-muted mb-0">Administra todas las solicitudes de alquiler</p>
                </div>
                <a href="{{ route('alquileres.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-2"></i>Nuevo Alquiler
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Alquileres
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $alquileres->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Alquileres Activos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $alquileres->where('estado', 'activo')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-play-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pendientes
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $alquileres->where('estado', 'pendiente')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Corporativos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $alquileres->where('tipo_alquiler', 'corporativo')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alquileres Table -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">Lista de Alquileres</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($alquileres->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Usuario</th>
                            <th>Bicicleta</th>
                            <th>Tipo</th>
                            <th>Fechas</th>
                            <th>Estado</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alquileres as $alquiler)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-circle text-primary me-2"></i>
                                    <div>
                                        <div class="fw-semibold">{{ $alquiler->usuario->name }}</div>
                                        <small class="text-muted">{{ $alquiler->usuario->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $alquiler->bicicleta->marca }} {{ $alquiler->bicicleta->modelo }}</div>
                                <small class="text-muted">Cant: {{ $alquiler->cantidad_bicicletas }}</small>
                            </td>
                            <td>
                                <span class="badge bg-{{ $alquiler->tipo_alquiler == 'individual' ? 'info' : 'warning' }}">
                                    <i class="fas fa-{{ $alquiler->tipo_alquiler == 'individual' ? 'user' : 'building' }} me-1"></i>
                                    {{ $alquiler->tipo_alquiler }}
                                </span>
                            </td>
                            <td>
                                <small class="d-block">
                                    <i class="fas fa-play text-success me-1"></i>
                                    {{ $alquiler->fecha_inicio->format('d/m/Y H:i') }}
                                </small>
                                <small class="d-block">
                                    <i class="fas fa-stop text-danger me-1"></i>
                                    {{ $alquiler->fecha_fin->format('d/m/Y H:i') }}
                                </small>
                            </td>
                            <td>
                                @php
                                    $estadoColors = [
                                        'pendiente' => 'warning',
                                        'activo' => 'success',
                                        'finalizado' => 'info',
                                        'cancelado' => 'danger'
                                    ];
                                @endphp
                                <span class="badge bg-{{ $estadoColors[$alquiler->estado] ?? 'secondary' }}">
                                    <i class="fas fa-{{ $alquiler->estado == 'activo' ? 'play' : ($alquiler->estado == 'pendiente' ? 'clock' : 'check') }} me-1"></i>
                                    {{ ucfirst($alquiler->estado) }}
                                </span>
                            </td>
                            <td>
                                <span class="fw-bold text-success">S/ {{ number_format($alquiler->total, 2) }}</span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('alquileres.show', $alquiler) }}" class="btn btn-outline-primary btn-sm" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('alquileres.edit', $alquiler) }}" class="btn btn-outline-warning btn-sm" title="Editar">
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
                <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">No hay alquileres registrados</h4>
                <p class="text-muted mb-4">Comienza registrando el primer alquiler</p>
                <a href="{{ route('alquileres.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-2"></i>Crear Primer Alquiler
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Pagination -->
    @if($alquileres->hasPages())
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body py-3">
                    {{ $alquileres->links() }}
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<style>
.card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border-radius: 15px;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
}

.border-left-primary { border-left: 4px solid #10b981 !important; }
.border-left-success { border-left: 4px solid #10b981 !important; }
.border-left-warning { border-left: 4px solid #10b981 !important; }
.border-left-info { border-left: 4px solid #10b981 !important; }

.table > :not(caption) > * > * {
    padding: 1rem 0.75rem;
    vertical-align: middle;
}
</style>
@endsection
@extends('layouts.dashboard')

@section('page-title', 'Mis Solicitudes de Alquiler Corporativo')

@section('content')
<div class="container-fluid">
    <!-- Header con Estadísticas -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Mis Solicitudes de Alquiler Corporativo</h1>
        <a href="{{ route('alquiler-corporativo.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-2"></i>Nueva Solicitud
        </a>
    </div>

    <!-- Estadísticas Rápidas -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" style="border-left: 4px solid #10b981 !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="color: #10b981 !important;">
                                Total Solicitudes
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $alquileres->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2" style="border-left: 4px solid #10b981 !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="color: #10b981 !important;">
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
            <div class="card border-left-info shadow h-100 py-2" style="border-left: 4px solid #10b981 !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="color: #10b981 !important;">
                                Activos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $alquileres->where('estado', 'activo')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2" style="border-left: 4px solid #10b981 !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" style="color: #10b981 !important;">
                                Finalizados
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $alquileres->where('estado', 'finalizado')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-flag-checkered fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Solicitudes -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Historial de Solicitudes</h6>
        </div>
        <div class="card-body">
            @if($alquileres->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-light">
                            <tr>
                                <th>ID</th>
                                <th>Empresa</th>
                                <th>Fecha Evento</th>
                                <th>Cantidad</th>
                                <th>Estado</th>
                                <th>Total</th>
                                <th>Fecha Solicitud</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alquileres as $alquiler)
                            <tr>
                                <td>
                                    <strong>#{{ $alquiler->id }}</strong>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $alquiler->razon_social }}</div>
                                    <small class="text-muted">RUC: {{ $alquiler->ruc_empresa }}</small>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($alquiler->fecha_inicio)->format('d/m/Y') }}
                                    <br>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($alquiler->fecha_inicio)->format('H:i') }} - 
                                        {{ \Carbon\Carbon::parse($alquiler->fecha_fin)->format('H:i') }}
                                    </small>
                                </td>
                                <td>
                                    <span class="badge bg-primary rounded-pill">
                                        {{ $alquiler->cantidad_bicicletas }} bicis
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $alquiler->estado == 'pendiente' ? 'warning' : ($alquiler->estado == 'activo' ? 'success' : ($alquiler->estado == 'finalizado' ? 'info' : 'secondary')) }}">
                                        {{ $alquiler->estado }}
                                    </span>
                                </td>
                                <td>
                                    <strong>S/ {{ number_format($alquiler->total, 2) }}</strong>
                                </td>
                                <td>
                                    {{ $alquiler->created_at->format('d/m/Y') }}
                                    <br>
                                    <small class="text-muted">{{ $alquiler->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detalleModal{{ $alquiler->id }}" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @if($alquiler->estado == 'pendiente')
                                        <button class="btn btn-warning btn-sm" title="Solicitud pendiente">
                                            <i class="fas fa-clock"></i>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal para detalles -->
                            <div class="modal fade" id="detalleModal{{ $alquiler->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Detalles de Solicitud #{{ $alquiler->id }}</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6 class="text-primary">Información de la Empresa</h6>
                                                    <div class="mb-3">
                                                        <strong>Razón Social:</strong><br>
                                                        {{ $alquiler->razon_social }}
                                                    </div>
                                                    <div class="mb-3">
                                                        <strong>RUC:</strong><br>
                                                        {{ $alquiler->ruc_empresa }}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 class="text-primary">Detalles del Evento</h6>
                                                    <div class="mb-3">
                                                        <strong>Fecha:</strong><br>
                                                        {{ \Carbon\Carbon::parse($alquiler->fecha_inicio)->format('d/m/Y') }}
                                                    </div>
                                                    <div class="mb-3">
                                                        <strong>Horario:</strong><br>
                                                        {{ \Carbon\Carbon::parse($alquiler->fecha_inicio)->format('H:i') }} - 
                                                        {{ \Carbon\Carbon::parse($alquiler->fecha_fin)->format('H:i') }}
                                                    </div>
                                                    <div class="mb-3">
                                                        <strong>Cantidad:</strong><br>
                                                        {{ $alquiler->cantidad_bicicletas }} bicicletas
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <h6 class="text-primary">Estado y Monto</h6>
                                                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                                                        <div>
                                                            <strong>Estado:</strong>
                                                            <span class="badge bg-{{ $alquiler->estado == 'pendiente' ? 'warning' : ($alquiler->estado == 'activo' ? 'success' : 'secondary') }} ms-2">
                                                                {{ $alquiler->estado }}
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <strong>Total:</strong>
                                                            <span class="h5 text-primary ms-2">S/ {{ number_format($alquiler->total, 2) }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            @if($alquiler->estado == 'pendiente')
                                            <button type="button" class="btn btn-warning" disabled>
                                                <i class="fas fa-clock me-1"></i>En revisión
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-4x text-muted mb-4"></i>
                    <h4 class="text-muted">No tienes solicitudes de alquiler corporativo</h4>
                    <p class="text-muted mb-4">Comienza solicitando un alquiler para tu empresa</p>
                    <a href="{{ route('alquiler-corporativo.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus me-2"></i>Crear Primera Solicitud
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
    .card {
        border: none;
        border-radius: 10px;
    }
    
    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }
    
    .table th {
        border-top: none;
        font-weight: 600;
        color: #10b981;
    }
    
    .btn-primary {
        background-color: #10b981;
        border-color: #10b981;
    }
    
    .btn-primary:hover {
        background-color: #059669;
        border-color: #059669;
    }
</style>
@endsection
@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 fw-bold text-primary">
                        <i class="fas fa-tools me-2"></i>Gestión de Mantenimientos
                    </h1>
                    <p class="text-muted mb-0">Administra todos los servicios de mantenimiento técnico</p>
                </div>
                <a href="{{ route('mantenimientos.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-2"></i>Nuevo Mantenimiento
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
                                Total Mantenimientos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $mantenimientos->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tools fa-2x text-gray-300"></i>
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
                                {{ $mantenimientos->where('estado', 'pendiente')->count() }}
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
                                En Proceso
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $mantenimientos->where('estado', 'en_proceso')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-spinner fa-2x text-gray-300"></i>
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
                                Completados
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $mantenimientos->where('estado', 'completado')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mantenimientos Grid -->
    <div class="row">
        @forelse($mantenimientos as $mantenimiento)
        <div class="col-xl-4 col-lg-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 fw-bold">Mantenimiento #{{ $mantenimiento->id }}</h5>
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
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Información del Cliente -->
                    <div class="mb-3">
                        <h6 class="text-primary mb-2">
                            <i class="fas fa-user me-2"></i>Cliente
                        </h6>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-circle text-muted me-2"></i>
                            <div>
                                <div class="fw-semibold">{{ $mantenimiento->usuario->name }}</div>
                                <small class="text-muted">{{ $mantenimiento->usuario->email }}</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Información del Técnico -->
                    <div class="mb-3">
                        <h6 class="text-primary mb-2">
                            <i class="fas fa-tools me-2"></i>Técnico
                        </h6>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-cog text-muted me-2"></i>
                            <div>
                                <div class="fw-semibold">{{ $mantenimiento->tecnico->name }}</div>
                                <small class="text-muted">{{ $mantenimiento->tecnico->email }}</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Información de la Bicicleta -->
                    <div class="mb-3">
                        <h6 class="text-primary mb-2">
                            <i class="fas fa-bicycle me-2"></i>Bicicleta
                        </h6>
                        <div class="fw-semibold">{{ $mantenimiento->marca_bicicleta }} {{ $mantenimiento->modelo_bicicleta }}</div>
                    </div>
                    
                    <!-- Descripción del Problema -->
                    <div class="mb-3">
                        <h6 class="text-primary mb-2">Descripción</h6>
                        <p class="card-text text-muted small">
                            {{ Str::limit($mantenimiento->descripcion_problema, 120) }}
                        </p>
                    </div>
                    
                    <!-- Precio y Fechas -->
                    <div class="row">
                        <div class="col-6">
                            <small class="text-muted d-block">Precio Pactado</small>
                            <strong class="text-success">
                                @if($mantenimiento->precio_pactado)
                                    S/ {{ number_format($mantenimiento->precio_pactado, 2) }}
                                @else
                                    <span class="text-muted">Por cotizar</span>
                                @endif
                            </strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Creado</small>
                            <strong class="text-primary">
                                {{ $mantenimiento->created_at->format('d/m/Y') }}
                            </strong>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer bg-white border-0 pt-0">
                    <div class="d-flex gap-2">
                        <a href="{{ route('mantenimientos.show', $mantenimiento) }}" class="btn btn-outline-primary btn-sm flex-fill">
                            <i class="fas fa-eye me-1"></i>Ver
                        </a>
                        <a href="{{ route('mantenimientos.edit', $mantenimiento) }}" class="btn btn-outline-warning btn-sm flex-fill">
                            <i class="fas fa-edit me-1"></i>Editar
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center py-5">
                    <i class="fas fa-tools fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">No hay mantenimientos registrados</h4>
                    <p class="text-muted mb-4">Comienza registrando el primer servicio de mantenimiento</p>
                    <a href="{{ route('mantenimientos.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i>Crear Primer Mantenimiento
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($mantenimientos->hasPages())
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    {{ $mantenimientos->links() }}
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<style>
.card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
}

.border-left-primary { border-left: 4px solid #10b981 !important; }
.border-left-warning { border-left: 4px solid #10b981 !important; }
.border-left-info { border-left: 4px solid #10b981 !important; }
.border-left-success { border-left: 4px solid #10b981 !important; }
</style>
@endsection
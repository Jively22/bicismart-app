@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 fw-bold text-primary">
                        <i class="fas fa-bicycle me-2"></i>Gestión de Bicicletas
                    </h1>
                    <p class="text-muted mb-0">Administra el inventario de bicicletas disponibles</p>
                </div>
                <a href="{{ route('bicicletas.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-2"></i>Nueva Bicicleta
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
                                Total Bicicletas
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $bicicletas->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bicycle fa-2x text-gray-300"></i>
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
                                Disponibles Alquiler
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $bicicletas->where('disponible_para_alquiler', true)->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
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
                                Disponibles Venta
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $bicicletas->where('disponible_para_venta', true)->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
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
                                Bicicletas Nuevas
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $bicicletas->where('estado', 'nuevo')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-star fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bicicletas Grid -->
    <div class="row">
        @forelse($bicicletas as $bicicleta)
        <div class="col-xl-4 col-lg-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 fw-bold">{{ $bicicleta->marca }} {{ $bicicleta->modelo }}</h5>
                        <span class="badge bg-{{ $bicicleta->estado == 'nuevo' ? 'success' : 'warning' }}">
                            {{ $bicicleta->estado }}
                        </span>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="mb-3">
                        <span class="badge bg-primary">{{ $bicicleta->tipo }}</span>
                        <span class="badge bg-secondary ms-1">{{ $bicicleta->tamaño }}</span>
                    </div>
                    
                    <p class="card-text text-muted mb-3">
                        {{ Str::limit($bicicleta->descripcion, 100) }}
                    </p>
                    
                    <div class="row mb-3">
                        <div class="col-6">
                            <small class="text-muted d-block">Precio Venta</small>
                            <strong class="text-success">
                                @if($bicicleta->precio_venta)
                                    S/ {{ number_format($bicicleta->precio_venta, 2) }}
                                @else
                                    <span class="text-muted">No disponible</span>
                                @endif
                            </strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Alquiler/Hora</small>
                            <strong class="text-primary">
                                @if($bicicleta->precio_alquiler_hora)
                                    S/ {{ number_format($bicicleta->precio_alquiler_hora, 2) }}
                                @else
                                    <span class="text-muted">No disponible</span>
                                @endif
                            </strong>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-6">
                            <small class="text-muted d-block">Venta</small>
                            <span class="badge bg-{{ $bicicleta->disponible_para_venta ? 'success' : 'danger' }}">
                                {{ $bicicleta->disponible_para_venta ? 'Disponible' : 'No disponible' }}
                            </span>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Alquiler</small>
                            <span class="badge bg-{{ $bicicleta->disponible_para_alquiler ? 'success' : 'danger' }}">
                                {{ $bicicleta->disponible_para_alquiler ? 'Disponible' : 'No disponible' }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer bg-white border-0 pt-0">
                    <div class="d-flex gap-2">
                        <a href="{{ route('bicicletas.show', $bicicleta) }}" class="btn btn-outline-primary btn-sm flex-fill">
                            <i class="fas fa-eye me-1"></i>Ver
                        </a>
                        <a href="{{ route('bicicletas.edit', $bicicleta) }}" class="btn btn-outline-warning btn-sm flex-fill">
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
                    <i class="fas fa-bicycle fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">No hay bicicletas registradas</h4>
                    <p class="text-muted mb-4">Comienza agregando la primera bicicleta al inventario</p>
                    <a href="{{ route('bicicletas.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i>Crear Primera Bicicleta
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($bicicletas->hasPages())
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    {{ $bicicletas->links() }}
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

.border-left-primary {
    border-left: 4px solid #10b981 !important;
}

.border-left-success {
    border-left: 4px solid #10b981 !important;
}

.border-left-info {
    border-left: 4px solid #10b981 !important;
}

.border-left-warning {
    border-left: 4px solid #10b981 !important;
}
</style>
@endsection
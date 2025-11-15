@extends('layouts.dashboard')

@section('page-title', 'Dashboard - BiciSmart')

@section('content')
<div class="container-fluid">
    <!-- Estadísticas Rápidas -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" style="border-left: 4px solid #10b981 !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="color: #10b981 !important;">
                                Bicicletas Disponibles
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ \App\Models\Bicicleta::where('disponible_para_alquiler', true)->count() }}
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
            <div class="card border-left-success shadow h-100 py-2" style="border-left: 4px solid #10b981 !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="color: #10b981 !important;">
                                Alquileres Activos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ \App\Models\Alquiler::where('estado', 'activo')->count() }}
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
            <div class="card border-left-info shadow h-100 py-2" style="border-left: 4px solid #10b981 !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="color: #10b981 !important;">
                                Solicitudes Pendientes
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ \App\Models\Alquiler::where('estado', 'pendiente')->count() }}
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
            <div class="card border-left-warning shadow h-100 py-2" style="border-left: 4px solid #10b981 !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" style="color: #10b981 !important;">
                                Total Usuarios
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ \App\Models\User::count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="row">
        <!-- Acciones Rápidas -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Acciones Rápidas</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if(Auth::user()->role === 'admin')
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('bicicletas.create') }}" class="btn btn-primary w-100 d-flex align-items-center justify-content-center p-3">
                                <i class="fas fa-plus-circle fa-2x me-3"></i>
                                <div class="text-start">
                                    <div class="fw-bold">Nueva Bicicleta</div>
                                    <small>Agregar al inventario</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('alquileres.create') }}" class="btn btn-success w-100 d-flex align-items-center justify-content-center p-3">
                                <i class="fas fa-calendar-plus fa-2x me-3"></i>
                                <div class="text-start">
                                    <div class="fw-bold">Nuevo Alquiler</div>
                                    <small>Registrar manualmente</small>
                                </div>
                            </a>
                        </div>
                        @endif

                        <div class="col-md-6 mb-3">
                            <a href="{{ route('alquiler-corporativo.create') }}" class="btn btn-info w-100 d-flex align-items-center justify-content-center p-3">
                                <i class="fas fa-briefcase fa-2x me-3"></i>
                                <div class="text-start">
                                    <div class="fw-bold">Alquiler Corporativo</div>
                                    <small>Solicitud para empresas</small>
                                </div>
                            </a>
                        </div>

                        @if(Auth::user()->role !== 'admin')
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('mis-alquileres') }}" class="btn btn-warning w-100 d-flex align-items-center justify-content-center p-3">
                                <i class="fas fa-list fa-2x me-3"></i>
                                <div class="text-start">
                                    <div class="fw-bold">Mis Alquileres</div>
                                    <small>Ver mis solicitudes</small>
                                </div>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Información del Usuario -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Información de la Cuenta</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-shrink-0">
                            <i class="fas fa-user-circle fa-3x text-primary"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                            <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                            <span class="badge bg-{{ Auth::user()->role === 'admin' ? 'success' : (Auth::user()->role === 'empresa' ? 'info' : 'primary') }}">
                                {{ Auth::user()->role }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="border-end">
                                <div class="h4 mb-1 text-primary">
                                    {{ \App\Models\Alquiler::where('usuario_id', Auth::id())->count() }}
                                </div>
                                <small class="text-muted">Total Alquileres</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="border-end">
                                <div class="h4 mb-1 text-success">
                                    {{ \App\Models\Alquiler::where('usuario_id', Auth::id())->where('estado', 'activo')->count() }}
                                </div>
                                <small class="text-muted">Activos</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="h4 mb-1 text-warning">
                                {{ \App\Models\Alquiler::where('usuario_id', Auth::id())->where('estado', 'pendiente')->count() }}
                            </div>
                            <small class="text-muted">Pendientes</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Últimos Alquileres (Solo para admin) -->
    @if(Auth::user()->role === 'admin')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Últimos Alquileres</h5>
                    <a href="{{ route('alquileres.index') }}" class="btn btn-sm btn-primary">Ver Todos</a>
                </div>
                <div class="card-body">
                    @php
                        $ultimosAlquileres = \App\Models\Alquiler::with(['usuario', 'bicicleta'])
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();
                    @endphp
                    
                    @if($ultimosAlquileres->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Empresa</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ultimosAlquileres as $alquiler)
                                <tr>
                                    <td>#{{ $alquiler->id }}</td>
                                    <td>{{ $alquiler->usuario->name ?? 'N/A' }}</td>
                                    <td>{{ $alquiler->razon_social ?? 'Individual' }}</td>
                                    <td>{{ $alquiler->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $alquiler->estado == 'activo' ? 'success' : ($alquiler->estado == 'pendiente' ? 'warning' : 'secondary') }}">
                                            {{ $alquiler->estado }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No hay alquileres registrados</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Font Awesome para los íconos -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
@endsection
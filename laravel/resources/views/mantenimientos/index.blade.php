@extends('layouts.dashboard')

@section('page-title', 'Gestión de Mantenimientos')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center">
                <h2><i class="fas fa-tools me-2"></i>Mantenimientos</h2>
                <a href="{{ route('mantenimientos.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>Nuevo Mantenimiento
                </a>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('mantenimientos.index') }}">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Bicicleta</label>
                        <select name="bicicleta_id" class="form-select">
                            <option value="">Todas</option>
                            @foreach($bicicletas as $bicicleta)
                                <option value="{{ $bicicleta->id }}" {{ request('bicicleta_id') == $bicicleta->id ? 'selected' : '' }}>
                                    {{ $bicicleta->modelo }} - {{ $bicicleta->numero_serie }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Estado</label>
                        <select name="estado" class="form-select">
                            <option value="">Todos</option>
                            <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="en_proceso" {{ request('estado') == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                            <option value="completado" {{ request('estado') == 'completado' ? 'selected' : '' }}>Completado</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" class="form-select">
                            <option value="">Todos</option>
                            <option value="preventivo" {{ request('tipo') == 'preventivo' ? 'selected' : '' }}>Preventivo</option>
                            <option value="correctivo" {{ request('tipo') == 'correctivo' ? 'selected' : '' }}>Correctivo</option>
                            <option value="revision" {{ request('tipo') == 'revision' ? 'selected' : '' }}>Revisión</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-fill">
                                <i class="fas fa-search me-2"></i>Filtrar
                            </button>
                            <a href="{{ route('mantenimientos.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla de Mantenimientos -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Bicicleta</th>
                            <th>Tipo</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                            <th>Costo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mantenimientos as $mantenimiento)
                        <tr>
                            <td>{{ $mantenimiento->id }}</td>
                            <td>
                                <strong>{{ $mantenimiento->bicicleta->modelo }}</strong><br>
                                <small class="text-muted">{{ $mantenimiento->bicicleta->numero_serie }}</small>
                            </td>
                            <td>
                                @if($mantenimiento->tipo == 'preventivo')
                                    <span class="badge bg-info">Preventivo</span>
                                @elseif($mantenimiento->tipo == 'correctivo')
                                    <span class="badge bg-warning">Correctivo</span>
                                @else
                                    <span class="badge bg-secondary">Revisión</span>
                                @endif
                            </td>
                            <td>{{ Str::limit($mantenimiento->descripcion, 50) }}</td>
                            <td>{{ \Carbon\Carbon::parse($mantenimiento->fecha_mantenimiento)->format('d/m/Y') }}</td>
                            <td>S/ {{ number_format($mantenimiento->costo, 2) }}</td>
                            <td>
                                @if($mantenimiento->estado == 'pendiente')
                                    <span class="badge bg-warning">Pendiente</span>
                                @elseif($mantenimiento->estado == 'en_proceso')
                                    <span class="badge bg-info">En Proceso</span>
                                @else
                                    <span class="badge bg-success">Completado</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('mantenimientos.edit', $mantenimiento->id) }}" 
                                       class="btn btn-sm btn-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('mantenimientos.destroy', $mantenimiento->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('¿Estás seguro de eliminar este mantenimiento?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                <p class="text-muted">No hay mantenimientos registrados</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-center mt-4">
                {{ $mantenimientos->links() }}
            </div>
        </div>
    </div>

    <!-- Resumen de Estadísticas -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                    <h3>{{ $estadisticas['pendientes'] ?? 0 }}</h3>
                    <p class="text-muted mb-0">Pendientes</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-spinner fa-2x text-info mb-2"></i>
                    <h3>{{ $estadisticas['en_proceso'] ?? 0 }}</h3>
                    <p class="text-muted mb-0">En Proceso</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                    <h3>{{ $estadisticas['completados'] ?? 0 }}</h3>
                    <p class="text-muted mb-0">Completados</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
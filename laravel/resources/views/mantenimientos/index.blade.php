@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-1">Mantenimientos</h2>
            <p class="text-muted mb-0">Administra los servicios técnicos y disponibilidad de bicicletas.</p>
        </div>
        <a href="{{ route('mantenimientos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nuevo mantenimiento
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1">Pendientes</h6>
                            <h3 class="mb-0">{{ $estadisticas['pendientes'] }}</h3>
                        </div>
                        <span class="badge bg-warning text-dark">En cola</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1">En proceso</h6>
                            <h3 class="mb-0">{{ $estadisticas['en_proceso'] }}</h3>
                        </div>
                        <span class="badge bg-info text-dark">Taller</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1">Completados</h6>
                            <h3 class="mb-0">{{ $estadisticas['completados'] }}</h3>
                        </div>
                        <span class="badge bg-success">Listos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Bicicleta</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>Inicio</th>
                            <th>Fin prevista</th>
                            <th>Técnico</th>
                            <th>Costo estimado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mantenimientos as $mantenimiento)
                            <tr>
                                <td>{{ $mantenimiento->id }}</td>
                                <td>{{ $mantenimiento->bicicleta->marca }} {{ $mantenimiento->bicicleta->modelo }}</td>
                                <td class="text-capitalize">{{ $mantenimiento->tipo }}</td>
                                <td>
                                    @php
                                        $colors = [
                                            'pendiente' => 'warning',
                                            'en_proceso' => 'info',
                                            'completado' => 'success',
                                            'cancelado' => 'secondary',
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $colors[$mantenimiento->estado] ?? 'secondary' }} text-uppercase">
                                        {{ str_replace('_', ' ', $mantenimiento->estado) }}
                                    </span>
                                </td>
                                <td>{{ $mantenimiento->fecha_inicio->format('d/m/Y') }}</td>
                                <td>{{ optional($mantenimiento->fecha_fin_prevista)->format('d/m/Y') ?? '—' }}</td>
                                <td>{{ $mantenimiento->tecnico_responsable ?? 'No asignado' }}</td>
                                <td>{{ $mantenimiento->costo_estimado ? 'S/ ' . number_format($mantenimiento->costo_estimado, 2) : '—' }}</td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('mantenimientos.show', $mantenimiento) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('mantenimientos.edit', $mantenimiento) }}" class="btn btn-outline-warning btn-sm">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('mantenimientos.destroy', $mantenimiento) }}" method="POST" onsubmit="return confirm('¿Eliminar mantenimiento?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm" type="submit">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">No hay mantenimientos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            {{ $mantenimientos->links() }}
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 text-primary"><i class="fas fa-wrench me-2"></i>Mantenimiento #{{ $mantenimiento->id }}</h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('mantenimientos.edit', $mantenimiento) }}" class="btn btn-outline-warning btn-sm"><i class="fas fa-pen me-1"></i>Editar</a>
                        <a href="{{ route('mantenimientos.index') }}" class="btn btn-outline-secondary btn-sm">Volver</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <span class="badge bg-secondary text-uppercase">{{ $mantenimiento->tipo }}</span>
                        <span class="badge bg-success text-uppercase">{{ $mantenimiento->estado }}</span>
                    </div>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Bicicleta</dt>
                        <dd class="col-sm-8">{{ $mantenimiento->bicicleta->marca }} {{ $mantenimiento->bicicleta->modelo }} ({{ $mantenimiento->bicicleta->tipo }})</dd>

                        <dt class="col-sm-4">Descripción</dt>
                        <dd class="col-sm-8">{{ $mantenimiento->descripcion }}</dd>

                        <dt class="col-sm-4">Fecha inicio</dt>
                        <dd class="col-sm-8">{{ $mantenimiento->fecha_inicio->format('d/m/Y') }}</dd>

                        <dt class="col-sm-4">Fecha fin prevista</dt>
                        <dd class="col-sm-8">{{ optional($mantenimiento->fecha_fin_prevista)->format('d/m/Y') ?? '—' }}</dd>

                        <dt class="col-sm-4">Fecha fin real</dt>
                        <dd class="col-sm-8">{{ optional($mantenimiento->fecha_fin)->format('d/m/Y') ?? 'En curso' }}</dd>

                        <dt class="col-sm-4">Técnico responsable</dt>
                        <dd class="col-sm-8">{{ $mantenimiento->tecnico_responsable ?? 'No asignado' }}</dd>

                        <dt class="col-sm-4">Costo estimado</dt>
                        <dd class="col-sm-8">{{ $mantenimiento->costo_estimado ? 'S/ ' . number_format($mantenimiento->costo_estimado, 2) : '—' }}</dd>

                        <dt class="col-sm-4">Observaciones</dt>
                        <dd class="col-sm-8">{{ $mantenimiento->observaciones ?? 'Sin observaciones' }}</dd>

                        <dt class="col-sm-4">Creado</dt>
                        <dd class="col-sm-8">{{ $mantenimiento->created_at->format('d/m/Y H:i') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
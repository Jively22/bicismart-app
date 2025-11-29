@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 text-primary"><i class="fas fa-pen me-2"></i>Editar mantenimiento #{{ $mantenimiento->id }}</h4>
                    <a href="{{ route('mantenimientos.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Volver</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('mantenimientos.update', $mantenimiento) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Bicicleta *</label>
                                <select name="bicicleta_id" class="form-select" required>
                                    @foreach($bicicletas as $bicicleta)
                                        <option value="{{ $bicicleta->id }}" {{ old('bicicleta_id', $mantenimiento->bicicleta_id) == $bicicleta->id ? 'selected' : '' }}>
                                            {{ $bicicleta->marca }} {{ $bicicleta->modelo }} ({{ $bicicleta->tipo }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Tipo *</label>
                                <select name="tipo" class="form-select" required>
                                    @foreach(['preventivo','correctivo','revision','urgente'] as $tipo)
                                        <option value="{{ $tipo }}" {{ old('tipo', $mantenimiento->tipo) === $tipo ? 'selected' : '' }}>{{ ucfirst($tipo) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Estado *</label>
                                <select name="estado" class="form-select" required>
                                    @foreach(['pendiente','en_proceso','completado','cancelado'] as $estado)
                                        <option value="{{ $estado }}" {{ old('estado', $mantenimiento->estado) === $estado ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('_',' ', $estado)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Fecha inicio *</label>
                                <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio', optional($mantenimiento->fecha_inicio)->format('Y-m-d')) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Fecha fin prevista</label>
                                <input type="date" name="fecha_fin_prevista" class="form-control" value="{{ old('fecha_fin_prevista', optional($mantenimiento->fecha_fin_prevista)->format('Y-m-d')) }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Descripción *</label>
                                <textarea name="descripcion" class="form-control" rows="3" required>{{ old('descripcion', $mantenimiento->descripcion) }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Costo estimado (S/)</label>
                                <input type="number" step="0.01" name="costo_estimado" class="form-control" value="{{ old('costo_estimado', $mantenimiento->costo_estimado) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Técnico responsable</label>
                                <input type="text" name="tecnico_responsable" class="form-control" value="{{ old('tecnico_responsable', $mantenimiento->tecnico_responsable) }}" placeholder="Nombre del técnico">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Observaciones</label>
                                <textarea name="observaciones" class="form-control" rows="3">{{ old('observaciones', $mantenimiento->observaciones) }}</textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('mantenimientos.show', $mantenimiento) }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-8 col-lg-10 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold text-primary">
                            <i class="fas fa-tools me-2"></i>Nuevo Mantenimiento
                        </h4>
                        <a href="{{ route('mantenimientos.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Volver
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('mantenimientos.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="bicicleta_id" class="form-label">Bicicleta *</label>
                                <select name="bicicleta_id" id="bicicleta_id" class="form-select" required>
                                    <option value="">Seleccionar bicicleta</option>
                                    @foreach($bicicletas as $bicicleta)
                                        <option value="{{ $bicicleta->id }}">
                                            {{ $bicicleta->modelo }} - {{ $bicicleta->marca ?? 'Sin marca' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="tipo" class="form-label">Tipo de Mantenimiento *</label>
                                <select name="tipo" id="tipo" class="form-select" required>
                                    <option value="">Seleccionar tipo</option>
                                    <option value="preventivo">Preventivo</option>
                                    <option value="correctivo">Correctivo</option>
                                    <option value="urgente">Urgente</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fecha_inicio" class="form-label">Fecha de Inicio *</label>
                                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="fecha_fin_prevista" class="form-label">Fecha Fin Prevista</label>
                                <input type="date" name="fecha_fin_prevista" id="fecha_fin_prevista" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción del Mantenimiento *</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="4" placeholder="Describa los trabajos a realizar..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="costo_estimado" class="form-label">Costo Estimado (S/)</label>
                            <input type="number" step="0.01" name="costo_estimado" id="costo_estimado" class="form-control" placeholder="0.00">
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="reset" class="btn btn-outline-secondary me-md-2">
                                <i class="fas fa-redo me-1"></i> Limpiar
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Crear Mantenimiento
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('fecha_inicio').min = today;
        document.getElementById('fecha_fin_prevista').min = today;
    });
</script>
@endpush
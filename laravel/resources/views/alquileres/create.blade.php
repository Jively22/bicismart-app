@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold text-primary">
                            <i class="fas fa-plus-circle me-2"></i>Crear Nuevo Alquiler
                        </h4>
                        <a href="{{ route('alquileres.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Volver
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('alquileres.store') }}">
                        @csrf
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="text-primary mb-4">Información del Alquiler</h5>
                                
                                <div class="mb-3">
                                    <label for="usuario_id" class="form-label fw-semibold">Usuario *</label>
                                    <select class="form-select @error('usuario_id') is-invalid @enderror" name="usuario_id" id="usuario_id" required>
                                        <option value="">Seleccionar usuario</option>
                                        @foreach($usuarios as $usuario)
                                            <option value="{{ $usuario->id }}" {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}>
                                                {{ $usuario->name }} ({{ $usuario->email }}) - {{ $usuario->role }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('usuario_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="bicicleta_id" class="form-label fw-semibold">Bicicleta *</label>
                                    <select class="form-select @error('bicicleta_id') is-invalid @enderror" name="bicicleta_id" id="bicicleta_id" required>
                                        <option value="">Seleccionar bicicleta</option>
                                        @foreach($bicicletas as $bicicleta)
                                            <option value="{{ $bicicleta->id }}" {{ old('bicicleta_id') == $bicicleta->id ? 'selected' : '' }}
                                                data-precio="{{ $bicicleta->precio_alquiler_hora }}">
                                                {{ $bicicleta->marca }} {{ $bicicleta->modelo }} - S/{{ number_format($bicicleta->precio_alquiler_hora, 2) }}/hora
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('bicicleta_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="tipo_alquiler" class="form-label fw-semibold">Tipo de Alquiler *</label>
                                        <select class="form-select @error('tipo_alquiler') is-invalid @enderror" name="tipo_alquiler" id="tipo_alquiler" required>
                                            <option value="">Seleccionar tipo</option>
                                            <option value="individual" {{ old('tipo_alquiler') == 'individual' ? 'selected' : '' }}>Individual</option>
                                            <option value="corporativo" {{ old('tipo_alquiler') == 'corporativo' ? 'selected' : '' }}>Corporativo</option>
                                        </select>
                                        @error('tipo_alquiler')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="cantidad_bicicletas" class="form-label fw-semibold">Cantidad *</label>
                                        <input type="number" class="form-control @error('cantidad_bicicletas') is-invalid @enderror" 
                                               name="cantidad_bicicletas" id="cantidad_bicicletas"
                                               value="{{ old('cantidad_bicicletas', 1) }}" min="1" required>
                                        @error('cantidad_bicicletas')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <h5 class="text-primary mb-4">Fechas y Estado</h5>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="fecha_inicio" class="form-label fw-semibold">Fecha de Inicio *</label>
                                        <input type="datetime-local" class="form-control @error('fecha_inicio') is-invalid @enderror" 
                                               name="fecha_inicio" id="fecha_inicio"
                                               value="{{ old('fecha_inicio') }}" required>
                                        @error('fecha_inicio')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="fecha_fin" class="form-label fw-semibold">Fecha de Fin *</label>
                                        <input type="datetime-local" class="form-control @error('fecha_fin') is-invalid @enderror" 
                                               name="fecha_fin" id="fecha_fin"
                                               value="{{ old('fecha_fin') }}" required>
                                        @error('fecha_fin')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="total" class="form-label fw-semibold">Total (S/) *</label>
                                        <input type="number" step="0.01" class="form-control @error('total') is-invalid @enderror" 
                                               name="total" id="total"
                                               value="{{ old('total') }}" required readonly>
                                        @error('total')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="form-text">Calculado automáticamente</div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="estado" class="form-label fw-semibold">Estado *</label>
                                        <select class="form-select @error('estado') is-invalid @enderror" name="estado" id="estado" required>
                                            <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                            <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                                            <option value="finalizado" {{ old('estado') == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                                            <option value="cancelado" {{ old('estado') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                                        </select>
                                        @error('estado')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Campos para alquiler corporativo -->
                        <div id="campos-corporativo" style="display: none;">
                            <div class="row mt-4 pt-4 border-top">
                                <div class="col-12">
                                    <h5 class="text-primary mb-4">Información Corporativa</h5>
                                </div>
                                <div class="col-md-6">
                                    <label for="razon_social" class="form-label fw-semibold">Razón Social</label>
                                    <input type="text" class="form-control @error('razon_social') is-invalid @enderror" 
                                           name="razon_social" id="razon_social"
                                           value="{{ old('razon_social') }}"
                                           placeholder="Nombre de la empresa">
                                    @error('razon_social')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="ruc_empresa" class="form-label fw-semibold">RUC Empresa</label>
                                    <input type="text" class="form-control @error('ruc_empresa') is-invalid @enderror" 
                                           name="ruc_empresa" id="ruc_empresa"
                                           value="{{ old('ruc_empresa') }}"
                                           placeholder="20XXXXXXXXX">
                                    @error('ruc_empresa')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-end mt-4 pt-4 border-top">
                            <a href="{{ route('alquileres.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar Alquiler
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tipoAlquiler = document.getElementById('tipo_alquiler');
    const camposCorporativo = document.getElementById('campos-corporativo');
    const bicicletaSelect = document.getElementById('bicicleta_id');
    const cantidadInput = document.getElementById('cantidad_bicicletas');
    const totalInput = document.getElementById('total');
    
    function toggleCamposCorporativo() {
        if (tipoAlquiler.value === 'corporativo') {
            camposCorporativo.style.display = 'block';
        } else {
            camposCorporativo.style.display = 'none';
        }
    }
    
    function calcularTotal() {
        const selectedOption = bicicletaSelect.options[bicicletaSelect.selectedIndex];
        const precio = selectedOption ? parseFloat(selectedOption.getAttribute('data-precio')) : 0;
        const cantidad = parseInt(cantidadInput.value) || 1;
        
        if (precio > 0) {
            // Calcular horas entre fechas (simplificado)
            const fechaInicio = new Date(document.getElementById('fecha_inicio').value);
            const fechaFin = new Date(document.getElementById('fecha_fin').value);
            
            if (fechaInicio && fechaFin && fechaFin > fechaInicio) {
                const horas = (fechaFin - fechaInicio) / (1000 * 60 * 60);
                const total = precio * cantidad * Math.max(1, horas);
                totalInput.value = total.toFixed(2);
            } else {
                totalInput.value = (precio * cantidad).toFixed(2);
            }
        } else {
            totalInput.value = '';
        }
    }
    
    tipoAlquiler.addEventListener('change', toggleCamposCorporativo);
    bicicletaSelect.addEventListener('change', calcularTotal);
    cantidadInput.addEventListener('input', calcularTotal);
    document.getElementById('fecha_inicio').addEventListener('change', calcularTotal);
    document.getElementById('fecha_fin').addEventListener('change', calcularTotal);
    
    // Initialize
    toggleCamposCorporativo();
    calcularTotal();
});
</script>

<style>
.form-control, .form-select {
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #10b981;
    box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
}

.card {
    border-radius: 15px;
}
</style>
@endsection
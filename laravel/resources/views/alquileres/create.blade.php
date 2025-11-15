@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Crear Nuevo Alquiler</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('alquileres.store') }}">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="usuario_id" class="form-label">Usuario *</label>
                                <select class="form-select" name="usuario_id" id="usuario_id" required>
                                    <option value="">Seleccionar usuario</option>
                                    @foreach($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}" {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}>
                                            {{ $usuario->name }} ({{ $usuario->email }}) - {{ $usuario->role }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="bicicleta_id" class="form-label">Bicicleta *</label>
                                <select class="form-select" name="bicicleta_id" id="bicicleta_id" required>
                                    <option value="">Seleccionar bicicleta</option>
                                    @foreach($bicicletas as $bicicleta)
                                        <option value="{{ $bicicleta->id }}" {{ old('bicicleta_id') == $bicicleta->id ? 'selected' : '' }}>
                                            {{ $bicicleta->marca }} {{ $bicicleta->modelo }} - S/{{ number_format($bicicleta->precio_alquiler_hora, 2) }}/hora
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tipo_alquiler" class="form-label">Tipo de Alquiler *</label>
                                <select class="form-select" name="tipo_alquiler" id="tipo_alquiler" required>
                                    <option value="">Seleccionar tipo</option>
                                    <option value="individual" {{ old('tipo_alquiler') == 'individual' ? 'selected' : '' }}>Individual</option>
                                    <option value="corporativo" {{ old('tipo_alquiler') == 'corporativo' ? 'selected' : '' }}>Corporativo</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="cantidad_bicicletas" class="form-label">Cantidad de Bicicletas *</label>
                                <input type="number" class="form-control" name="cantidad_bicicletas" id="cantidad_bicicletas"
                                       value="{{ old('cantidad_bicicletas', 1) }}" min="1" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="fecha_inicio" class="form-label">Fecha de Inicio *</label>
                                <input type="datetime-local" class="form-control" name="fecha_inicio" id="fecha_inicio"
                                       value="{{ old('fecha_inicio') }}" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="fecha_fin" class="form-label">Fecha de Fin *</label>
                                <input type="datetime-local" class="form-control" name="fecha_fin" id="fecha_fin"
                                       value="{{ old('fecha_fin') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="total" class="form-label">Total (S/) *</label>
                                <input type="number" step="0.01" class="form-control" name="total" id="total"
                                       value="{{ old('total') }}" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="estado" class="form-label">Estado *</label>
                                <select class="form-select" name="estado" id="estado" required>
                                    <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="finalizado" {{ old('estado') == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                                    <option value="cancelado" {{ old('estado') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                                </select>
                            </div>
                        </div>

                        <!-- Campos para alquiler corporativo -->
                        <div id="campos-corporativo" style="display: none;">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="razon_social" class="form-label">Razón Social</label>
                                    <input type="text" class="form-control" name="razon_social" id="razon_social"
                                           value="{{ old('razon_social') }}">
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="ruc_empresa" class="form-label">RUC Empresa</label>
                                    <input type="text" class="form-control" name="ruc_empresa" id="ruc_empresa"
                                           value="{{ old('ruc_empresa') }}">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">Guardar Alquiler</button>
                            <a href="{{ route('alquileres.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('tipo_alquiler').addEventListener('change', function() {
    const camposCorporativo = document.getElementById('campos-corporativo');
    if (this.value === 'corporativo') {
        camposCorporativo.style.display = 'block';
    } else {
        camposCorporativo.style.display = 'none';
    }
});
</script>
@endsection
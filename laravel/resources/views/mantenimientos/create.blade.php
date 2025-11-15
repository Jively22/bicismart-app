@extends('layouts.dashboard')

@section('page-title', 'Crear Mantenimiento')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Crear Nuevo Mantenimiento</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('mantenimientos.store') }}">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="usuario_id" class="form-label">Cliente *</label>
                                <select class="form-select" name="usuario_id" id="usuario_id" required>
                                    <option value="">Seleccionar cliente</option>
                                    @foreach($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}" {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}>
                                            {{ $usuario->name }} ({{ $usuario->email }}) - {{ $usuario->role }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="tecnico_id" class="form-label">Técnico *</label>
                                <select class="form-select" name="tecnico_id" id="tecnico_id" required>
                                    <option value="">Seleccionar técnico</option>
                                    @foreach($tecnicos as $tecnico)
                                        <option value="{{ $tecnico->id }}" {{ old('tecnico_id') == $tecnico->id ? 'selected' : '' }}>
                                            {{ $tecnico->name }} ({{ $tecnico->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="marca_bicicleta" class="form-label">Marca de la Bicicleta *</label>
                                <input type="text" class="form-control" name="marca_bicicleta" id="marca_bicicleta"
                                       value="{{ old('marca_bicicleta') }}" required
                                       placeholder="Ej: Trek, Specialized, Giant">
                            </div>
                            
                            <div class="col-md-6">
                                <label for="modelo_bicicleta" class="form-label">Modelo de la Bicicleta *</label>
                                <input type="text" class="form-control" name="modelo_bicicleta" id="modelo_bicicleta"
                                       value="{{ old('modelo_bicicleta') }}" required
                                       placeholder="Ej: Marlin 5, Sirrus X, Escape 3">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="descripcion_problema" class="form-label">Descripción del Problema *</label>
                                <textarea class="form-control" name="descripcion_problema" id="descripcion_problema" 
                                          rows="4" required placeholder="Describe el problema o servicio requerido...">{{ old('descripcion_problema') }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="precio_pactado" class="form-label">Precio Pactado (S/)</label>
                                <input type="number" step="0.01" class="form-control" name="precio_pactado" id="precio_pactado"
                                       value="{{ old('precio_pactado') }}"
                                       placeholder="0.00">
                                <div class="form-text">Dejar en blanco si aún no se ha cotizado</div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-2"></i>Crear Mantenimiento
                            </button>
                            <a href="{{ route('mantenimientos.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold text-primary">
                            <i class="fas fa-plus-circle me-2"></i>Crear Nueva Bicicleta
                        </h4>
                        <a href="{{ route('bicicletas.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Volver
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('bicicletas.store') }}">
                        @csrf
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="text-primary mb-4">Información Básica</h5>
                                
                                <div class="mb-3">
                                    <label for="marca" class="form-label fw-semibold">Marca *</label>
                                    <input type="text" class="form-control @error('marca') is-invalid @enderror" 
                                           name="marca" id="marca" value="{{ old('marca') }}" required
                                           placeholder="Ej: Trek, Specialized, Giant">
                                    @error('marca')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="modelo" class="form-label fw-semibold">Modelo *</label>
                                    <input type="text" class="form-control @error('modelo') is-invalid @enderror" 
                                           name="modelo" id="modelo" value="{{ old('modelo') }}" required
                                           placeholder="Ej: X-Caliber 8, Sirrus X, TCR Advanced">
                                    @error('modelo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="tipo" class="form-label fw-semibold">Tipo *</label>
                                        <select class="form-select @error('tipo') is-invalid @enderror" name="tipo" id="tipo" required>
                                            <option value="">Seleccionar tipo</option>
                                            <option value="montaña" {{ old('tipo') == 'montaña' ? 'selected' : '' }}>Montaña</option>
                                            <option value="ruta" {{ old('tipo') == 'ruta' ? 'selected' : '' }}>Ruta</option>
                                            <option value="urbana" {{ old('tipo') == 'urbana' ? 'selected' : '' }}>Urbana</option>
                                            <option value="eléctrica" {{ old('tipo') == 'eléctrica' ? 'selected' : '' }}>Eléctrica</option>
                                            <option value="híbrida" {{ old('tipo') == 'híbrida' ? 'selected' : '' }}>Híbrida</option>
                                        </select>
                                        @error('tipo')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="tamaño" class="form-label fw-semibold">Tamaño *</label>
                                        <input type="text" class="form-control @error('tamaño') is-invalid @enderror" 
                                               name="tamaño" id="tamaño" value="{{ old('tamaño') }}" required 
                                               placeholder="Ej: M, L, XL, 26'', 29''">
                                        @error('tamaño')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="estado" class="form-label fw-semibold">Estado *</label>
                                    <select class="form-select @error('estado') is-invalid @enderror" name="estado" id="estado" required>
                                        <option value="nuevo" {{ old('estado') == 'nuevo' ? 'selected' : '' }}>Nuevo</option>
                                        <option value="usado" {{ old('estado') == 'usado' ? 'selected' : '' }}>Usado</option>
                                    </select>
                                    @error('estado')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <h5 class="text-primary mb-4">Precios y Disponibilidad</h5>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="precio_venta" class="form-label fw-semibold">Precio Venta (S/)</label>
                                        <input type="number" step="0.01" class="form-control @error('precio_venta') is-invalid @enderror" 
                                               name="precio_venta" id="precio_venta" value="{{ old('precio_venta') }}"
                                               placeholder="0.00">
                                        @error('precio_venta')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="form-text">Dejar en blanco si no está disponible para venta</div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="precio_alquiler_hora" class="form-label fw-semibold">Precio Alquiler/Hora (S/)</label>
                                        <input type="number" step="0.01" class="form-control @error('precio_alquiler_hora') is-invalid @enderror" 
                                               name="precio_alquiler_hora" id="precio_alquiler_hora" value="{{ old('precio_alquiler_hora') }}"
                                               placeholder="0.00">
                                        @error('precio_alquiler_hora')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="form-text">Dejar en blanco si no está disponible para alquiler</div>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Disponibilidad</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="disponible_para_venta" 
                                                       id="disponible_para_venta" value="1" {{ old('disponible_para_venta', true) ? 'checked' : '' }}>
                                                <label class="form-check-label fw-semibold" for="disponible_para_venta">
                                                    Disponible para venta
                                                </label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="disponible_para_alquiler" 
                                                       id="disponible_para_alquiler" value="1" {{ old('disponible_para_alquiler', true) ? 'checked' : '' }}>
                                                <label class="form-check-label fw-semibold" for="disponible_para_alquiler">
                                                    Disponible para alquiler
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label fw-semibold">Descripción *</label>
                                    <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                              name="descripcion" id="descripcion" required rows="4"
                                              placeholder="Describe la bicicleta, características, componentes...">{{ old('descripcion') }}</textarea>
                                    @error('descripcion')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-end mt-4 pt-4 border-top">
                            <a href="{{ route('bicicletas.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar Bicicleta
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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

.form-check-input:checked {
    background-color: #10b981;
    border-color: #10b981;
}

.card {
    border-radius: 15px;
}
</style>
@endsection
@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Editar Bicicleta</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('bicicletas.update', $bicicleta) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="marca" class="form-label">Marca *</label>
                                <input type="text" class="form-control" name="marca" id="marca" 
                                       value="{{ old('marca', $bicicleta->marca) }}" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="modelo" class="form-label">Modelo *</label>
                                <input type="text" class="form-control" name="modelo" id="modelo"
                                       value="{{ old('modelo', $bicicleta->modelo) }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tipo" class="form-label">Tipo *</label>
                                <select class="form-select" name="tipo" id="tipo" required>
                                    <option value="">Seleccionar tipo</option>
                                    <option value="montaña" {{ old('tipo', $bicicleta->tipo) == 'montaña' ? 'selected' : '' }}>Montaña</option>
                                    <option value="ruta" {{ old('tipo', $bicicleta->tipo) == 'ruta' ? 'selected' : '' }}>Ruta</option>
                                    <option value="urbana" {{ old('tipo', $bicicleta->tipo) == 'urbana' ? 'selected' : '' }}>Urbana</option>
                                    <option value="eléctrica" {{ old('tipo', $bicicleta->tipo) == 'eléctrica' ? 'selected' : '' }}>Eléctrica</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="tamaño" class="form-label">Tamaño *</label>
                                <input type="text" class="form-control" name="tamaño" id="tamaño"
                                       value="{{ old('tamaño', $bicicleta->tamaño) }}" required 
                                       placeholder="Ej: M, L, XL, 26'', 29''">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="estado" class="form-label">Estado *</label>
                                <select class="form-select" name="estado" id="estado" required>
                                    <option value="nuevo" {{ old('estado', $bicicleta->estado) == 'nuevo' ? 'selected' : '' }}>Nuevo</option>
                                    <option value="usado" {{ old('estado', $bicicleta->estado) == 'usado' ? 'selected' : '' }}>Usado</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="precio_venta" class="form-label">Precio Venta (S/)</label>
                                <input type="number" step="0.01" class="form-control" name="precio_venta" id="precio_venta"
                                       value="{{ old('precio_venta', $bicicleta->precio_venta) }}">
                            </div>
                            
                            <div class="col-md-6">
                                <label for="precio_alquiler_hora" class="form-label">Precio Alquiler/Hora (S/)</label>
                                <input type="number" step="0.01" class="form-control" name="precio_alquiler_hora" id="precio_alquiler_hora"
                                       value="{{ old('precio_alquiler_hora', $bicicleta->precio_alquiler_hora) }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="descripcion" class="form-label">Descripción *</label>
                                <textarea class="form-control" name="descripcion" id="descripcion" required rows="3"
                                          placeholder="Describe la bicicleta...">{{ old('descripcion', $bicicleta->descripcion) }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="disponible_para_venta" id="disponible_para_venta" value="1" 
                                           {{ old('disponible_para_venta', $bicicleta->disponible_para_venta) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="disponible_para_venta">
                                        Disponible para venta
                                    </label>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="disponible_para_alquiler" id="disponible_para_alquiler" value="1"
                                           {{ old('disponible_para_alquiler', $bicicleta->disponible_para_alquiler) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="disponible_para_alquiler">
                                        Disponible para alquiler
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">Actualizar Bicicleta</button>
                            <a href="{{ route('bicicletas.show', $bicicleta) }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
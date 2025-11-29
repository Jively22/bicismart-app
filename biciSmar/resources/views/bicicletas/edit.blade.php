@extends('layouts.app')

@section('title','Editar bicicleta')

@section('content')
<div class="container py-4">
    <h1 class="fw-bold text-success mb-3">Editar bicicleta</h1>

    <form action="{{ route('bicicletas.update', $bicicleta) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $bicicleta->nombre) }}" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Tipo</label>
                <select name="tipo" class="form-select" required>
                    <option value="venta" {{ old('tipo',$bicicleta->tipo)=='venta'?'selected':'' }}>Venta</option>
                    <option value="alquiler" {{ old('tipo',$bicicleta->tipo)=='alquiler'?'selected':'' }}>Alquiler</option>
                    <option value="mixto" {{ old('tipo',$bicicleta->tipo)=='mixto'?'selected':'' }}>Mixto</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" value="{{ old('stock',$bicicleta->stock) }}" min="0" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Precio venta (S/)</label>
                <input type="number" step="0.01" name="precio_venta" value="{{ old('precio_venta',$bicicleta->precio_venta) }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Precio alquiler x hora (S/)</label>
                <input type="number" step="0.01" name="precio_alquiler_hora" value="{{ old('precio_alquiler_hora',$bicicleta->precio_alquiler_hora) }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-select">
                    <option value="disponible" {{ old('estado',$bicicleta->estado)=='disponible'?'selected':'' }}>Disponible</option>
                    <option value="no_disponible" {{ old('estado',$bicicleta->estado)=='no_disponible'?'selected':'' }}>No disponible</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" rows="3" class="form-control">{{ old('descripcion',$bicicleta->descripcion) }}</textarea>
            </div>
        </div>

        <div class="mt-4">
            <button class="btn btn-success">Actualizar</button>
            <a href="{{ route('bicicletas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection

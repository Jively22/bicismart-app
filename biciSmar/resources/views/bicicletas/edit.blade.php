@extends('layouts.app')

@section('content')
<div class="max-w-3xl">
    <span class="pill mb-3 inline-flex">Editar bicicleta</span>
    <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Actualizar datos</h1>
    <p class="text-sm text-gray-600 mb-4">Ajusta stock, precios y descripción sin perder coherencia visual.</p>

    <form action="{{ route('admin.bicicletas.update', $bicicleta->id) }}" method="POST" enctype="multipart/form-data"
          class="surface-card border border-green-50 p-6 space-y-4">
        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-2 gap-4">
            <div class="form-field">
                <label>Nombre</label>
                <input type="text" name="nombre" value="{{ $bicicleta->nombre }}" required>
            </div>
            <div class="form-field">
                <label>Tipo</label>
                <select name="tipo" required>
                    <option value="venta" @if($bicicleta->tipo=='venta') selected @endif>Venta</option>
                    <option value="alquiler" @if($bicicleta->tipo=='alquiler') selected @endif>Alquiler</option>
                    <option value="mixto" @if($bicicleta->tipo=='mixto') selected @endif>Mixto</option>
                </select>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="form-field">
                <label>Precio de venta (opcional)</label>
                <input type="number" step="0.01" name="precio_venta" value="{{ $bicicleta->precio_venta }}">
            </div>
            <div class="form-field">
                <label>Precio alquiler por hora (opcional)</label>
                <input type="number" step="0.01" name="precio_alquiler_hora" value="{{ $bicicleta->precio_alquiler_hora }}">
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="form-field">
                <label>Stock</label>
                <input type="number" name="stock" value="{{ $bicicleta->stock }}" required>
            </div>
            <div class="form-field">
                <label>Estado</label>
                <select name="estado">
                    <option value="disponible" @if($bicicleta->estado=='disponible') selected @endif>Disponible</option>
                    <option value="no disponible" @if($bicicleta->estado=='no disponible') selected @endif>No disponible</option>
                </select>
            </div>
        </div>

        <div class="form-field">
            <label>Descripción</label>
            <textarea name="descripcion" rows="3">{{ $bicicleta->descripcion }}</textarea>
        </div>

        <div class="form-field">
            <label>Foto</label>
            <input type="file" name="foto">
            @if($bicicleta->foto)
                <p class="text-xs text-gray-500 mt-1">Foto actual: {{ $bicicleta->foto }}</p>
            @endif
        </div>

        <button class="btn-brand px-5">Actualizar bicicleta</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="max-w-3xl">
    <span class="pill mb-3 inline-flex">Nueva bicicleta</span>
    <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Crear bicicleta</h1>
    <p class="text-sm text-gray-600 mb-4">Carga la información, precios y foto para habilitarla en el catálogo.</p>

    <form action="{{ route('admin.bicicletas.store') }}" method="POST" enctype="multipart/form-data"
          class="surface-card border border-green-50 p-6 space-y-4">
        @csrf

        <div class="grid md:grid-cols-2 gap-4">
            <div class="form-field">
                <label>Nombre</label>
                <input type="text" name="nombre" required>
            </div>
            <div class="form-field">
                <label>Tipo</label>
                <select name="tipo" required>
                    <option value="venta">Venta</option>
                    <option value="alquiler">Alquiler</option>
                    <option value="mixto">Mixto</option>
                </select>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="form-field">
                <label>Precio de venta (opcional)</label>
                <input type="number" step="0.01" name="precio_venta">
            </div>
            <div class="form-field">
                <label>Precio alquiler por hora (opcional)</label>
                <input type="number" step="0.01" name="precio_alquiler_hora">
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="form-field">
                <label>Stock</label>
                <input type="number" name="stock" required>
            </div>
            <div class="form-field">
                <label>Estado</label>
                <select name="estado">
                    <option value="disponible" selected>Disponible</option>
                    <option value="no disponible">No disponible</option>
                </select>
            </div>
        </div>

        <div class="form-field">
            <label>Descripción</label>
            <textarea name="descripcion" rows="3"></textarea>
        </div>

        <div class="form-field">
            <label>Foto</label>
            <input type="file" name="foto">
        </div>

        <button class="btn-brand px-5">Guardar bicicleta</button>
    </form>
</div>
@endsection

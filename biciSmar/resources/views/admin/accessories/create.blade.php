@extends('layouts.app')

@section('content')
<div class="max-w-3xl">
    <span class="pill mb-3 inline-flex">Nuevo accesorio</span>
    <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Crear accesorio</h1>
    <p class="text-sm text-gray-600 mb-4">Partes, repuestos o merch para ciclismo.</p>

    <form action="{{ route('admin.accesories.store') }}" method="POST" enctype="multipart/form-data"
          class="surface-card border border-green-50 p-6 space-y-4">
        @csrf

        <div class="form-field">
            <label>Nombre</label>
            <input type="text" name="nombre" required>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="form-field">
                <label>Categoría</label>
                <select name="categoria">
                    <option value="parte">Parte</option>
                    <option value="repuesto">Repuesto</option>
                    <option value="merch">Merch</option>
                </select>
            </div>
            <div class="form-field">
                <label>Proveedor</label>
                <select name="tag">
                    <option value="oficial">Técnico oficial</option>
                    <option value="asociado">Asociado externo</option>
                </select>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="form-field">
                <label>Precio</label>
                <input type="number" step="0.01" name="precio" required>
            </div>
            <div class="form-field">
                <label>Stock</label>
                <input type="number" name="stock" min="0" value="0" required>
            </div>
        </div>

        <div class="form-field">
            <label>Estado</label>
            <select name="estado">
                <option value="disponible">Disponible</option>
                <option value="no disponible">No disponible</option>
            </select>
        </div>

        <div class="form-field">
            <label>Descripción</label>
            <textarea name="descripcion" rows="3"></textarea>
        </div>

        <div class="form-field">
            <label>Foto</label>
            <input type="file" name="foto">
            <p class="text-xs text-gray-500 mt-1">Formato recomendado cuadrado, se mostrará en listados.</p>
        </div>

        <button class="btn-brand px-5">Guardar accesorio</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="max-w-3xl">
    <span class="pill mb-3 inline-flex">Editar accesorio</span>
    <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Actualizar datos</h1>

    <form action="{{ route('admin.accesories.update', $accesory) }}" method="POST" enctype="multipart/form-data"
          class="surface-card border border-green-50 p-6 space-y-4">
        @csrf
        @method('PUT')

        <div class="form-field">
            <label>Nombre</label>
            <input type="text" name="nombre" value="{{ $accesory->nombre }}" required>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="form-field">
                <label>Categoría</label>
                <select name="categoria">
                    <option value="parte" @selected($accesory->categoria==='parte')>Parte</option>
                    <option value="repuesto" @selected($accesory->categoria==='repuesto')>Repuesto</option>
                    <option value="merch" @selected($accesory->categoria==='merch')>Merch</option>
                </select>
            </div>
            <div class="form-field">
                <label>Proveedor</label>
                <select name="tag">
                    <option value="oficial" @selected($accesory->tag==='oficial')>Técnico oficial</option>
                    <option value="asociado" @selected($accesory->tag==='asociado')>Asociado externo</option>
                </select>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="form-field">
                <label>Precio</label>
                <input type="number" step="0.01" name="precio" value="{{ $accesory->precio }}" required>
            </div>
            <div class="form-field">
                <label>Stock</label>
                <input type="number" name="stock" min="0" value="{{ $accesory->stock }}" required>
            </div>
        </div>

        <div class="form-field">
            <label>Estado</label>
            <select name="estado">
                <option value="disponible" @selected($accesory->estado==='disponible')>Disponible</option>
                <option value="no disponible" @selected($accesory->estado==='no disponible')>No disponible</option>
            </select>
        </div>

        <div class="form-field">
            <label>Descripción</label>
            <textarea name="descripcion" rows="3">{{ $accesory->descripcion }}</textarea>
        </div>

        <div class="form-field">
            <label>Foto</label>
            <input type="file" name="foto">
            @if($accesory->foto)
                <p class="text-xs text-gray-500 mt-1">Foto actual: {{ $accesory->foto }}</p>
            @endif
            <p class="text-xs text-gray-500 mt-1">Formato recomendado cuadrado, se mostrará en listados.</p>
        </div>

        <button class="btn-brand px-5">Actualizar accesorio</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-green-700 mb-6">Nueva Bicicleta</h1>

<form action="{{ route('admin.bicicletas.store') }}" method="POST" enctype="multipart/form-data"
      class="bg-white rounded shadow p-6 max-w-xl">
    @csrf

    <div class="mb-4">
        <label class="font-semibold">Nombre</label>
        <input type="text" name="nombre" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="font-semibold">Tipo</label>
        <select name="tipo" class="w-full border rounded px-3 py-2" required>
            <option value="venta">Venta</option>
            <option value="alquiler">Alquiler</option>
            <option value="mixto">Mixto</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="font-semibold">Precio de venta (opcional)</label>
        <input type="number" step="0.01" name="precio_venta" class="w-full border rounded px-3 py-2">
    </div>

    <div class="mb-4">
        <label class="font-semibold">Precio alquiler por hora (opcional)</label>
        <input type="number" step="0.01" name="precio_alquiler_hora" class="w-full border rounded px-3 py-2">
    </div>

    <div class="mb-4">
        <label class="font-semibold">Stock</label>
        <input type="number" name="stock" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="font-semibold">Estado</label>
        <select name="estado" class="w-full border rounded px-3 py-2">
            <option value="disponible" selected>Disponible</option>
            <option value="no disponible">No disponible</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="font-semibold">Descripción</label>
        <textarea name="descripcion" class="w-full border rounded px-3 py-2"></textarea>
    </div>

    <div class="mb-4">
        <label class="font-semibold">Foto</label>
        <input type="file" name="foto" class="w-full">
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">Guardar</button>
</form>
@endsection

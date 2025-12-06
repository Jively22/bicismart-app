@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-green-700 mb-6">Nuevo servicio de mantenimiento</h1>

<form action="{{ route('admin.mantenimientos.store') }}" method="POST"
      class="bg-white rounded shadow p-6 max-w-xl">
    @csrf

    <div class="mb-4">
        <label class="font-semibold">Nombre</label>
        <input type="text" name="nombre" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="font-semibold">Descripción</label>
        <textarea name="descripcion" class="w-full border rounded px-3 py-2"></textarea>
    </div>

    <div class="mb-4">
        <label class="font-semibold">Precio</label>
        <input type="number" step="0.01" name="precio" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="font-semibold">Tipo de servicio</label>
        <select name="tipo_servicio" class="w-full border rounded px-3 py-2">
            <option value="interno">Interno (BiciSmart)</option>
            <option value="externo">Externo (Técnicos independientes)</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="font-semibold">Proveedor (opcional)</label>
        <input type="text" name="proveedor" class="w-full border rounded px-3 py-2" placeholder="Nombre del proveedor externo">
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">Guardar</button>
</form>
@endsection

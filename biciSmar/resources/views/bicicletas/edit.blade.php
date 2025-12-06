@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-green-700 mb-6">Editar Bicicleta</h1>

<form action="{{ route('admin.bicicletas.update', $bicicleta->id) }}" method="POST" enctype="multipart/form-data"
      class="bg-white rounded shadow p-6 max-w-xl">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="font-semibold">Nombre</label>
        <input type="text" name="nombre" class="w-full border rounded px-3 py-2"
               value="{{ $bicicleta->nombre }}" required>
    </div>

    <div class="mb-4">
        <label class="font-semibold">Tipo</label>
        <select name="tipo" class="w-full border rounded px-3 py-2" required>
            <option value="venta" {{ $bicicleta->tipo=='venta'?'selected':'' }}>Venta</option>
            <option value="alquiler" {{ $bicicleta->tipo=='alquiler'?'selected':'' }}>Alquiler</option>
            <option value="mixto" {{ $bicicleta->tipo=='mixto'?'selected':'' }}>Mixto</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="font-semibold">Precio de venta</label>
        <input type="number" step="0.01" name="precio_venta" class="w-full border rounded px-3 py-2"
               value="{{ $bicicleta->precio_venta }}">
    </div>

    <div class="mb-4">
        <label class="font-semibold">Precio alquiler por hora</label>
        <input type="number" step="0.01" name="precio_alquiler_hora" class="w-full border rounded px-3 py-2"
               value="{{ $bicicleta->precio_alquiler_hora }}">
    </div>

    <div class="mb-4">
        <label class="font-semibold">Stock</label>
        <input type="number" name="stock" class="w-full border rounded px-3 py-2"
               value="{{ $bicicleta->stock }}" required>
    </div>

    <div class="mb-4">
        <label class="font-semibold">Estado</label>
        <select name="estado" class="w-full border rounded px-3 py-2">
            <option value="disponible" {{ $bicicleta->estado=='disponible'?'selected':'' }}>Disponible</option>
            <option value="no disponible" {{ $bicicleta->estado=='no disponible'?'selected':'' }}>No disponible</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="font-semibold">Descripción</label>
        <textarea name="descripcion" class="w-full border rounded px-3 py-2">{{ $bicicleta->descripcion }}</textarea>
    </div>

    <div class="mb-4">
        <label class="font-semibold">Foto</label><br>
        @if($bicicleta->foto)
            <img src="{{ asset('storage/'.$bicicleta->foto) }}" class="w-40 h-24 object-cover rounded mb-2" alt="Foto actual de {{ $bicicleta->nombre }}">
        @else
            <span class="text-gray-500">Sin imagen</span>
        @endif
        <input type="file" name="foto" class="w-full">
        <p class="text-xs text-gray-500 mt-1">Puedes subir una nueva imagen para reemplazar la actual.</p>
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">Actualizar</button>
</form>
@endsection

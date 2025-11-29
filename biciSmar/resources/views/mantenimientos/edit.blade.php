@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10 max-w-2xl">
    <h1 class="text-3xl font-bold mb-6 text-green-700">Editar Servicio de Mantenimiento</h1>

    <form action="{{ route('mantenimientos.update', $mantenimiento->id) }}" method="POST"
          class="bg-white p-8 rounded-xl shadow-lg space-y-5 border border-green-100">
        @csrf
        @method('PUT')

        <div>
            <label class="font-semibold text-gray-700">Nombre del servicio</label>
            <input type="text" name="nombre" value="{{ $mantenimiento->nombre }}"
                class="w-full p-3 border rounded-lg focus:ring focus:ring-green-300" required>
        </div>

        <div>
            <label class="font-semibold text-gray-700">Descripción</label>
            <textarea name="descripcion" rows="4"
                class="w-full p-3 border rounded-lg focus:ring focus:ring-green-300">{{ $mantenimiento->descripcion }}</textarea>
        </div>

        <div>
            <label class="font-semibold text-gray-700">Precio</label>
            <input type="number" step="0.01" name="precio" value="{{ $mantenimiento->precio }}"
                class="w-full p-3 border rounded-lg focus:ring focus:ring-green-300" required>
        </div>

        <div>
            <label class="font-semibold text-gray-700">Tipo de servicio</label>
            <select name="tipo_servicio"
                class="w-full p-3 border rounded-lg focus:ring focus:ring-green-300">
                <option value="interno" {{ $mantenimiento->tipo_servicio=='interno'?'selected':'' }}>Interno</option>
                <option value="externo" {{ $mantenimiento->tipo_servicio=='externo'?'selected':'' }}>Externo</option>
            </select>
        </div>

        <div>
            <label class="font-semibold text-gray-700">Técnico</label>
            <input type="text" name="tecnico" value="{{ $mantenimiento->tecnico }}"
                class="w-full p-3 border rounded-lg focus:ring focus:ring-green-300" required>
        </div>

        <button class="bg-green-600 text-white px-6 py-3 rounded-lg">Actualizar</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-4">Solicitar mantenimiento</h1>

<div class="bg-white/90 rounded-3xl shadow-md border border-gray-100 p-6 max-w-2xl">
    <div class="mb-4">
        <p class="text-xs uppercase text-gray-500">{{ strtoupper($mantenimiento->tipo_servicio) }}</p>
        <h2 class="text-lg font-bold text-gray-900">{{ $mantenimiento->nombre }}</h2>
        <p class="text-sm text-gray-600 mb-1">{{ $mantenimiento->descripcion }}</p>
        <p class="text-sm font-semibold text-green-700">S/ {{ number_format($mantenimiento->precio, 2) }}</p>
    </div>

    <form action="{{ route('mantenimientos.enviar', $mantenimiento) }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="font-semibold">¿Es para bicicleta individual o flota?</label>
            <select name="tipo_objetivo" class="w-full border rounded px-3 py-2">
                <option value="bicicleta">Bicicleta individual</option>
                <option value="flota">Flota</option>
            </select>
        </div>

        <div>
            <label class="font-semibold">Identificador de bicicleta / flota</label>
            <input type="text" name="nombre_objetivo" class="w-full border rounded px-3 py-2" placeholder="Ej: Bici #12 o Flota Lima" required>
        </div>

        <div>
            <label class="font-semibold">Cantidad (si aplica)</label>
            <input type="number" name="cantidad" min="1" value="1" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="font-semibold">Notas adicionales</label>
            <textarea name="notas" rows="3" class="w-full border rounded px-3 py-2" placeholder="Disponibilidad, ubicación o comentarios"></textarea>
        </div>

        <button class="bg-green-700 text-white px-4 py-2 rounded-lg">Enviar solicitud</button>
    </form>
</div>
@endsection

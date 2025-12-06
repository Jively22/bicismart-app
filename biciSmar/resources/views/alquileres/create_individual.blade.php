@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-green-700 mb-6">Nuevo alquiler individual</h1>

<form action="{{ route('alquileres.store.individual') }}" method="POST"
      class="bg-white rounded shadow p-6 max-w-xl space-y-4">
    @csrf

    <div>
        <label class="font-semibold">Bicicleta</label>
        <select name="bicicleta_id" class="w-full border rounded px-3 py-2" required>
            @foreach($bicicletas as $bici)
                <option value="{{ $bici->id }}">
                    {{ $bici->nombre }} — S/ {{ number_format($bici->precio_alquiler_hora, 2) }} por hora
                </option>
            @endforeach
        </select>
    </div>

    <div class="grid md:grid-cols-2 gap-3">
        <div>
            <label class="font-semibold">Fecha y hora inicio</label>
            <input type="datetime-local" name="fecha_inicio" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="font-semibold">Fecha y hora fin</label>
            <input type="datetime-local" name="fecha_fin" class="w-full border rounded px-3 py-2" required>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-3">
        <div>
            <label class="font-semibold">Entrega o recoger</label>
            <select name="modo_entrega" class="w-full border rounded px-3 py-2">
                <option value="recoger">Prefiero recoger</option>
                <option value="entregar">Entregar a domicilio</option>
            </select>
        </div>
        <div>
            <label class="font-semibold">Dirección (si entrega)</label>
            <input type="text" name="direccion_entrega" class="w-full border rounded px-3 py-2" placeholder="Calle y número">
        </div>
    </div>

    <div>
        <label class="font-semibold block mb-1">Método de pago</label>
        <div class="space-y-2 text-sm">
            <label class="flex items-center space-x-2">
                <input type="radio" name="metodo_pago" value="efectivo" checked>
                <span>Efectivo</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="radio" name="metodo_pago" value="tarjeta">
                <span>Tarjeta</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="radio" name="metodo_pago" value="yape_plin">
                <span>Yape / Plin</span>
            </label>
        </div>
    </div>

    <div class="p-3 bg-gray-50 rounded-lg text-sm text-gray-700">
        El precio se calcula automáticamente al guardar según horas y tarifa por hora de la bicicleta seleccionada.
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">Registrar alquiler</button>
</form>
@endsection

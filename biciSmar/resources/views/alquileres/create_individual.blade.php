@extends('layouts.app')

@section('content')
<div class="max-w-3xl">
    <span class="pill mb-3 inline-flex">Alquiler</span>
    <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Nuevo alquiler individual</h1>
    <p class="text-sm text-gray-600 mb-4">Reserva en minutos con horarios flexibles.</p>

    <form action="{{ route('alquileres.store.individual') }}" method="POST"
          class="surface-card border border-green-50 p-6 space-y-4">
        @csrf

        <div class="form-field">
            <label>Bicicleta</label>
            <select name="bicicleta_id" required>
                @foreach($bicicletas as $bici)
                    <option value="{{ $bici->id }}">
                        {{ $bici->nombre }} · S/ {{ number_format($bici->precio_alquiler_hora, 2) }} por hora
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid md:grid-cols-2 gap-3">
            <div class="form-field">
                <label>Fecha y hora inicio</label>
                <input type="datetime-local" name="fecha_inicio" required>
            </div>

            <div class="form-field">
                <label>Fecha y hora fin</label>
                <input type="datetime-local" name="fecha_fin" required>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-3">
            <div class="form-field">
                <label>Entrega o recoger</label>
                <select name="modo_entrega">
                    <option value="recoger">Prefiero recoger</option>
                    <option value="entregar">Entregar a domicilio</option>
                </select>
            </div>
            <div class="form-field">
                <label>Dirección (si entrega)</label>
                <input type="text" name="direccion_entrega" placeholder="Calle y número">
            </div>
        </div>

        <div class="space-y-2 text-sm">
            <p class="font-semibold text-gray-800">Método de pago</p>
            <label class="flex items-center space-x-2 text-gray-700">
                <input type="radio" name="metodo_pago" value="efectivo" checked>
                <span>Efectivo</span>
            </label>
            <label class="flex items-center space-x-2 text-gray-700">
                <input type="radio" name="metodo_pago" value="tarjeta">
                <span>Tarjeta</span>
            </label>
            <label class="flex items-center space-x-2 text-gray-700">
                <input type="radio" name="metodo_pago" value="yape_plin">
                <span>Yape / Plin</span>
            </label>
        </div>

        <div class="p-3 bg-green-50 border border-green-100 rounded-lg text-sm text-gray-700">
            El precio se calcula automáticamente al guardar según horas y tarifa por hora de la bicicleta seleccionada.
        </div>

        <button class="btn-brand px-5">Registrar alquiler</button>
    </form>
</div>
@endsection

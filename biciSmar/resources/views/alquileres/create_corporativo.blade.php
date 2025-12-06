@extends('layouts.app')

@section('content')
<div class="max-w-3xl">
    <span class="pill mb-3 inline-flex">Alquiler corporativo</span>
    <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Nuevo alquiler para empresa</h1>
    <p class="text-sm text-gray-600 mb-4">Configura fechas, cantidades y entrega para tu equipo.</p>

    <form action="{{ route('alquileres.store.corporativo') }}" method="POST"
          class="surface-card border border-green-50 p-6 space-y-4">
        @csrf

        <div class="form-field">
            <label>Bicicleta</label>
            <select name="bicicleta_id" id="bicicleta_id" required>
                @foreach($bicicletas as $bici)
                    <option value="{{ $bici->id }}">{{ $bici->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid md:grid-cols-2 gap-3">
            <div class="form-field">
                <label>Fecha inicio</label>
                <input type="datetime-local" name="fecha_inicio" id="fecha_inicio" required>
            </div>
            <div class="form-field">
                <label>Fecha fin</label>
                <input type="datetime-local" name="fecha_fin" id="fecha_fin" required>
            </div>
        </div>

        <div class="form-field">
            <label>Cantidad de bicicletas</label>
            <input type="number" name="cantidad" id="cantidad" min="1" value="5" required>
        </div>

        <div class="grid md:grid-cols-2 gap-3">
            <div class="form-field">
                <label>Entrega o recoger</label>
                <select name="modo_entrega">
                    <option value="entregar">Entregar a domicilio</option>
                    <option value="recoger">Recoger en tienda</option>
                </select>
            </div>
            <div class="form-field">
                <label>Dirección (si aplica)</label>
                <input type="text" name="direccion_entrega" placeholder="Calle y número">
            </div>
        </div>

        <div class="form-field">
            <label>Método de pago</label>
            <select name="metodo_pago" required>
                <option value="tarjeta">Tarjeta</option>
                <option value="efectivo">Efectivo</option>
                <option value="yape_plin">Yape / Plin</option>
            </select>
        </div>

        <div class="p-3 bg-green-50 border border-green-100 rounded-lg text-sm text-gray-700" id="resumen-total">
            Total estimado: <span class="font-semibold text-green-800" id="total_estimado">S/ 0.00</span>
            <span class="text-xs text-gray-500 block mt-1">El cálculo se basa en horas, precio/hora de la bicicleta y cantidad.</span>
        </div>

        <button class="btn-brand px-5">Guardar alquiler corporativo</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const selectBici = document.getElementById('bicicleta_id');
        const inputInicio = document.getElementById('fecha_inicio');
        const inputFin = document.getElementById('fecha_fin');
        const inputCantidad = document.getElementById('cantidad');
        const totalSpan = document.getElementById('total_estimado');

        const precios = {
            @foreach($bicicletas as $b)
                {{ $b->id }}: {{ $b->precio_alquiler_hora ?? 0 }},
            @endforeach
        };

        const calcular = () => {
            const biciId = selectBici.value;
            const precioHora = precios[biciId] || 0;
            const cantidad = Math.max(1, parseInt(inputCantidad.value || '1', 10));
            const inicio = new Date(inputInicio.value);
            const fin = new Date(inputFin.value);
            let horas = 0;
            if (inputInicio.value && inputFin.value && fin > inicio) {
                horas = Math.max(1, Math.ceil((fin - inicio) / (1000 * 60 * 60)));
            }
            const total = horas * precioHora * cantidad;
            totalSpan.textContent = `S/ ${total.toFixed(2)}`;
        };

        [selectBici, inputInicio, inputFin, inputCantidad].forEach(el => {
            if (el) el.addEventListener('change', calcular);
        });
        calcular();
    });
</script>
@endsection

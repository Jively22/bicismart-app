@extends('layouts.app')

@section('content')
<div class="mb-4">
    <span class="pill mb-2 inline-flex">Solicitar</span>
    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900">Solicitar mantenimiento</h1>
</div>

@if($errors->any())
    <div class="surface-card border border-red-200 text-red-700 text-sm px-4 py-3 mb-4 space-y-1 max-w-2xl">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="surface-card border border-green-50 p-6 max-w-3xl space-y-4">
    <div class="mb-2">
        <p class="text-xs uppercase text-gray-500">{{ strtoupper($mantenimiento->tipo_servicio) }}</p>
        <h2 class="text-lg font-bold text-gray-900">{{ $mantenimiento->nombre }}</h2>
        <p class="text-sm text-gray-600 mb-1">{{ $mantenimiento->descripcion }}</p>
        <p class="text-sm font-semibold text-green-700">S/ {{ number_format($mantenimiento->precio, 2) }}</p>
    </div>

    <form action="{{ route('mantenimientos.enviar', $mantenimiento) }}" method="POST" class="space-y-4" id="mantenimiento-form">
        @csrf

        @if($user?->tipo_cliente === 'empresa')
            <div class="form-field">
                <label>Selecciona tu flota</label>
                <select name="flota_id" required>
                    @foreach($flotas as $flota)
                        <option value="{{ $flota->id }}">
                            Flota #{{ $flota->id }} - {{ $flota->tipo_evento }} ({{ \Carbon\Carbon::parse($flota->fecha_evento)->format('d/m/Y') }}) · {{ $flota->cantidad_bicicletas }} bicis
                        </option>
                    @endforeach
                </select>
                @if($flotas->isEmpty())
                    <p class="text-xs text-gray-500 mt-1">No tienes flotas registradas aún.</p>
                @endif
            </div>

            <div class="form-field">
                <label>Cantidad de bicicletas a reparar</label>
                <input type="number" name="cantidad" min="1" value="1" required>
            </div>
        @else
            <div class="form-field">
                <label>Selecciona tu bicicleta</label>
                <select name="bicicleta_id" required>
                    @foreach($bicicletasUser as $bici)
                        <option value="{{ $bici->id }}">
                            {{ $bici->nombre }} @if($bici->precio_venta) · Comprada @else · Alquilada @endif
                        </option>
                    @endforeach
                </select>
                @if($bicicletasUser->isEmpty())
                    <p class="text-xs text-gray-500 mt-1">No encontramos bicicletas asociadas. Puedes continuar si deseas dejar una referencia manual en la descripción.</p>
                @endif
            </div>
        @endif

        <div class="form-field">
            <label>Descripción breve del problema</label>
            <textarea name="descripcion" rows="3" placeholder="Freno delantero suelto, ajuste de cambios, etc." required></textarea>
        </div>

        <div class="space-y-2">
            <p class="text-sm font-semibold text-gray-800">Método de pago</p>
            <label class="flex items-center gap-2 text-sm text-gray-700">
                <input type="radio" name="metodo_pago" value="tarjeta" checked>
                <span>Tarjeta</span>
            </label>
            @if($user?->tipo_cliente !== 'empresa')
                <label class="flex items-center gap-2 text-sm text-gray-700">
                    <input type="radio" name="metodo_pago" value="yape_plin">
                    <span>Yape / Plin</span>
                </label>
            @endif
            <label class="flex items-center gap-2 text-sm text-gray-700">
                <input type="radio" name="metodo_pago" value="efectivo">
                <span>Efectivo</span>
            </label>
        </div>

        <div id="card-fields" class="space-y-3">
            <div class="form-field">
                <label>Nombre en la tarjeta</label>
                <input type="text" name="card_nombre" placeholder="Como aparece en la tarjeta">
            </div>
            <div class="form-field">
                <label>Número de tarjeta</label>
                <input type="text" name="card_numero" placeholder="0000 0000 0000 0000">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div class="form-field">
                    <label>Expiración</label>
                    <input type="text" name="card_exp" placeholder="MM/AA">
                </div>
                <div class="form-field">
                    <label>CVV</label>
                    <input type="text" name="card_cvv" placeholder="XXX">
                </div>
            </div>
        </div>

        <button class="btn-brand px-5">Enviar solicitud</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('mantenimiento-form');
        if (!form) return;
        const radios = form.querySelectorAll('input[name="metodo_pago"]');
        const cardFields = document.getElementById('card-fields');

        const toggleCard = () => {
            const method = form.querySelector('input[name="metodo_pago"]:checked')?.value;
            if (method === 'tarjeta') {
                cardFields.classList.remove('hidden');
            } else {
                cardFields.classList.add('hidden');
            }
        };

        radios.forEach(r => r.addEventListener('change', toggleCard));
        toggleCard();
    });
</script>
@endsection

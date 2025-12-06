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
            <select name="bicicleta_id" required>
                @foreach($bicicletas as $bici)
                    <option value="{{ $bici->id }}">{{ $bici->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid md:grid-cols-2 gap-3">
            <div class="form-field">
                <label>Fecha inicio</label>
                <input type="date" name="fecha_inicio" required>
            </div>
            <div class="form-field">
                <label>Fecha fin</label>
                <input type="date" name="fecha_fin" required>
            </div>
        </div>

        <div class="form-field">
            <label>Cantidad de bicicletas</label>
            <input type="number" name="cantidad" min="1" value="5" required>
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

        <div class="p-3 bg-green-50 border border-green-100 rounded-lg text-sm text-gray-700">
            El cálculo total se ajusta según duración y cantidad. Puedes editar luego desde el panel.
        </div>

        <button class="btn-brand px-5">Guardar alquiler corporativo</button>
    </form>
</div>
@endsection

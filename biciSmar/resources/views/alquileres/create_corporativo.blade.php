@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-green-700 mb-6">Nuevo alquiler corporativo</h1>

<form action="{{ route('alquileres.store.corporativo') }}" method="POST"
      class="bg-white rounded shadow p-6 max-w-xl">
    @csrf

    <div class="mb-4">
        <label class="font-semibold">Bicicleta</label>
        <select name="bicicleta_id" class="w-full border rounded px-3 py-2" required>
            @foreach($bicicletas as $bici)
                <option value="{{ $bici->id }}">{{ $bici->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="font-semibold">Fecha inicio</label>
        <input type="date" name="fecha_inicio" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="font-semibold">Fecha fin</label>
        <input type="date" name="fecha_fin" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="font-semibold">Precio total (S/)</label>
        <input type="number" step="0.01" name="precio_total" class="w-full border rounded px-3 py-2" required>
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">Registrar alquiler corporativo</button>
</form>
@endsection

@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-green-700 mb-6">Nuevo alquiler individual</h1>

<form action="{{ route('alquileres.store.individual') }}" method="POST"
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

    <div class="mt-4">
        <label class="font-semibold">Precio total (calculado)</label>
        <input type="text" id="precio_total" class="w-full border rounded p-2 bg-gray-100" disabled>
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">Registrar alquiler</button>
</form>
@endsection

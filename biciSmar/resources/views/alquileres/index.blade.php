@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-green-700 mb-6">Alquileres (admin)</h1>

<table class="w-full bg-white rounded shadow overflow-hidden">
    <thead class="bg-green-700 text-white">
        <tr>
            <th class="px-4 py-2 text-left">ID</th>
            <th class="px-4 py-2 text-left">Usuario</th>
            <th class="px-4 py-2 text-left">Bicicleta</th>
            <th class="px-4 py-2 text-left">Tipo</th>
            <th class="px-4 py-2 text-left">Fechas</th>
            <th class="px-4 py-2 text-left">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($alquileres as $alq)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $alq->id }}</td>
                <td class="px-4 py-2">{{ $alq->usuario->name ?? 'N/A' }}</td>
                <td class="px-4 py-2">{{ $alq->bicicleta->nombre ?? 'N/A' }}</td>
                <td class="px-4 py-2">{{ ucfirst($alq->tipo) }}</td>
                <td class="px-4 py-2">
                    {{ $alq->fecha_inicio }} - {{ $alq->fecha_fin }}
                </td>
                <td class="px-4 py-2">S/ {{ number_format($alq->precio_total, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

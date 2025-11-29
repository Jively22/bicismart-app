@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-green-700 mb-6">Mis alquileres</h1>

@if($user->tipo_cliente === 'individual')
    <p class="mb-4 text-gray-700">Estás viendo tus alquileres individuales.</p>
@elseif($user->tipo_cliente === 'empresa')
    <p class="mb-4 text-gray-700">Estás viendo tus alquileres corporativos.</p>
@endif

<a href="{{ $user->tipo_cliente === 'individual'
            ? route('alquileres.create.individual')
            : route('alquileres.create.corporativo') }}"
   class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">
   + Nuevo alquiler
</a>

<table class="w-full bg-white rounded shadow overflow-hidden">
    <thead class="bg-green-700 text-white">
        <tr>
            <th class="px-4 py-2 text-left">Bicicleta</th>
            <th class="px-4 py-2 text-left">Tipo</th>
            <th class="px-4 py-2 text-left">Fechas</th>
            <th class="px-4 py-2 text-left">Total</th>
        </tr>
    </thead>
    <tbody>
        @forelse($alquileres as $alq)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $alq->bicicleta->nombre ?? 'N/A' }}</td>
                <td class="px-4 py-2">{{ ucfirst($alq->tipo) }}</td>
                <td class="px-4 py-2">{{ $alq->fecha_inicio }} - {{ $alq->fecha_fin }}</td>
                <td class="px-4 py-2">S/ {{ number_format($alq->precio_total, 2) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                    Aún no tienes alquileres registrados.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection

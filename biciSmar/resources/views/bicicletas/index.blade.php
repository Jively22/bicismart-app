@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-green-700 mb-6">Administrar Bicicletas</h1>

<a href="{{ route('bicicletas.create') }}"
   class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">
   + Nueva bicicleta
</a>

<table class="w-full bg-white rounded shadow overflow-hidden">
    <thead class="bg-green-700 text-white">
        <tr>
            <th class="px-4 py-2 text-left">Nombre</th>
            <th class="px-4 py-2 text-left">Tipo</th>
            <th class="px-4 py-2 text-left">Stock</th>
            <th class="px-4 py-2 text-left">Venta</th>
            <th class="px-4 py-2 text-left">Alquiler/hora</th>
            <th class="px-4 py-2 text-left">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bicicletas as $bici)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $bici->nombre }}</td>
                <td class="px-4 py-2">{{ ucfirst($bici->tipo) }}</td>
                <td class="px-4 py-2">{{ $bici->stock }}</td>
                <td class="px-4 py-2">
                    @if($bici->precio_venta)
                        S/ {{ number_format($bici->precio_venta, 2) }}
                    @else
                        -
                    @endif
                </td>
                <td class="px-4 py-2">
                    @if($bici->precio_alquiler_hora)
                        S/ {{ number_format($bici->precio_alquiler_hora, 2) }}
                    @else
                        -
                    @endif
                </td>
                <td class="px-4 py-2 space-x-2">
                    <a href="{{ route('bicicletas.edit', $bici->id) }}" class="text-blue-600">Editar</a>
                    <form action="{{ route('bicicletas.destroy', $bici->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600" onclick="return confirm('¿Eliminar bicicleta?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

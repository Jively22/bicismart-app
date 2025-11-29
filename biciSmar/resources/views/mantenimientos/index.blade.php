@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-green-700 mb-6">Administrar mantenimientos</h1>

<a href="{{ route('mantenimientos.create') }}"
   class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">
   + Nuevo servicio
</a>

<table class="w-full bg-white rounded shadow overflow-hidden">
    <thead class="bg-green-700 text-white">
        <tr>
            <th class="px-4 py-2 text-left">Nombre</th>
            <th class="px-4 py-2 text-left">Tipo</th>
            <th class="px-4 py-2 text-left">Técnico</th>
            <th class="px-4 py-2 text-left">Precio</th>
            <th class="px-4 py-2 text-left">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($mantenimientos as $m)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $m->nombre }}</td>
                <td class="px-4 py-2">{{ ucfirst($m->tipo_servicio) }}</td>
                <td class="px-4 py-2">{{ $m->tecnico }}</td>
                <td class="px-4 py-2">S/ {{ number_format($m->precio, 2) }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('mantenimientos.edit', $m->id) }}" class="text-blue-600">Editar</a>
                    <form action="{{ route('mantenimientos.destroy', $m->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600" onclick="return confirm('¿Eliminar servicio?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

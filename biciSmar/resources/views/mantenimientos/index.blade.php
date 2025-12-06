@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-4">
    <div>
        <span class="pill mb-2 inline-flex">Administrar</span>
        <h1 class="text-3xl font-extrabold text-gray-900">Mantenimientos</h1>
        <p class="text-sm text-gray-600">Servicios internos y externos disponibles.</p>
    </div>
    <a href="{{ route('admin.mantenimientos.create') }}"
       class="btn-brand text-sm px-4">
       + Nuevo servicio
    </a>
    </div>

<div class="table-shell bg-white/90">
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Proveedor</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mantenimientos as $m)
                <tr class="border-b border-green-50">
                    <td class="text-sm font-semibold text-gray-900">{{ $m->nombre }}</td>
                    <td class="text-sm text-gray-700">{{ ucfirst($m->tipo_servicio) }}</td>
                    <td class="text-sm text-gray-700">{{ $m->proveedor ?? 'Interno' }}</td>
                    <td class="text-sm text-gray-700">S/ {{ number_format($m->precio, 2) }}</td>
                    <td class="text-sm text-gray-700 space-x-2">
                        <a href="{{ route('admin.mantenimientos.edit', $m->id) }}" class="text-green-700 font-semibold">Editar</a>
                        <form action="{{ route('admin.mantenimientos.destroy', $m->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 font-semibold" onclick="return confirm('¿Eliminar servicio?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

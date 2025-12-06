@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-4">
    <div>
        <span class="pill mb-2 inline-flex">Administrar</span>
        <h1 class="text-3xl font-extrabold text-gray-900">Bicicletas</h1>
        <p class="text-sm text-gray-600">Gestiona stock, precios y disponibilidad.</p>
    </div>
    <a href="{{ route('admin.bicicletas.create') }}" class="btn-brand text-sm px-4">+ Nueva bicicleta</a>
    </div>

<div class="table-shell bg-white/90">
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Stock</th>
                <th>Venta</th>
                <th>Alquiler/hora</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bicicletas as $bici)
                <tr class="border-b border-green-50">
                    <td class="text-sm font-semibold text-gray-900">{{ $bici->nombre }}</td>
                    <td class="text-sm text-gray-700">{{ ucfirst($bici->tipo) }}</td>
                    <td class="text-sm text-gray-700">{{ $bici->stock }}</td>
                    <td class="text-sm text-gray-700">
                        @if($bici->precio_venta)
                            S/ {{ number_format($bici->precio_venta, 2) }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-sm text-gray-700">
                        @if($bici->precio_alquiler_hora)
                            S/ {{ number_format($bici->precio_alquiler_hora, 2) }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-sm text-gray-700 space-x-2">
                        <a href="{{ route('admin.bicicletas.edit', $bici->id) }}" class="text-green-700 font-semibold">Editar</a>
                        <form action="{{ route('admin.bicicletas.destroy', $bici->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 font-semibold" onclick="return confirm('¿Eliminar bicicleta?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $bicicletas->links() }}
</div>
@endsection

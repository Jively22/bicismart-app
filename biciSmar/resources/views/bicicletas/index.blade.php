@extends('layouts.app')

@section('title','Bicicletas')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="fw-bold text-success">Bicicletas</h1>
        <a href="{{ route('bicicletas.create') }}" class="btn btn-success">Nueva bicicleta</a>
    </div>

    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Precio venta</th>
                <th>Precio alquiler/hora</th>
                <th>Stock</th>
                <th>Estado</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bicicletas as $bici)
                <tr>
                    <td>{{ $bici->nombre }}</td>
                    <td>{{ ucfirst($bici->tipo) }}</td>
                    <td>{{ $bici->precio_venta ? 'S/ '.number_format($bici->precio_venta,2) : '-' }}</td>
                    <td>{{ $bici->precio_alquiler_hora ? 'S/ '.number_format($bici->precio_alquiler_hora,2) : '-' }}</td>
                    <td>{{ $bici->stock }}</td>
                    <td>{{ $bici->estado === 'disponible' ? 'Disponible' : 'No disponible' }}</td>
                    <td class="text-end">
                        <a href="{{ route('bicicletas.edit', $bici) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                        <form action="{{ route('bicicletas.destroy', $bici) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('¿Eliminar bicicleta?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $bicicletas->links() }}
</div>
@endsection

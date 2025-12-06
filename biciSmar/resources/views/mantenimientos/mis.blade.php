@extends('layouts.app')

@section('content')
<div class="mb-4">
    <span class="pill mb-2 inline-flex">Mis servicios</span>
    <h1 class="text-3xl font-extrabold text-gray-900">Mis solicitudes de mantenimiento</h1>
    <p class="text-sm text-gray-600">Revisa el detalle de mantenimientos solicitados.</p>
</div>

<div class="surface-card border border-green-50 p-4">
    <div class="table-shell">
        <table class="text-sm">
            <thead>
                <tr>
                    <th>Servicio</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($servicios as $s)
                    <tr>
                        <td>{{ $s->mantenimiento->nombre ?? 'N/A' }}</td>
                        <td>{{ ucfirst($s->tipo_objetivo) }}</td>
                        <td>{{ ucfirst($s->estado) }}</td>
                        <td>S/ {{ number_format($s->mantenimiento->precio ?? 0, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

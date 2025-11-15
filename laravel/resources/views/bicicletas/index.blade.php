@extends('layouts.dashboard')
@section('page-title', 'Gestión de Bicicletas')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Gestión de Bicicletas</h3>
                    <a href="{{ route('bicicletas.create') }}" class="btn btn-primary">
                        Nueva Bicicleta
                    </a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($bicicletas->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Tipo</th>
                                    <th>Precio Venta</th>
                                    <th>Precio Alquiler/H</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bicicletas as $bicicleta)
                                <tr>
                                    <td>{{ $bicicleta->marca }}</td>
                                    <td>{{ $bicicleta->modelo }}</td>
                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $bicicleta->tipo }}
                                        </span>
                                    </td>
                                    <td>S/ {{ number_format($bicicleta->precio_venta, 2) }}</td>
                                    <td>S/ {{ number_format($bicicleta->precio_alquiler_hora, 2) }}</td>
                                    <td>
                                        <a href="{{ route('bicicletas.show', $bicicleta) }}" class="btn btn-sm btn-info">Ver</a>
                                        <a href="{{ route('bicicletas.edit', $bicicleta) }}" class="btn btn-sm btn-warning">Editar</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <p class="text-muted">No hay bicicletas registradas.</p>
                        <a href="{{ route('bicicletas.create') }}" class="btn btn-primary mt-2">
                            Crear la primera bicicleta
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
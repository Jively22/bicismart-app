@extends('layouts.app')

@section('title','Nuevo alquiler')

@section('content')
<div class="container py-4">
    <h1 class="fw-bold text-success mb-3">Nuevo alquiler</h1>

    <form action="{{ route('alquileres.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Cliente (ID usuario)</label>
                <input type="number" name="user_id" class="form-control" value="{{ old('user_id') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Bicicleta</label>
                <select name="bicicleta_id" class="form-select" required>
                    @foreach($bicicletas as $bici)
                        <option value="{{ $bici->id }}">{{ $bici->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Tipo cliente</label>
                <select name="tipo_cliente" class="form-select">
                    <option value="individual">Individual</option>
                    <option value="empresa">Empresa</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Fecha inicio</label>
                <input type="datetime-local" name="fecha_inicio" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Fecha fin</label>
                <input type="datetime-local" name="fecha_fin" class="form-control" required>
            </div>
            <div class="mt-4">
                <label class="font-semibold">Precio total (calculado)</label>
                <input type="text" id="precio_total" class="w-full border rounded p-2 bg-gray-100" disabled>
            </div>
            <div class="col-md-4">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-select">
                    <option value="pendiente">Pendiente</option>
                    <option value="en_curso">En curso</option>
                    <option value="finalizado">Finalizado</option>
                </select>
            </div>
        </div>

        <div class="mt-4">
            <button class="btn btn-success">Guardar</button>
            <a href="{{ route('alquileres.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection

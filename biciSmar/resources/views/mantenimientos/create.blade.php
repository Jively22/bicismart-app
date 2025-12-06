@extends('layouts.app')

@section('content')
<div class="max-w-2xl">
    <span class="pill mb-3 inline-flex">Nuevo servicio</span>
    <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Crear mantenimiento</h1>

    <form action="{{ route('admin.mantenimientos.store') }}" method="POST" class="surface-card border border-green-50 p-6 space-y-4">
        @csrf

        <div class="form-field">
            <label>Nombre</label>
            <input type="text" name="nombre" required>
        </div>

        <div class="form-field">
            <label>Tipo</label>
            <select name="tipo_servicio" required>
                <option value="preventivo">Preventivo</option>
                <option value="correctivo">Correctivo</option>
            </select>
        </div>

        <div class="form-field">
            <label>Proveedor (opcional)</label>
            <input type="text" name="proveedor">
        </div>

        <div class="form-field">
            <label>Precio</label>
            <input type="number" step="0.01" name="precio" required>
        </div>

        <div class="form-field">
            <label>Descripción</label>
            <textarea name="descripcion" rows="3"></textarea>
        </div>

        <button class="btn-brand px-5">Guardar</button>
    </form>
</div>
@endsection

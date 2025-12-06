@extends('layouts.app')

@section('content')
<div class="max-w-2xl">
    <span class="pill mb-3 inline-flex">Editar servicio</span>
    <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Actualizar mantenimiento</h1>

    <form action="{{ route('admin.mantenimientos.update', $mantenimiento->id) }}" method="POST" class="surface-card border border-green-50 p-6 space-y-4">
        @csrf
        @method('PUT')

        <div class="form-field">
            <label>Nombre</label>
            <input type="text" name="nombre" value="{{ $mantenimiento->nombre }}" required>
        </div>

        <div class="form-field">
            <label>Tipo</label>
            <select name="tipo_servicio" required>
                <option value="preventivo" @if($mantenimiento->tipo_servicio == 'preventivo') selected @endif>Preventivo</option>
                <option value="correctivo" @if($mantenimiento->tipo_servicio == 'correctivo') selected @endif>Correctivo</option>
            </select>
        </div>

        <div class="form-field">
            <label>Proveedor (opcional)</label>
            <input type="text" name="proveedor" value="{{ $mantenimiento->proveedor }}">
        </div>

        <div class="form-field">
            <label>Precio</label>
            <input type="number" step="0.01" name="precio" value="{{ $mantenimiento->precio }}" required>
        </div>

        <div class="form-field">
            <label>Descripción</label>
            <textarea name="descripcion" rows="3">{{ $mantenimiento->descripcion }}</textarea>
        </div>

        <button class="btn-brand px-5">Actualizar</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <span class="pill mb-3 inline-flex">Alquiler corporativo</span>
    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900">Solicitud de alquiler corporativo</h1>
    <p class="text-sm text-gray-600 mb-4">
        Completa los datos de tu empresa y del evento. Nuestro equipo revisará tu solicitud y se pondrá en contacto.
    </p>

    @if (session('success'))
        <div class="surface-card border border-green-100 px-4 py-3 text-green-800 mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="surface-card border border-red-200 px-4 py-3 text-red-700 text-sm mb-4">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="surface-card border border-green-50 p-6 md:p-8 space-y-6">
        <form action="{{ route('corporativo.store') }}" method="POST" class="space-y-6">
            @csrf

            <section class="space-y-4">
                <div class="flex items-center gap-2">
                    <span class="badge-soft">1</span>
                    <h2 class="text-lg font-semibold text-gray-900">Información de la empresa</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-field">
                        <label>Razón social <span class="text-red-500">*</span></label>
                        <input type="text" name="razon_social" value="{{ old('razon_social', $user->nombre_empresa ?? '') }}" required>
                    </div>
                    <div class="form-field">
                        <label>RUC <span class="text-red-500">*</span></label>
                        <input type="text" name="ruc" value="{{ old('ruc', $user->ruc ?? '') }}" required>
                    </div>
                </div>
            </section>

            <section class="space-y-4">
                <div class="flex items-center gap-2">
                    <span class="badge-soft">2</span>
                    <h2 class="text-lg font-semibold text-gray-900">Persona de contacto</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-field">
                        <label>Nombre completo <span class="text-red-500">*</span></label>
                        <input type="text" name="contacto_nombre" value="{{ old('contacto_nombre', $user->name ?? '') }}" required>
                    </div>
                    <div class="form-field">
                        <label>Email <span class="text-red-500">*</span></label>
                        <input type="email" name="contacto_email" value="{{ old('contacto_email', $user->email ?? '') }}" required>
                    </div>
                    <div class="form-field">
                        <label>Teléfono <span class="text-red-500">*</span></label>
                        <input type="text" name="contacto_telefono" value="{{ old('contacto_telefono') }}" required>
                    </div>
                </div>
            </section>

            <section class="space-y-4">
                <div class="flex items-center gap-2">
                    <span class="badge-soft">3</span>
                    <h2 class="text-lg font-semibold text-gray-900">Detalles del evento</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-field">
                        <label>Tipo de evento <span class="text-red-500">*</span></label>
                        <select name="tipo_evento" required>
                            <option value="">Seleccionar tipo</option>
                            <option value="Evento corporativo" @selected(old('tipo_evento') === 'Evento corporativo')>Evento corporativo</option>
                            <option value="Team building" @selected(old('tipo_evento') === 'Team building')>Team building</option>
                            <option value="Activación de marca" @selected(old('tipo_evento') === 'Activación de marca')>Activación de marca</option>
                            <option value="Turismo corporativo" @selected(old('tipo_evento') === 'Turismo corporativo')>Turismo corporativo</option>
                            <option value="Otro" @selected(old('tipo_evento') === 'Otro')>Otro</option>
                        </select>
                    </div>
                    <div class="form-field">
                        <label>Fecha del evento <span class="text-red-500">*</span></label>
                        <input type="date" name="fecha_evento" value="{{ old('fecha_evento') }}" required>
                    </div>
                    <div class="form-field">
                        <label>Duración (horas) <span class="text-red-500">*</span></label>
                        <input type="number" min="1" name="duracion_horas" value="{{ old('duracion_horas', 4) }}" required>
                    </div>
                    <div class="form-field">
                        <label>Cantidad de bicicletas <span class="text-red-500">*</span></label>
                        <input type="number" min="1" name="cantidad_bicicletas" value="{{ old('cantidad_bicicletas', 10) }}" required>
                    </div>
                </div>

                <div class="form-field">
                    <label>Ubicación del evento <span class="text-red-500">*</span></label>
                    <textarea name="ubicacion_evento" rows="2" placeholder="Dirección exacta del evento..." required>{{ old('ubicacion_evento') }}</textarea>
                </div>

                <div class="form-field">
                    <label>Observaciones adicionales</label>
                    <textarea name="observaciones" rows="3" placeholder="Requerimientos especiales, horarios específicos, etc.">{{ old('observaciones') }}</textarea>
                </div>
            </section>

            <section class="border-t border-green-100 pt-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="text-sm text-gray-600">
                    <p class="font-semibold text-gray-800">Tarifas corporativas de referencia</p>
                    <p>• S/ 35 por bicicleta</p>
                    <p>• S/ 10 por hora de evento</p>
                    <p class="mt-1 text-xs text-gray-500">El precio final se calculará automáticamente y será confirmado por nuestro equipo.</p>
                </div>
                <button type="submit" class="btn-brand px-6">
                    Enviar solicitud
                </button>
            </section>
        </form>
    </div>
</div>
@endsection

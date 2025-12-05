@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-emerald-100 py-10">
    <div class="max-w-5xl mx-auto px-4">
        <div class="mb-6">
            <p class="text-sm font-semibold text-emerald-700 uppercase tracking-wider">Alquiler Corporativo</p>
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-1">
                Solicitud de Alquiler Corporativo
            </h1>
            <p class="mt-2 text-gray-600 max-w-2xl">
                Completa los datos de tu empresa y del evento. Nuestro equipo revisará tu solicitud y se pondrá en contacto contigo.
            </p>
        </div>

        @if (session('success'))
            <div class="mb-4 rounded-lg bg-emerald-100 border border-emerald-300 px-4 py-3 text-emerald-800">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-red-700 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white/90 backdrop-blur shadow-xl rounded-2xl border border-emerald-50 overflow-hidden">
            <form action="{{ route('corporativo.store') }}" method="POST" class="p-6 md:p-8 space-y-8">
                @csrf

                {{-- Información de la Empresa --}}
                <section>
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 text-sm font-bold">1</span>
                        Información de la Empresa
                    </h2>
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Razón Social <span class="text-red-500">*</span></label>
                            <input type="text" name="razon_social" value="{{ old('razon_social', $user->nombre_empresa ?? '') }}"
                                   class="w-full rounded-lg border-gray-300 focus:ring-emerald-500 focus:border-emerald-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">RUC <span class="text-red-500">*</span></label>
                            <input type="text" name="ruc" value="{{ old('ruc', $user->ruc ?? '') }}"
                                   class="w-full rounded-lg border-gray-300 focus:ring-emerald-500 focus:border-emerald-500" required>
                        </div>
                    </div>
                </section>

                {{-- Persona de contacto --}}
                <section>
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 text-sm font-bold">2</span>
                        Persona de Contacto
                    </h2>
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre Completo <span class="text-red-500">*</span></label>
                            <input type="text" name="contacto_nombre" value="{{ old('contacto_nombre', $user->name ?? '') }}"
                                   class="w-full rounded-lg border-gray-300 focus:ring-emerald-500 focus:border-emerald-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="contacto_email" value="{{ old('contacto_email', $user->email ?? '') }}"
                                   class="w-full rounded-lg border-gray-300 focus:ring-emerald-500 focus:border-emerald-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono <span class="text-red-500">*</span></label>
                            <input type="text" name="contacto_telefono" value="{{ old('contacto_telefono') }}"
                                   class="w-full rounded-lg border-gray-300 focus:ring-emerald-500 focus:border-emerald-500" required>
                        </div>
                    </div>
                </section>

                {{-- Detalles del evento --}}
                <section>
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 text-sm font-bold">3</span>
                        Detalles del Evento
                    </h2>
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Evento <span class="text-red-500">*</span></label>
                            <select name="tipo_evento"
                                    class="w-full rounded-lg border-gray-300 focus:ring-emerald-500 focus:border-emerald-500" required>
                                <option value="">Seleccionar tipo</option>
                                <option value="Evento corporativo" @selected(old('tipo_evento') === 'Evento corporativo')>Evento corporativo</option>
                                <option value="Team building" @selected(old('tipo_evento') === 'Team building')>Team building</option>
                                <option value="Activación de marca" @selected(old('tipo_evento') === 'Activación de marca')>Activación de marca</option>
                                <option value="Turismo corporativo" @selected(old('tipo_evento') === 'Turismo corporativo')>Turismo corporativo</option>
                                <option value="Otro" @selected(old('tipo_evento') === 'Otro')>Otro</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Fecha del Evento <span class="text-red-500">*</span></label>
                            <input type="date" name="fecha_evento" value="{{ old('fecha_evento') }}"
                                   class="w-full rounded-lg border-gray-300 focus:ring-emerald-500 focus:border-emerald-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Duración (horas) <span class="text-red-500">*</span></label>
                            <input type="number" min="1" name="duracion_horas" value="{{ old('duracion_horas', 4) }}"
                                   class="w-full rounded-lg border-gray-300 focus:ring-emerald-500 focus:border-emerald-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Cantidad de bicicletas <span class="text-red-500">*</span></label>
                            <input type="number" min="1" name="cantidad_bicicletas" value="{{ old('cantidad_bicicletas', 10) }}"
                                   class="w-full rounded-lg border-gray-300 focus:ring-emerald-500 focus:border-emerald-500" required>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ubicación del Evento <span class="text-red-500">*</span></label>
                        <textarea name="ubicacion_evento" rows="2"
                                  class="w-full rounded-lg border-gray-300 focus:ring-emerald-500 focus:border-emerald-500"
                                  placeholder="Dirección exacta del evento..." required>{{ old('ubicacion_evento') }}</textarea>
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Observaciones Adicionales</label>
                        <textarea name="observaciones" rows="3"
                                  class="w-full rounded-lg border-gray-300 focus:ring-emerald-500 focus:border-emerald-500"
                                  placeholder="Requerimientos especiales, horarios específicos, etc.">{{ old('observaciones') }}</textarea>
                    </div>
                </section>

                {{-- Resumen --}}
                <section class="border-t border-emerald-50 pt-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="text-sm text-gray-600">
                        <p class="font-semibold text-gray-800">Tarifas corporativas de referencia</p>
                        <p>• S/ 35 por bicicleta</p>
                        <p>• S/ 10 por hora de evento</p>
                        <p class="mt-1 text-xs text-gray-500">El precio final se calculará automáticamente y será confirmado por nuestro equipo.</p>
                    </div>
                    <button type="submit"
                            class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-emerald-600 text-white font-semibold shadow-lg shadow-emerald-300 hover:bg-emerald-700 transition">
                        <span class="mr-2">Enviar solicitud</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </button>
                </section>
            </form>
        </div>
    </div>
</div>
@endsection

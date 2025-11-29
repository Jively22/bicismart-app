@extends('layouts.app')

@section('content')
<div class="grid lg:grid-cols-[3fr,2fr] gap-10 items-center">
    <div>
        <p class="uppercase text-xs tracking-[0.25em] text-green-700 mb-3">
            MOVILIDAD SOSTENIBLE
        </p>
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight mb-4">
            Bicicletas para tu <span class="text-green-700">día a día</span>,<br>
            tu empresa y tu ciudad.
        </h1>
        <p class="text-gray-700 text-sm md:text-base mb-6 max-w-xl">
            BiciSmart te ofrece venta, alquiler individual y corporativo, y servicios de mantenimiento
            con técnicos internos y externos. Todo desde una plataforma simple, moderna y pensada
            para que solo te preocupes por pedalear.
        </p>

        <div class="flex flex-wrap items-center gap-3 mb-6">
            <a href="{{ route('bicicletas.catalogo') }}"
               class="inline-flex items-center px-6 py-2.5 rounded-full bg-green-700 text-white text-sm font-semibold shadow-lg shadow-green-700/30 hover:bg-green-800 transition">
                Ver catálogo de bicicletas
            </a>

            <a href="{{ route('mantenimientos.public') }}"
               class="inline-flex items-center px-4 py-2.5 rounded-full border border-green-700 text-green-800 text-sm font-semibold hover:bg-white hover:shadow-md transition">
                Servicios de mantenimiento
            </a>
        </div>

        <div class="flex flex-wrap gap-6 text-xs md:text-sm text-gray-700">
            <div class="flex items-center space-x-2">
                <span class="w-6 h-6 rounded-full bg-green-100 text-green-700 flex items-center justify-center text-xs">✓</span>
                <span>Alquiler por hora, día o mes</span>
            </div>
            <div class="flex items-center space-x-2">
                <span class="w-6 h-6 rounded-full bg-green-100 text-green-700 flex items-center justify-center text-xs">✓</span>
                <span>Planes corporativos para empresas</span>
            </div>
            <div class="flex items-center space-x-2">
                <span class="w-6 h-6 rounded-full bg-green-100 text-green-700 flex items-center justify-center text-xs">✓</span>
                <span>Mantenimiento con técnicos aliados</span>
            </div>
        </div>
    </div>

    <div class="relative">
        <div class="rounded-3xl bg-white/80 backdrop-blur shadow-2xl border border-green-100 p-6 md:p-7">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-semibold text-gray-900">Bicicleta destacada</h2>
                <span class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-[11px] font-semibold uppercase tracking-wide">
                    Recomendado
                </span>
            </div>

            <div class="flex flex-col gap-4">
                <div class="w-full h-40 rounded-2xl bg-gradient-to-r from-green-600 via-emerald-500 to-lime-400 flex items-center justify-center text-white text-sm font-semibold shadow-inner">
                    Vista previa de bicicleta
                </div>

                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Bici urbana</p>
                    <p class="text-lg font-bold text-gray-900 mb-1">EcoRide Ciudad 3.0</p>
                    <p class="text-xs text-gray-600 mb-2">
                        Ideal para desplazarte por la ciudad con ligereza, seguridad y cero emisiones.
                    </p>
                    <p class="text-sm font-semibold text-green-700">
                        Desde <span class="text-xl">S/ 8.50</span> / hora · <span class="text-gray-600 text-xs">también disponible para venta</span>
                    </p>
                </div>

                <div class="grid grid-cols-3 gap-3 text-[11px] text-gray-600">
                    <div class="rounded-2xl bg-green-50 px-3 py-2">
                        <p class="font-semibold text-green-800">Individual</p>
                        <p>Reserva online en minutos.</p>
                    </div>
                    <div class="rounded-2xl bg-blue-50 px-3 py-2">
                        <p class="font-semibold text-blue-800">Corporativo</p>
                        <p>Flotas para empresas.</p>
                    </div>
                    <div class="rounded-2xl bg-yellow-50 px-3 py-2">
                        <p class="font-semibold text-yellow-800">Mantenimiento</p>
                        <p>Checklist completo incluido.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

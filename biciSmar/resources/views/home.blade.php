@extends('layouts.app')

@section('content')
<div class="grid md:grid-cols-2 gap-10 items-center">
    <div>
        <h1 class="text-4xl md:text-5xl font-extrabold text-green-700 mb-4">
            Movilidad sostenible con BiciSmart
        </h1>
        <p class="text-gray-700 mb-6">
            Venta, alquiler individual y corporativo, y servicios de mantenimiento para que tu bicicleta
            siempre esté lista para rodar.
        </p>
        <div class="space-x-4">
            <a href="{{ route('bicicletas.catalogo') }}"
               class="bg-green-600 text-white px-6 py-3 rounded-lg shadow">
               Ver bicicletas
            </a>
            <a href="{{ route('mantenimientos.public') }}"
               class="border border-green-600 text-green-700 px-6 py-3 rounded-lg">
               Ver mantenimientos
            </a>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-2xl font-bold text-green-700 mb-4">Servicios que ofrecemos</h2>
        <ul class="space-y-2 text-gray-700">
            <li>✔ Venta de bicicletas urbanas, de ruta y eléctricas</li>
            <li>✔ Alquiler por hora, día o meses</li>
            <li>✔ Planes corporativos para empresas</li>
            <li>✔ Mantenimiento interno y con técnicos externos</li>
        </ul>
    </div>
</div>
@endsection

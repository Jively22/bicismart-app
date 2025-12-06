@extends('layouts.app')

@section('content')
<div class="grid lg:grid-cols-[1.2fr,1fr] gap-8 items-center">
    <div class="space-y-5">
        <span class="pill">Movilidad sostenible</span>
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
            Bicicletas para tu <span class="text-green-700">día a día</span>, tu empresa y tu ciudad.
        </h1>
        <p class="text-gray-700 text-base max-w-2xl">
            Venta, alquiler individual y corporativo, más un equipo de mantenimiento listo para mantener cada pedalazo
            en perfectas condiciones. Todo en una sola app, con un look fresco y enfocado en la experiencia.
        </p>

        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('bicicletas.catalogo') }}" class="btn-brand text-sm px-5">
                Ver catálogo de bicicletas
            </a>
            <a href="{{ route('mantenimientos.public') }}" class="btn-ghost text-sm px-5">
                Servicios de mantenimiento
            </a>
        </div>

        <div class="grid sm:grid-cols-3 gap-3 text-sm">
            <div class="surface-card px-4 py-3 border border-green-50">
                <p class="text-xs font-semibold text-green-700 uppercase">Alquiler flexible</p>
                <p class="text-gray-700">Hora, día o mes con entrega o recojo.</p>
            </div>
            <div class="surface-card px-4 py-3 border border-green-50">
                <p class="text-xs font-semibold text-green-700 uppercase">Planes corporativos</p>
                <p class="text-gray-700">Flotas con soporte para eventos y empresas.</p>
            </div>
            <div class="surface-card px-4 py-3 border border-green-50">
                <p class="text-xs font-semibold text-green-700 uppercase">Mantenimiento pro</p>
                <p class="text-gray-700">Técnicos aliados con checklist completo.</p>
            </div>
        </div>
    </div>

</div>

@if($bicicletasTop->count())
<div class="mt-12 space-y-4">
    <div class="flex items-center justify-between">
        <div>
            <span class="pill mb-2 inline-flex">Top 4 del mes</span>
            <h2 class="text-2xl font-extrabold text-gray-900">Bicicletas destacadas</h2>
        </div>
        <div class="flex gap-2">
            <button id="top-bikes-prev" class="btn-ghost text-sm px-3">◀</button>
            <button id="top-bikes-next" class="btn-ghost text-sm px-3">▶</button>
        </div>
    </div>

    <div class="relative overflow-hidden surface-card border border-green-50">
        <div id="top-bikes-track" class="flex transition-all duration-300" style="transform: translateX(0);">
            @foreach($bicicletasTop as $bici)
                <div class="min-w-full shrink-0 p-5 grid md:grid-cols-[1.2fr,1fr] gap-4 items-center">
                    <div class="space-y-2">
                        <p class="text-xs uppercase text-gray-500">{{ ucfirst($bici->tipo) }}</p>
                        <h3 class="text-xl font-bold text-gray-900">{{ $bici->nombre }}</h3>
                        <p class="text-sm text-gray-700 line-clamp-3">{{ $bici->descripcion }}</p>
                        <div class="flex items-center gap-4 text-sm">
                            @if($bici->precio_venta)
                                <span class="font-semibold text-green-700">Venta: S/ {{ number_format($bici->precio_venta, 2) }}</span>
                            @endif
                            @if($bici->precio_alquiler_hora)
                                <span class="text-gray-600">Alquiler: S/ {{ number_format($bici->precio_alquiler_hora, 2) }}/h</span>
                            @endif
                        </div>
                        <div class="flex gap-3">
                            <a href="{{ route('bicicletas.show.public', $bici->id) }}" class="btn-ghost text-sm px-4">Ver detalles</a>
                            @if($bici->precio_venta)
                                <form action="{{ route('cart.add', $bici->id) }}" method="POST">
                                    @csrf
                                    <button class="btn-brand text-sm px-4">Añadir al carrito</button>
                                </form>
                            @endif
                        </div>
                    </div>
                    <div class="relative w-full h-52 rounded-2xl bg-gradient-to-r from-green-600 via-emerald-500 to-lime-400 overflow-hidden">
                        @if($bici->foto)
                            <img src="{{ asset('storage/'.$bici->foto) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-white font-semibold">Sin imagen</div>
                        @endif
                        <div class="absolute top-3 right-3 badge-soft">Top</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const track = document.getElementById('top-bikes-track');
        if (!track) return;
        const slides = track.querySelectorAll('.min-w-full');
        const total = slides.length;
        let index = 0;

        const update = () => {
            track.style.transform = `translateX(-${index * 100}%)`;
        };

        document.getElementById('top-bikes-prev')?.addEventListener('click', () => {
            index = (index - 1 + total) % total;
            update();
        });
        document.getElementById('top-bikes-next')?.addEventListener('click', () => {
            index = (index + 1) % total;
            update();
        });

        setInterval(() => {
            index = (index + 1) % total;
            update();
        }, 5000);
    });
</script>
@endif

@if($bicicletasMini->count())
<div class="mt-12 space-y-3">
    <div class="flex items-center justify-between">
        <div>
            <span class="pill mb-2 inline-flex">Catálogo rápido</span>
            <h2 class="text-2xl font-extrabold text-gray-900">Explora nuestras bicis</h2>
            <p class="text-sm text-gray-600">Una selección de 6 modelos listos para ti.</p>
        </div>
        <a href="{{ route('bicicletas.catalogo') }}" class="btn-ghost text-sm px-4">Explorar más</a>
    </div>

    <div class="grid md:grid-cols-3 gap-4">
        @foreach($bicicletasMini as $bici)
            <div class="surface-card border border-green-50 p-4 flex flex-col gap-2">
                <div class="relative w-full h-36 rounded-xl bg-gradient-to-r from-green-600 via-emerald-500 to-lime-400 overflow-hidden">
                    @if($bici->foto)
                        <img src="{{ asset('storage/'.$bici->foto) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-white text-sm">Sin imagen</div>
                    @endif
                    <span class="absolute top-2 left-2 badge-soft uppercase text-[11px]">{{ ucfirst($bici->tipo) }}</span>
                </div>
                <h3 class="font-bold text-base text-gray-900">{{ $bici->nombre }}</h3>
                <p class="text-xs text-gray-600 line-clamp-2">{{ $bici->descripcion }}</p>
                <div class="flex items-center justify-between text-sm">
                    @if($bici->precio_venta)
                        <span class="font-semibold text-green-700">S/ {{ number_format($bici->precio_venta, 2) }}</span>
                    @else
                        <span class="text-gray-500">Solo alquiler</span>
                    @endif
                    @if($bici->precio_alquiler_hora)
                        <span class="text-gray-500 text-xs">Alquiler: S/ {{ number_format($bici->precio_alquiler_hora, 2) }}/h</span>
                    @endif
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('bicicletas.show.public', $bici->id) }}" class="btn-ghost text-xs px-3 flex-1 justify-center">Detalles</a>
                    @if($bici->precio_venta)
                        <form action="{{ route('cart.add', $bici->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button class="btn-brand text-xs px-3 w-full justify-center">Añadir</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif
@endsection

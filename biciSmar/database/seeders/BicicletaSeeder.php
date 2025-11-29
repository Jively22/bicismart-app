<?php

namespace Database\Seeders;

use App\Models\Bicicleta;
use Illuminate\Database\Seeder;

class BicicletaSeeder extends Seeder
{
    public function run(): void
    {
        Bicicleta::query()->delete();

        Bicicleta::create([
            'nombre' => 'EcoRide Ciudad 3.0',
            'tipo' => 'mixta',
            'descripcion' => 'Bicicleta urbana ligera con cambios de 7 velocidades y frenos de disco.',
            'precio_venta' => 1200,
            'precio_alquiler_hora' => 8.5,
            'stock' => 10,
            'estado' => 'disponible',
        ]);

        Bicicleta::create([
            'nombre' => 'TrailX Montaña Pro',
            'tipo' => 'mixta',
            'descripcion' => 'Bicicleta de montaña con suspensión delantera y llantas todo terreno.',
            'precio_venta' => 1850,
            'precio_alquiler_hora' => 12,
            'stock' => 6,
            'estado' => 'disponible',
        ]);

        Bicicleta::create([
            'nombre' => 'Urban E-Move Eléctrica',
            'tipo' => 'mixta',
            'descripcion' => 'Bicicleta eléctrica ideal para trayectos urbanos largos con asistencia al pedaleo.',
            'precio_venta' => 3200,
            'precio_alquiler_hora' => 18,
            'stock' => 4,
            'estado' => 'disponible',
        ]);
    }
}

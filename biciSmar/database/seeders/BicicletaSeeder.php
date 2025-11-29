<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bicicleta;

class BicicletaSeeder extends Seeder
{
    public function run(): void
    {
        Bicicleta::create([
            'nombre' => 'Bici Urbana EcoRide',
            'tipo' => 'mixto',
            'precio_venta' => 950.00,
            'precio_alquiler_hora' => 8.50,
            'stock' => 10,
            'descripcion' => 'Bicicleta urbana ligera, ideal para la ciudad.',
            'estado' => 'disponible',
            'foto' => 'images/bicicletas/bici_urbana.jpg',
        ]);

        Bicicleta::create([
            'nombre' => 'Montañera ProTrail 3000',
            'tipo' => 'venta',
            'precio_venta' => 1490.00,
            'precio_alquiler_hora' => null,
            'stock' => 7,
            'descripcion' => 'Perfecta para rutas de montaña y terrenos difíciles.',
            'estado' => 'disponible',
            'foto' => 'images/bicicletas/montanera_protrail.jpg',
        ]);

        Bicicleta::create([
            'nombre' => 'Ruta SpeedMaster X',
            'tipo' => 'venta',
            'precio_venta' => 2100.00,
            'precio_alquiler_hora' => null,
            'stock' => 4,
            'descripcion' => 'Bicicleta de ruta aerodinámica para alta velocidad.',
            'estado' => 'disponible',
            'foto' => 'images/bicicletas/ruta_speedmaster.jpg',
        ]);

        Bicicleta::create([
            'nombre' => 'Bici Corporativa UrbanFleet',
            'tipo' => 'alquiler',
            'precio_venta' => null,
            'precio_alquiler_hora' => 12.00,
            'stock' => 20,
            'descripcion' => 'Modelo recomendado para alquiler corporativo y movilidad laboral.',
            'estado' => 'disponible',
            'foto' => 'images/bicicletas/corporativa_urbanfleet.jpg',
        ]);

        Bicicleta::create([
            'nombre' => 'Bici Eléctrica PowerRide E1',
            'tipo' => 'mixto',
            'precio_venta' => 3200.00,
            'precio_alquiler_hora' => 18.00,
            'stock' => 5,
            'descripcion' => 'Bicicleta eléctrica con excelente autonomía.',
            'estado' => 'disponible',
            'foto' => 'images/bicicletas/electrica_powerride.jpg',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Accesory;

class AccesorySeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'nombre' => 'Casco urbano ligero',
                'categoria' => 'merch',
                'tag' => 'oficial',
                'precio' => 120,
                'stock' => 25,
                'descripcion' => 'Casco ventilado con certificación y visor desmontable.',
                'estado' => 'disponible',
            ],
            [
                'nombre' => 'Kit de luces LED USB',
                'categoria' => 'repuesto',
                'tag' => 'oficial',
                'precio' => 85,
                'stock' => 40,
                'descripcion' => 'Luz delantera y trasera recargable, modos fijo y flash.',
                'estado' => 'disponible',
            ],
            [
                'nombre' => 'Multiherramienta 12 en 1',
                'categoria' => 'parte',
                'tag' => 'oficial',
                'precio' => 65,
                'stock' => 50,
                'descripcion' => 'Incluye llaves Allen, destornilladores y tronchacadenas.',
                'estado' => 'disponible',
            ],
            [
                'nombre' => 'Cámara 29 anti pinchazo',
                'categoria' => 'repuesto',
                'tag' => 'asociado',
                'precio' => 35,
                'stock' => 60,
                'descripcion' => 'Cámara reforzada con sellador líquido integrado.',
                'estado' => 'disponible',
            ],
            [
                'nombre' => 'Guantes gel pro',
                'categoria' => 'merch',
                'tag' => 'asociado',
                'precio' => 55,
                'stock' => 30,
                'descripcion' => 'Guantes cortos con almohadillas de gel y ventilación.',
                'estado' => 'disponible',
            ],
        ];

        foreach ($items as $item) {
            Accesory::firstOrCreate(
                ['nombre' => $item['nombre']],
                $item
            );
        }
    }
}

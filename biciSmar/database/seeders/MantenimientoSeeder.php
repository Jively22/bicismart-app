<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mantenimiento;

class MantenimientoSeeder extends Seeder
{
    public function run(): void
    {
        $servicios = [
            [
                'nombre' => 'Ajuste completo y alineación',
                'descripcion' => 'Revisión de frenos, transmisión, alineación de ruedas y apriete general.',
                'precio' => 85,
                'tipo_servicio' => 'preventivo',
                'proveedor' => null, // técnico oficial
            ],
            [
                'nombre' => 'Servicio de transmisión y cassette',
                'descripcion' => 'Limpieza profunda, ajuste de cambios y reemplazo de cadena o cassette si es necesario.',
                'precio' => 140,
                'tipo_servicio' => 'correctivo',
                'proveedor' => null,
            ],
            [
                'nombre' => 'Set de seguridad urbana',
                'descripcion' => 'Instalación de luces, timbre y revisión de puntos de seguridad para ciudad.',
                'precio' => 95,
                'tipo_servicio' => 'preventivo',
                'proveedor' => null,
            ],
            [
                'nombre' => 'Ajuste básico domicilio',
                'descripcion' => 'Calibración ligera de frenos y cambios en tu ubicación.',
                'precio' => 60,
                'tipo_servicio' => 'preventivo',
                'proveedor' => 'Asociado RideFix',
            ],
            [
                'nombre' => 'Cambio de cámara y llanta',
                'descripcion' => 'Reemplazo de cámara o llanta pinchada, incluye revisión de presión.',
                'precio' => 70,
                'tipo_servicio' => 'correctivo',
                'proveedor' => 'Taller Rueda Libre',
            ],
            [
                'nombre' => 'Detailing y limpieza pro',
                'descripcion' => 'Lavado profundo, desengrase y lubricación premium para mantener tu bici impecable.',
                'precio' => 90,
                'tipo_servicio' => 'preventivo',
                'proveedor' => 'CleanBike Studio',
            ],
        ];

        foreach ($servicios as $servicio) {
            Mantenimiento::firstOrCreate(
                ['nombre' => $servicio['nombre']],
                $servicio
            );
        }
    }
}

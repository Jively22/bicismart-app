<?php

namespace Database\Seeders;

use App\Models\Mantenimiento;
use Illuminate\Database\Seeder;

class MantenimientoSeeder extends Seeder
{
    public function run(): void
    {
        Mantenimiento::query()->delete();

        Mantenimiento::create([
            'nombre' => 'Ajuste general',
            'descripcion' => 'Incluye ajuste de frenos, cambios, tornillería y revisión de seguridad.',
            'precio' => 45,
            'tipo_servicio' => 'interno',
            'proveedor' => 'Taller BiciSmart',
        ]);

        Mantenimiento::create([
            'nombre' => 'Servicio de frenos premium',
            'descripcion' => 'Cambio de zapatas/pads, alineado de discos y purga de frenos hidráulicos.',
            'precio' => 70,
            'tipo_servicio' => 'interno',
            'proveedor' => 'Taller BiciSmart',
        ]);

        Mantenimiento::create([
            'nombre' => 'Mantenimiento total corporativo',
            'descripcion' => 'Servicio completo para flotas, con recogida y entrega en la empresa.',
            'precio' => 220,
            'tipo_servicio' => 'externo',
            'proveedor' => 'BikePartners SAC',
        ]);

        Mantenimiento::create([
            'nombre' => 'Ajuste básico a domicilio',
            'descripcion' => 'Ajuste rápido de frenos y cambios, realizado por técnico aliado externo.',
            'precio' => 35,
            'tipo_servicio' => 'externo',
            'proveedor' => 'Aliado externo certificado',
        ]);
    }
}

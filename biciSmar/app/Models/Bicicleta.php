<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bicicleta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'tipo',
        'precio_venta',
        'precio_alquiler_hora',
        'stock',
        'descripcion',
        'imagen',
        'estado',
    ];

    public function alquileres()
    {
        return $this->hasMany(Alquiler::class);
    }

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class);
    }
}

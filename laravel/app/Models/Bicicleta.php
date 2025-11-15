<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bicicleta extends Model
{
    use HasFactory;

    protected $table = 'bicicletas';

    protected $fillable = [
        'marca',
        'modelo',
        'tipo',
        'tamaño',
        'estado',
        'precio_venta',
        'precio_alquiler_hora',
        'precio_alquiler_dia',
        'imagen',
        'descripcion',
        'disponible_para_venta',
        'disponible_para_alquiler'
    ];

    public function alquileres()
    {
        return $this->hasMany(Alquiler::class, 'bicicleta_id');
    }
}
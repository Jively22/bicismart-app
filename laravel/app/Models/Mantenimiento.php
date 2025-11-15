<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'bicicleta_id',
        'tipo',
        'descripcion',
        'fecha_inicio',
        'fecha_fin_prevista',
        'fecha_fin',
        'costo_estimado',
        'estado',
        'tecnico_responsable',
        'observaciones'
    ];

    public function bicicleta()
    {
        return $this->belongsTo(Bicicleta::class);
    }
}
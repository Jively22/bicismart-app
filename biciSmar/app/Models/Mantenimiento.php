<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bicicleta_id',
        'tipo_servicio',
        'descripcion',
        'fecha_programada',
        'estado',
    ];

    public function bicicleta()
    {
        return $this->belongsTo(Bicicleta::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

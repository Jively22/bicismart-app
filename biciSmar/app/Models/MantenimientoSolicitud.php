<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MantenimientoSolicitud extends Model
{
    use HasFactory;

    protected $table = 'mantenimiento_solicitudes';

    protected $fillable = [
        'user_id',
        'mantenimiento_id',
        'tipo_objetivo',       // bicicleta o flota
        'nombre_objetivo',
        'cantidad',
        'notas',
    ];

    public function mantenimiento()
    {
        return $this->belongsTo(Mantenimiento::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

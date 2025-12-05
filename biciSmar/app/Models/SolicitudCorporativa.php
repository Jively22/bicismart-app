<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudCorporativa extends Model
{
    use HasFactory;

    protected $table = 'solicitudes_corporativas';

    protected $fillable = [
        'user_id',
        'razon_social',
        'ruc',
        'contacto_nombre',
        'contacto_email',
        'contacto_telefono',
        'tipo_evento',
        'fecha_evento',
        'duracion_horas',
        'cantidad_bicicletas',
        'ubicacion_evento',
        'observaciones',
        'precio_total',
        'estado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Alquiler;
use App\Models\Bicicleta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlquilerCorporativoController extends Controller
{
    /**
     * Mostrar formulario de solicitud de alquiler corporativo
     */
    public function create()
    {
        $bicicletas = Bicicleta::where('disponible_para_alquiler', true)->get();
        return view('alquiler-corporativo.create', compact('bicicletas'));
    }

    /**
     * Procesar la solicitud de alquiler corporativo
     */
    public function store(Request $request)
{
    // Validación
    $request->validate([
        'razon_social' => 'required|string|max:255',
        'ruc_empresa' => 'required|string|size:11',
        'contacto_nombre' => 'required|string|max:255',
        'contacto_email' => 'required|email',
        'contacto_telefono' => 'required|string|max:15',
        'tipo_evento' => 'required|string|max:255',
        'fecha_evento' => 'required|date',
        'duracion_horas' => 'required|integer|min:1',
        'cantidad_bicicletas' => 'required|integer|min:1',
        'ubicacion_evento' => 'required|string|max:500',
        'observaciones' => 'nullable|string|max:1000',
    ]);

    // Obtener una bicicleta disponible o crear una genérica
    $bicicleta = Bicicleta::where('disponible_para_alquiler', true)->first();
    
    if (!$bicicleta) {
        // Si no hay bicicletas, crear una genérica para corporativo
        $bicicleta = Bicicleta::create([
            'marca' => 'BiciSmart',
            'modelo' => 'Corporativa',
            'tipo' => 'urbana',
            'tamaño' => 'M',
            'estado' => 'nuevo',
            'precio_alquiler_hora' => 15.00,
            'descripcion' => 'Bicicleta para alquiler corporativo',
            'disponible_para_venta' => false,
            'disponible_para_alquiler' => true,
        ]);
    }

    // Crear el alquiler (pendiente de aprobación)
    $alquiler = Alquiler::create([
        'usuario_id' => Auth::id() ?? null,
        'bicicleta_id' => $bicicleta->id,
        'tipo_alquiler' => 'corporativo',
        'fecha_inicio' => $request->fecha_evento . ' 09:00:00',
        'fecha_fin' => $request->fecha_evento . ' 18:00:00',
        'cantidad_bicicletas' => $request->cantidad_bicicletas,
        'estado' => 'pendiente',
        'total' => $request->cantidad_bicicletas * 15 * $request->duracion_horas, // Cálculo básico
        'razon_social' => $request->razon_social,
        'ruc_empresa' => $request->ruc_empresa,
    ]);

    // Redirigir a confirmación
    return redirect()->route('alquiler-corporativo.confirmacion')
        ->with('solicitud_id', $alquiler->id);
}

    /**
     * Mostrar página de confirmación
     */
    public function confirmacion()
    {
        return view('alquiler-corporativo.confirmacion');
    }

    /**
     * Mostrar alquileres del usuario actual
     */
    public function misAlquileres()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $alquileres = Alquiler::where('usuario_id', Auth::id())
            ->where('tipo_alquiler', 'corporativo')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('alquiler-corporativo.mis-alquileres', compact('alquileres'));
    }
}
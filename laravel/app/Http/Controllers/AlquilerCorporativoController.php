<?php

namespace App\Http\Controllers;

use App\Models\Alquiler;
use App\Models\Bicicleta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
         $bicicleta = Bicicleta::where('disponible_para_alquiler', true)->first();
         if (!$bicicleta) {
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

        $usuario = Auth::user();

        if (!$usuario) {
            $usuario = User::firstOrCreate(
                ['email' => $request->contacto_email],
                [
                    'name' => $request->contacto_nombre,
                    'password' => Hash::make(Str::random(12)),
                    'role' => 'empresa',
                ]
            );
        }

        $alquiler = Alquiler::create([
            'usuario_id' => $usuario->id,
            'bicicleta_id' => $bicicleta->id,
            'tipo_alquiler' => 'corporativo',
            'fecha_inicio' => $request->fecha_evento . ' 09:00:00',
            'fecha_fin' => $request->fecha_evento . ' 18:00:00',
            'cantidad_bicicletas' => $request->cantidad_bicicletas,
            'estado' => 'pendiente',
            'total' => $request->cantidad_bicicletas * 15 * $request->duracion_horas,
            'razon_social' => $request->razon_social,
            'ruc_empresa' => $request->ruc_empresa,
        ]);

        return redirect()->route('alquiler-corporativo.confirmacion')
            ->with('solicitud_id', $alquiler->id);
    }

    public function confirmacion()
    {
        return view('alquiler-corporativo.confirmacion');
    }

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
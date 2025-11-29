<?php

namespace App\Http\Controllers;

use App\Models\Alquiler;
use App\Models\Bicicleta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlquilerCorporativoController extends Controller
{
    public function create()
    {
        $bicicletas = Bicicleta::where('disponible_para_alquiler', true)->get();
        return view('alquiler-corporativo.create', compact('bicicletas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'razon_social' => 'required|string|max:255',
            'ruc_empresa' => 'required|string|size:11',
            'contacto_nombre' => 'required|string|max:255',
            'contacto_email' => 'required|email|max:255',
            'contacto_telefono' => 'required|string|max:20',
            'tipo_evento' => 'required|string|max:100',
            'fecha_evento' => 'required|date|after_or_equal:today',
            'duracion_horas' => 'required|integer|min:1|max:24',
            'cantidad_bicicletas' => 'required|integer|min:5|max:100',
            'ubicacion_evento' => 'required|string|max:500',
            'observaciones' => 'nullable|string|max:1000',
        ]);

        return redirect()->route('alquiler-corporativo.confirmacion')
                         ->with('success', 'Solicitud enviada correctamente');
    }

    public function confirmacion()
    {
        return view('alquiler-corporativo.confirmacion');
    }

    public function misAlquileres()
    {
        $user = Auth::user();
        $alquileres = Alquiler::where('user_id', $user->id)->get();
        return view('alquiler-corporativo.mis-alquileres', compact('alquileres'));
    }
}

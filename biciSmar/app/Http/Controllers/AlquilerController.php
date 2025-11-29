<?php

namespace App\Http\Controllers;

use App\Models\Alquiler;
use App\Models\Bicicleta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AlquilerController extends Controller
{
    // ADMIN: ver todos los alquileres
    public function index()
    {
        $alquileres = Alquiler::with(['usuario', 'bicicleta'])
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('alquileres.index', compact('alquileres'));
    }

    // USUARIO: ver sus propios alquileres
    public function misAlquileres()
    {
        $user = Auth::user();

        $alquileres = Alquiler::with('bicicleta')
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('alquileres.mis', compact('alquileres'));
    }

    // FORMULARIO INDIVIDUAL
    public function createIndividual()
    {
        $bicicletas = Bicicleta::where('estado', 'disponible')->get();
        return view('alquileres.create_individual', compact('bicicletas'));
    }

    // GUARDAR ALQUILER INDIVIDUAL CON PRECIO AUTOMÁTICO
    public function storeIndividual(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'bicicleta_id' => 'required|exists:bicicletas,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin'    => 'required|date|after:fecha_inicio',
        ]);

        // Obtener bicicleta
        $bicicleta = Bicicleta::findOrFail($request->bicicleta_id);

        // Calcular horas
        $inicio = Carbon::parse($request->fecha_inicio);
        $fin = Carbon::parse($request->fecha_fin);
        $horas = $fin->diffInHours($inicio);

        if ($horas < 1) $horas = 1; // mínimo 1 hora

        // Calcular precio
        $precioTotal = $horas * $bicicleta->precio_alquiler_hora;

        Alquiler::create([
            'user_id'       => $user->id,
            'bicicleta_id'  => $request->bicicleta_id,
            'fecha_inicio'  => $request->fecha_inicio,
            'fecha_fin'     => $request->fecha_fin,
            'total'         => $precioTotal,
            'tipo_cliente'  => 'individual',
        ]);

        return redirect()->route('alquileres.mis')
            ->with('success', 'Alquiler registrado correctamente.');
    }

    // FORMULARIO CORPORATIVO
    public function createCorporativo()
    {
        $bicicletas = Bicicleta::where('estado', 'disponible')->get();
        return view('alquileres.create_corporativo', compact('bicicletas'));
    }

    // GUARDAR ALQUILER CORPORATIVO CON PRECIO AUTOMÁTICO
    public function storeCorporativo(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'bicicleta_id' => 'required|exists:bicicletas,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin'    => 'required|date|after:fecha_inicio',
        ]);

        // Obtener bicicleta
        $bicicleta = Bicicleta::findOrFail($request->bicicleta_id);

        // Calcular horas
        $inicio = Carbon::parse($request->fecha_inicio);
        $fin = Carbon::parse($request->fecha_fin);
        $horas = $fin->diffInHours($inicio);

        if ($horas < 1) $horas = 1;

        // Precio automático
        $precioTotal = $horas * $bicicleta->precio_alquiler_hora;

        Alquiler::create([
            'user_id'       => $user->id,
            'bicicleta_id'  => $request->bicicleta_id,
            'fecha_inicio'  => $request->fecha_inicio,
            'fecha_fin'     => $request->fecha_fin,
            'total'         => $precioTotal,
            'tipo_cliente'  => 'empresa',
        ]);

        return redirect()->route('alquileres.mis')
            ->with('success', 'Alquiler corporativo registrado correctamente.');
    }
}

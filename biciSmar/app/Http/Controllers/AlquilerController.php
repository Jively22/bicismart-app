<?php

namespace App\Http\Controllers;

use App\Models\Alquiler;
use App\Models\Bicicleta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlquilerController extends Controller
{
    public function index()
    {
        $alquileres = Alquiler::with(['bicicleta', 'user'])
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('alquileres.index', compact('alquileres'));
    }

    public function create()
    {
        $bicicletas = Bicicleta::where('estado', 'disponible')->get();
        return view('alquileres.create', compact('bicicletas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'bicicleta_id' => 'required|exists:bicicletas,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'tipo_cliente' => 'required|in:individual,empresa',
            'total' => 'required|numeric|min:0',
            'estado' => 'required|in:pendiente,en_curso,finalizado',
        ]);

        Alquiler::create($data);

        return redirect()->route('alquileres.index')
            ->with('success', 'Alquiler registrado correctamente.');
    }

    public function show(Alquiler $alquiler)
    {
        return view('alquileres.show', compact('alquiler'));
    }

    public function edit(Alquiler $alquiler)
    {
        $bicicletas = Bicicleta::where('estado', 'disponible')->orWhere('id', $alquiler->bicicleta_id)->get();
        return view('alquileres.edit', compact('alquiler', 'bicicletas'));
    }

    public function update(Request $request, Alquiler $alquiler)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'bicicleta_id' => 'required|exists:bicicletas,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'tipo_cliente' => 'required|in:individual,empresa',
            'total' => 'required|numeric|min:0',
            'estado' => 'required|in:pendiente,en_curso,finalizado',
        ]);

        $alquiler->update($data);

        return redirect()->route('alquileres.index')
            ->with('success', 'Alquiler actualizado correctamente.');
    }

    public function destroy(Alquiler $alquiler)
    {
        $alquiler->delete();
        return redirect()->route('alquileres.index')
            ->with('success', 'Alquiler eliminado correctamente.');
    }

    // Para usuarios regulares
    public function misAlquileres()
    {
        $alquileres = Alquiler::with('bicicleta')
            ->where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        return view('alquileres.mis', compact('alquileres'));
    }
}

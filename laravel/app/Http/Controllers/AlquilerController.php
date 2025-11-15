<?php

namespace App\Http\Controllers;

use App\Models\Alquiler;
use App\Models\Bicicleta;
use App\Models\User;
use Illuminate\Http\Request;

class AlquilerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alquileres = Alquiler::with(['usuario', 'bicicleta'])->get();
        return view('alquileres.index', compact('alquileres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bicicletas = Bicicleta::where('disponible_para_alquiler', true)->get();
        $usuarios = User::whereIn('role', ['cliente', 'empresa'])->get();
        
        return view('alquileres.create', compact('bicicletas', 'usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'bicicleta_id' => 'required|exists:bicicletas,id',
            'tipo_alquiler' => 'required|in:individual,corporativo',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'cantidad_bicicletas' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
        ]);

        Alquiler::create($request->all());

        return redirect()->route('alquileres.index')
            ->with('success', 'Alquiler creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alquiler $alquilere)
    {
        $alquiler = $alquilere;
        return view('alquileres.show', compact('alquiler'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alquiler $alquilere)
    {
        $alquiler = $alquilere;
        $bicicletas = Bicicleta::where('disponible_para_alquiler', true)->get();
        $usuarios = User::whereIn('role', ['cliente', 'empresa'])->get();
        
        return view('alquileres.edit', compact('alquiler', 'bicicletas', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alquiler $alquilere)
    {
        $alquiler = $alquilere;
        
        // Validación
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'bicicleta_id' => 'required|exists:bicicletas,id',
            'tipo_alquiler' => 'required|in:individual,corporativo',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'cantidad_bicicletas' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
        ]);

        $alquiler->update($request->all());

        return redirect()->route('alquileres.index')
            ->with('success', 'Alquiler actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alquiler $alquilere)
    {
        $alquilere->delete();

        return redirect()->route('alquileres.index')
            ->with('success', 'Alquiler eliminado exitosamente.');
    }
}
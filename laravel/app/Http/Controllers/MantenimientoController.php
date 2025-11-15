<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use App\Models\User;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mantenimientos = Mantenimiento::with(['usuario', 'tecnico'])->get();
        return view('mantenimientos.index', compact('mantenimientos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = User::whereIn('role', ['cliente', 'empresa'])->get();
        $tecnicos = User::where('role', 'admin')->get(); // O crear rol 'tecnico' si prefieres
        
        return view('mantenimientos.create', compact('usuarios', 'tecnicos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'tecnico_id' => 'required|exists:users,id',
            'marca_bicicleta' => 'required|string|max:255',
            'modelo_bicicleta' => 'required|string|max:255',
            'descripcion_problema' => 'required|string|max:1000',
            'precio_pactado' => 'nullable|numeric|min:0',
        ]);

        // Crear el mantenimiento
        Mantenimiento::create([
            'usuario_id' => $request->usuario_id,
            'tecnico_id' => $request->tecnico_id,
            'marca_bicicleta' => $request->marca_bicicleta,
            'modelo_bicicleta' => $request->modelo_bicicleta,
            'descripcion_problema' => $request->descripcion_problema,
            'estado' => 'pendiente',
            'precio_pactado' => $request->precio_pactado,
        ]);

        return redirect()->route('mantenimientos.index')
            ->with('success', 'Mantenimiento creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mantenimiento $mantenimiento)
    {
        $mantenimiento->load(['usuario', 'tecnico']);
        return view('mantenimientos.show', compact('mantenimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mantenimiento $mantenimiento)
    {
        $usuarios = User::whereIn('role', ['cliente', 'empresa'])->get();
        $tecnicos = User::where('role', 'admin')->get();
        
        return view('mantenimientos.edit', compact('mantenimiento', 'usuarios', 'tecnicos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mantenimiento $mantenimiento)
    {
        // Validación
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'tecnico_id' => 'required|exists:users,id',
            'marca_bicicleta' => 'required|string|max:255',
            'modelo_bicicleta' => 'required|string|max:255',
            'descripcion_problema' => 'required|string|max:1000',
            'estado' => 'required|in:pendiente,aceptado,en_proceso,completado,cancelado',
            'precio_pactado' => 'nullable|numeric|min:0',
        ]);

        // Actualizar el mantenimiento
        $mantenimiento->update($request->all());

        return redirect()->route('mantenimientos.index')
            ->with('success', 'Mantenimiento actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mantenimiento $mantenimiento)
    {
        $mantenimiento->delete();

        return redirect()->route('mantenimientos.index')
            ->with('success', 'Mantenimiento eliminado exitosamente.');
    }
}
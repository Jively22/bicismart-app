<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use App\Models\Bicicleta;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Mantenimiento::with('bicicleta');

        // Filtros
        if ($request->filled('bicicleta_id')) {
            $query->where('bicicleta_id', $request->bicicleta_id);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        $mantenimientos = $query->orderBy('fecha_mantenimiento', 'desc')->paginate(10);
        
        // Obtener bicicletas para el filtro
        $bicicletas = Bicicleta::all();

        // Estadísticas
        $estadisticas = [
            'pendientes' => Mantenimiento::where('estado', 'pendiente')->count(),
            'en_proceso' => Mantenimiento::where('estado', 'en_proceso')->count(),
            'completados' => Mantenimiento::where('estado', 'completado')->count(),
        ];

        return view('mantenimientos.index', compact('mantenimientos', 'bicicletas', 'estadisticas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bicicletas = Bicicleta::all();
        return view('mantenimientos.create', compact('bicicletas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bicicleta_id' => 'required|exists:bicicletas,id',
            'tipo' => 'required|in:preventivo,correctivo,revision',
            'descripcion' => 'required|string|max:1000',
            'fecha_mantenimiento' => 'required|date',
            'costo' => 'required|numeric|min:0',
            'estado' => 'required|in:pendiente,en_proceso,completado',
            'tecnico_responsable' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string|max:1000',
        ], [
            'bicicleta_id.required' => 'Debe seleccionar una bicicleta',
            'bicicleta_id.exists' => 'La bicicleta seleccionada no existe',
            'tipo.required' => 'Debe seleccionar el tipo de mantenimiento',
            'tipo.in' => 'El tipo de mantenimiento no es válido',
            'descripcion.required' => 'La descripción es obligatoria',
            'descripcion.max' => 'La descripción no puede exceder 1000 caracteres',
            'fecha_mantenimiento.required' => 'La fecha de mantenimiento es obligatoria',
            'fecha_mantenimiento.date' => 'La fecha no es válida',
            'costo.required' => 'El costo es obligatorio',
            'costo.numeric' => 'El costo debe ser un número',
            'costo.min' => 'El costo no puede ser negativo',
            'estado.required' => 'Debe seleccionar el estado',
            'estado.in' => 'El estado seleccionado no es válido',
        ]);

        Mantenimiento::create($validated);

        return redirect()->route('mantenimientos.index')
                         ->with('success', 'Mantenimiento registrado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mantenimiento $mantenimiento)
    {
        return view('mantenimientos.show', compact('mantenimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mantenimiento $mantenimiento)
    {
        $bicicletas = Bicicleta::all();
        return view('mantenimientos.edit', compact('mantenimiento', 'bicicletas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mantenimiento $mantenimiento)
    {
        $validated = $request->validate([
            'bicicleta_id' => 'required|exists:bicicletas,id',
            'tipo' => 'required|in:preventivo,correctivo,revision',
            'descripcion' => 'required|string|max:1000',
            'fecha_mantenimiento' => 'required|date',
            'costo' => 'required|numeric|min:0',
            'estado' => 'required|in:pendiente,en_proceso,completado',
            'tecnico_responsable' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string|max:1000',
        ], [
            'bicicleta_id.required' => 'Debe seleccionar una bicicleta',
            'bicicleta_id.exists' => 'La bicicleta seleccionada no existe',
            'tipo.required' => 'Debe seleccionar el tipo de mantenimiento',
            'tipo.in' => 'El tipo de mantenimiento no es válido',
            'descripcion.required' => 'La descripción es obligatoria',
            'descripcion.max' => 'La descripción no puede exceder 1000 caracteres',
            'fecha_mantenimiento.required' => 'La fecha de mantenimiento es obligatoria',
            'fecha_mantenimiento.date' => 'La fecha no es válida',
            'costo.required' => 'El costo es obligatorio',
            'costo.numeric' => 'El costo debe ser un número',
            'costo.min' => 'El costo no puede ser negativo',
            'estado.required' => 'Debe seleccionar el estado',
            'estado.in' => 'El estado seleccionado no es válido',
        ]);

        $mantenimiento->update($validated);

        return redirect()->route('mantenimientos.index')
                         ->with('success', 'Mantenimiento actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mantenimiento $mantenimiento)
    {
        $mantenimiento->delete();

        return redirect()->route('mantenimientos.index')
                         ->with('success', 'Mantenimiento eliminado exitosamente');
    }
}
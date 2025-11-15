<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use App\Models\Bicicleta;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    public function index(Request $request)
    {
        $query = Mantenimiento::with('bicicleta');

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
        
        $bicicletas = Bicicleta::all();

        $estadisticas = [
            'pendientes' => Mantenimiento::where('estado', 'pendiente')->count(),
            'en_proceso' => Mantenimiento::where('estado', 'en_proceso')->count(),
            'completados' => Mantenimiento::where('estado', 'completado')->count(),
        ];

        return view('mantenimientos.index', compact('mantenimientos', 'bicicletas', 'estadisticas'));
    }

    public function create()
    {
        $bicicletas = Bicicleta::where('estado', '!=', 'en_mantenimiento')->get();
        
        return view('mantenimientos.create', compact('bicicletas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bicicleta_id' => 'required|exists:bicicletas,id',
            'tipo' => 'required|in:preventivo,correctivo,revision,urgente',
            'descripcion' => 'required|string|max:1000',
            'fecha_inicio' => 'required|date',
            'fecha_fin_prevista' => 'nullable|date|after_or_equal:fecha_inicio',
            'costo_estimado' => 'nullable|numeric|min:0',
            'estado' => 'required|in:pendiente,en_proceso,completado,cancelado',
            'tecnico_responsable' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string|max:1000',
        ]);

        $mantenimiento = Mantenimiento::create($validated);

        $bicicleta = Bicicleta::find($validated['bicicleta_id']);
        $bicicleta->update(['estado' => 'en_mantenimiento']);

        return redirect()->route('mantenimientos.index')
                         ->with('success', 'Mantenimiento registrado exitosamente.');
    }

    public function show(Mantenimiento $mantenimiento)
    {
        return view('mantenimientos.show', compact('mantenimiento'));
    }

    public function edit(Mantenimiento $mantenimiento)
    {
        $bicicletas = Bicicleta::all();
        
        return view('mantenimientos.edit', compact('mantenimiento', 'bicicletas'));
    }

    public function update(Request $request, Mantenimiento $mantenimiento)
    {
        $validated = $request->validate([
            'bicicleta_id' => 'required|exists:bicicletas,id',
            'tipo' => 'required|in:preventivo,correctivo,revision,urgente',
            'descripcion' => 'required|string|max:1000',
            'fecha_inicio' => 'required|date',
            'fecha_fin_prevista' => 'nullable|date|after_or_equal:fecha_inicio',
            'costo_estimado' => 'nullable|numeric|min:0',
            'estado' => 'required|in:pendiente,en_proceso,completado,cancelado',
            'tecnico_responsable' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string|max:1000',
        ]);

        if ($validated['estado'] === 'completado' && $mantenimiento->estado !== 'completado') {
            $bicicleta = Bicicleta::find($validated['bicicleta_id']);
            $bicicleta->update(['estado' => 'disponible']);
        }

        if ($mantenimiento->bicicleta_id != $validated['bicicleta_id']) {
            $bicicletaAnterior = Bicicleta::find($mantenimiento->bicicleta_id);
            $bicicletaAnterior->update(['estado' => 'disponible']);
            
            $nuevaBicicleta = Bicicleta::find($validated['bicicleta_id']);
            $nuevaBicicleta->update(['estado' => 'en_mantenimiento']);
        }

        $mantenimiento->update($validated);

        return redirect()->route('mantenimientos.index')
                         ->with('success', 'Mantenimiento actualizado exitosamente');
    }

    public function destroy(Mantenimiento $mantenimiento)
    {
        $bicicleta = Bicicleta::find($mantenimiento->bicicleta_id);
        if ($bicicleta && $mantenimiento->estado !== 'completado') {
            $bicicleta->update(['estado' => 'disponible']);
        }

        $mantenimiento->delete();

        return redirect()->route('mantenimientos.index')
                         ->with('success', 'Mantenimiento eliminado exitosamente');
    }

    public function completar(Mantenimiento $mantenimiento)
    {
        $mantenimiento->update([
            'estado' => 'completado',
            'fecha_fin' => now(),
        ]);

        $bicicleta = Bicicleta::find($mantenimiento->bicicleta_id);
        $bicicleta->update(['estado' => 'disponible']);

        return redirect()->route('mantenimientos.index')
                         ->with('success', 'Mantenimiento marcado como completado');
    }
}
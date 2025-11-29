<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    // Vista pública
    public function indexPublic()
    {
        $mantenimientos = Mantenimiento::orderBy('tipo_servicio', 'asc')->get();
        return view('mantenimientos.public', compact('mantenimientos'));
    }

    // Listado admin
    public function index()
    {
        $mantenimientos = Mantenimiento::orderBy('id', 'desc')->get();
        return view('mantenimientos.index', compact('mantenimientos'));
    }

    public function create()
    {
        return view('mantenimientos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric',
            'tipo_servicio' => 'required',
            'tecnico' => 'required',
        ]);

        Mantenimiento::create($request->all());

        return redirect()->route('mantenimientos.index')
            ->with('success', 'Servicio creado correctamente.');
    }

    public function edit($id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);
        return view('mantenimientos.edit', compact('mantenimiento'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric',
            'tipo_servicio' => 'required',
            'tecnico' => 'required',
        ]);

        $mantenimiento = Mantenimiento::findOrFail($id);
        $mantenimiento->update($request->all());

        return redirect()->route('mantenimientos.index')
            ->with('success', 'Servicio actualizado correctamente.');
    }

    public function destroy($id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);
        $mantenimiento->delete();

        return redirect()->route('mantenimientos.index')
            ->with('success', 'Servicio eliminado correctamente.');
    }
}

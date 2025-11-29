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

    // Admin
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
        $data = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric',
            'tipo_servicio' => 'required',
            'tecnico' => 'required',
        ]);

        Mantenimiento::create($data);

        return redirect()->route('mantenimientos.index')->with('success', 'Servicio creado.');
    }

    public function edit($id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);
        return view('mantenimientos.edit', compact('mantenimiento'));
    }

    public function update(Request $request, $id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);

        $data = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric',
            'tipo_servicio' => 'required',
            'tecnico' => 'required',
        ]);

        $mantenimiento->update($data);

        return redirect()->route('mantenimientos.index')->with('success', 'Servicio actualizado.');
    }

    public function destroy($id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);
        $mantenimiento->delete();

        return redirect()->route('mantenimientos.index')->with('success', 'Servicio eliminado.');
    }

    // Historial de mantenimientos del usuario (si se usa en el futuro)
    public function misMantenimientos()
    {
        // Placeholder: dependería de la tabla de solicitudes de mantenimiento
        return view('mantenimientos.mis');
    }
}

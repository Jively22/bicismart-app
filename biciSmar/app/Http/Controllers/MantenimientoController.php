<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use App\Models\MantenimientoSolicitud;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    public function index()
    {
        $mantenimientos = Mantenimiento::orderBy('id', 'desc')->paginate(15);
        return view('mantenimientos.index', compact('mantenimientos'));
    }

    public function indexPublic()
    {
        $mantenimientos = Mantenimiento::all();
        return view('mantenimientos.public', compact('mantenimientos'));
    }

    public function misMantenimientos()
    {
        // Si en un futuro se relaciona con usuario, aquí se filtraría.
        $mantenimientos = Mantenimiento::orderBy('id', 'desc')->get();
        return view('mantenimientos.mis', compact('mantenimientos'));
    }

    public function solicitarForm(Mantenimiento $mantenimiento)
    {
        return view('mantenimientos.solicitar', compact('mantenimiento'));
    }

    public function enviarSolicitud(Request $request, Mantenimiento $mantenimiento)
    {
        $data = $request->validate([
            'tipo_objetivo'   => 'required|in:bicicleta,flota',
            'nombre_objetivo' => 'required|string|max:255',
            'cantidad'        => 'required|integer|min:1',
            'notas'           => 'nullable|string',
        ]);

        if (!$request->user()) {
            abort(403);
        }

        MantenimientoSolicitud::create([
            'user_id'          => $request->user()->id,
            'mantenimiento_id' => $mantenimiento->id,
            'tipo_objetivo'    => $data['tipo_objetivo'],
            'nombre_objetivo'  => $data['nombre_objetivo'],
            'cantidad'         => $data['cantidad'],
            'notas'            => $data['notas'] ?? null,
        ]);

        return redirect()->route('mantenimientos.public')
            ->with('success', 'Solicitud de mantenimiento registrada correctamente.');
    }

    public function create()
    {
        return view('mantenimientos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'tipo_servicio' => 'required|string|max:50',
            'proveedor' => 'nullable|string|max:255',
        ]);

        Mantenimiento::create($data);

        return redirect()->route('admin.mantenimientos.index')->with('success', 'Servicio creado correctamente.');
    }

    public function edit(Mantenimiento $mantenimiento)
    {
        return view('mantenimientos.edit', compact('mantenimiento'));
    }

    public function update(Request $request, Mantenimiento $mantenimiento)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'tipo_servicio' => 'required|string|max:50',
            'proveedor' => 'nullable|string|max:255',
        ]);

        $mantenimiento->update($data);

        return redirect()->route('admin.mantenimientos.index')->with('success', 'Servicio actualizado correctamente.');
    }

    public function destroy(Mantenimiento $mantenimiento)
    {
        $mantenimiento->delete();

        return redirect()->route('admin.mantenimientos.index')->with('success', 'Servicio eliminado correctamente.');
    }
}

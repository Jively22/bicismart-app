<?php

namespace App\Http\Controllers;

use App\Models\SolicitudCorporativa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudCorporativaController extends Controller
{
    // Formulario para empresa
    public function create()
    {
        $user = Auth::user();

        if (!$user || $user->tipo_cliente !== 'empresa') {
            abort(403, 'Solo las empresas pueden registrar alquileres corporativos.');
        }

        return view('corporativo.create', compact('user'));
    }

    // Guardar solicitud corporativa
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user || $user->tipo_cliente !== 'empresa') {
            abort(403, 'Solo las empresas pueden registrar alquileres corporativos.');
        }

        $data = $request->validate([
            'razon_social'        => 'required|string|max:255',
            'ruc'                 => 'required|string|max:15',
            'contacto_nombre'     => 'required|string|max:255',
            'contacto_email'      => 'required|email|max:255',
            'contacto_telefono'   => 'required|string|max:30',
            'tipo_evento'         => 'required|string|max:255',
            'fecha_evento'        => 'required|date',
            'duracion_horas'      => 'required|integer|min:1',
            'cantidad_bicicletas' => 'required|integer|min:1',
            'ubicacion_evento'    => 'required|string',
            'observaciones'       => 'nullable|string',
        ]);

        // Tarifas corporativas
        $tarifaPorBicicleta = 35; // S/
        $tarifaPorHora      = 10; // S/

        $precioTotal = ($data['cantidad_bicicletas'] * $tarifaPorBicicleta)
                     + ($data['duracion_horas'] * $tarifaPorHora);

        $data['user_id']      = $user->id;
        $data['precio_total'] = $precioTotal;
        $data['estado']       = 'pendiente';

        SolicitudCorporativa::create($data);

        return redirect()
            ->route('corporativo.mis')
            ->with('success', 'Solicitud de alquiler corporativo enviada correctamente.');
    }

    // Listado de solicitudes para la empresa
    public function misSolicitudes()
    {
        $user = Auth::user();

        $solicitudes = SolicitudCorporativa::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('corporativo.mis', compact('solicitudes'));
    }

    // ADMIN: ver todas las solicitudes
    public function index()
    {
        $solicitudes = SolicitudCorporativa::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.corporativo.index', compact('solicitudes'));
    }

    // ADMIN: cambiar estado
    public function updateEstado(Request $request, SolicitudCorporativa $solicitud)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,aprobado,rechazado',
        ]);

        $solicitud->estado = $request->estado;
        $solicitud->save();

        return back()->with('success', 'Estado actualizado correctamente.');
    }

    // ADMIN / EMPRESA: ver detalle
    public function show(SolicitudCorporativa $solicitud)
    {
        $user = Auth::user();

        // Solo puede ver el admin o el dueño de la solicitud
        if (!$user || (!$user->is_admin && $user->id !== $solicitud->user_id)) {
            abort(403);
        }

        return view('admin.corporativo.show', compact('solicitud'));
    }
}

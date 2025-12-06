<?php

namespace App\Http\Controllers;

use App\Models\Bicicleta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BicicletaController extends Controller
{
    public function index()
    {
        $bicicletas = Bicicleta::orderBy('id', 'desc')->paginate(50);
        return view('bicicletas.index', compact('bicicletas'));
    }

    public function catalogo(Request $request)
    {
        $query = Bicicleta::query()->where('estado', 'disponible');

        if ($request->filled('tipo')) {
            $query->where('tipo', $request->input('tipo'));
        }

        if ($request->filled('buscar')) {
            $buscar = $request->input('buscar');
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%{$buscar}%")
                  ->orWhere('descripcion', 'like', "%{$buscar}%");
            });
        }

        if ($request->filled('precio_min')) {
            $query->where('precio_venta', '>=', $request->input('precio_min'));
        }

        if ($request->filled('precio_max')) {
            $query->where('precio_venta', '<=', $request->input('precio_max'));
        }

        $sort = $request->input('ordenar');
        if ($sort === 'price_desc') {
            $query->orderByDesc('precio_venta');
        } elseif ($sort === 'price_asc') {
            $query->orderBy('precio_venta');
        } elseif ($sort === 'popular') {
            $query->orderByDesc('stock');
        } else {
            $query->orderByDesc('id');
        }

        $bicicletas = $query->get();

        if ($sort === 'rating') {
            $bicicletas = $bicicletas->map(function ($bici) {
                $bici->rating = ($bici->id % 5) + 1;
                return $bici;
            })->sortByDesc('rating')->values();
        }

        return view('bicicletas.catalogo', compact('bicicletas'));
    }

    public function showPublic(Bicicleta $bicicleta)
    {
        $sampleReviews = [
            ['user' => 'Ana Torres', 'rating' => 5, 'comment' => 'Ligera y cómoda para ciudad, el cambio responde perfecto.'],
            ['user' => 'Carlos Vega', 'rating' => 4, 'comment' => 'Buen desempeño, la pedí con entrega y llegó ajustada.'],
            ['user' => 'María López', 'rating' => 5, 'comment' => 'Excelente para trayectos diarios, frenos muy confiables.'],
            ['user' => 'Javier Ruiz', 'rating' => 4, 'comment' => 'Rueda suave, el asiento podría ser más acolchado.'],
        ];

        $reviews = collect($sampleReviews)->map(function ($r) {
            $r['stars'] = str_repeat('★', $r['rating']) . str_repeat('☆', 5 - $r['rating']);
            return $r;
        });
        $avgRating = round($reviews->avg('rating'), 1);

        return view('bicicletas.show_public', compact('bicicleta', 'reviews', 'avgRating'));
    }

    public function create()
    {
        return view('bicicletas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:50',
            'descripcion' => 'nullable|string',
            'precio_venta' => 'nullable|numeric',
            'precio_alquiler_hora' => 'nullable|numeric',
            'stock' => 'required|integer|min:0',
            'estado' => 'required|string|max:50',
            'foto' => 'nullable|image',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('bicicletas', 'public');
        }

        Bicicleta::create($data);

        return redirect()->route('admin.bicicletas.index')
            ->with('success', 'Bicicleta creada correctamente.');
    }

    public function edit(Bicicleta $bicicleta)
    {
        return view('bicicletas.edit', compact('bicicleta'));
    }

    public function update(Request $request, Bicicleta $bicicleta)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:50',
            'descripcion' => 'nullable|string',
            'precio_venta' => 'nullable|numeric',
            'precio_alquiler_hora' => 'nullable|numeric',
            'stock' => 'required|integer|min:0',
            'estado' => 'required|string|max:50',
            'foto' => 'nullable|image',
        ]);

        if ($request->hasFile('foto')) {
            if ($bicicleta->foto) {
                Storage::disk('public')->delete($bicicleta->foto);
            }
            $data['foto'] = $request->file('foto')->store('bicicletas', 'public');
        }

        $bicicleta->update($data);

        return redirect()->route('admin.bicicletas.index')
            ->with('success', 'Bicicleta actualizada correctamente.');
    }

    public function destroy(Bicicleta $bicicleta)
    {
        if ($bicicleta->foto) {
            Storage::disk('public')->delete($bicicleta->foto);
        }

        $bicicleta->delete();

        return redirect()->route('admin.bicicletas.index')
            ->with('success', 'Bicicleta eliminada correctamente.');
    }
}

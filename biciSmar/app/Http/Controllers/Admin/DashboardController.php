<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alquiler;
use App\Models\Bicicleta;
use App\Models\Mantenimiento;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBicicletas = Bicicleta::count();
        $totalAlquileres = Alquiler::count();
        $totalServicios = Mantenimiento::count();
        $totalVentas = Order::sum('total');

        return view('admin.dashboard', compact(
            'totalBicicletas',
            'totalAlquileres',
            'totalServicios',
            'totalVentas'
        ));
    }
}

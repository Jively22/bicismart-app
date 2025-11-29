<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bicicleta;
use App\Models\Alquiler;
use App\Models\Mantenimiento;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBicicletas = Bicicleta::count();
        $totalAlquileres = Alquiler::count();
        $totalMantenimientos = Mantenimiento::count();
        $totalVentas = Order::sum('total');
        $totalUsuarios = User::count();

        return view('admin.dashboard', compact(
            'totalBicicletas',
            'totalAlquileres',
            'totalMantenimientos',
            'totalVentas',
            'totalUsuarios'
        ));
    }
}

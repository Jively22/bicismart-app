<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class VentaController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.bicicleta', 'items.accesory'])
            ->orderByDesc('id')
            ->paginate(12);

        return view('admin.ventas.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.bicicleta', 'items.accesory']);

        return view('admin.ventas.show', compact('order'));
    }
}

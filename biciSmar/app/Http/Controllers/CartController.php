<?php

namespace App\Http\Controllers;

use App\Models\Bicicleta;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return view('cart.index', ['cart' => [], 'bicicletas' => [], 'total' => 0]);
        }

        $ids = array_keys($cart);
        $bicicletas = Bicicleta::whereIn('id', $ids)->get();
        $total = 0;

        foreach ($bicicletas as $bici) {
            $total += ($bici->precio_venta ?? 0) * $cart[$bici->id];
        }

        return view('cart.index', compact('cart', 'bicicletas', 'total'));
    }

    public function add(Bicicleta $bicicleta)
    {
        $cart = session('cart', []);
        $cart[$bicicleta->id] = ($cart[$bicicleta->id] ?? 0) + 1;
        session(['cart' => $cart]);

        return back()->with('success', 'Bicicleta añadida al carrito.');
    }

    public function update(Request $request, Bicicleta $bicicleta)
    {
        $cart = session('cart', []);
        $cantidad = max(1, (int) $request->input('cantidad', 1));
        $cart[$bicicleta->id] = $cantidad;
        session(['cart' => $cart]);

        return back()->with('success', 'Carrito actualizado.');
    }

    public function remove(Bicicleta $bicicleta)
    {
        $cart = session('cart', []);
        unset($cart[$bicicleta->id]);
        session(['cart' => $cart]);

        return back()->with('success', 'Bicicleta eliminada del carrito.');
    }

    public function checkout()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return back()->with('success', 'Tu carrito está vacío.');
        }

        try {
            DB::transaction(function () use ($cart) {
                $user = Auth::user();
                $ids = array_keys($cart);

                // Bloquea los registros para evitar carreras de stock
                $bicicletas = Bicicleta::whereIn('id', $ids)
                    ->lockForUpdate()
                    ->get();

                if ($bicicletas->count() !== count($cart)) {
                    throw new \RuntimeException('Algunas bicicletas ya no están disponibles.');
                }

                $total = 0;

                foreach ($bicicletas as $bici) {
                    $cantidad = $cart[$bici->id];
                    $precioUnitario = $bici->precio_venta ?? 0;

                    if ($precioUnitario <= 0) {
                        throw new \RuntimeException('Hay bicicletas sin precio de venta configurado.');
                    }

                    if (($bici->estado !== 'disponible') || ($bici->stock < $cantidad)) {
                        throw new \RuntimeException("Stock insuficiente o no disponible: {$bici->nombre}");
                    }

                    $total += $precioUnitario * $cantidad;
                }

                $order = Order::create([
                    'user_id' => $user->id,
                    'total' => $total,
                ]);

                foreach ($bicicletas as $bici) {
                    $cantidad = $cart[$bici->id];
                    $precioUnitario = $bici->precio_venta ?? 0;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'bicicleta_id' => $bici->id,
                        'cantidad' => $cantidad,
                        'precio_unitario' => $precioUnitario,
                        'subtotal' => $precioUnitario * $cantidad,
                    ]);

                    $bici->decrement('stock', $cantidad);
                }
            });
        } catch (\Throwable $e) {
            return back()->withErrors(['checkout' => $e->getMessage()]);
        }

        session()->forget('cart');

        return redirect()->route('cart.historial')->with('success', 'Compra registrada correctamente.');
    }

    public function historial()
    {
        $orders = Order::with('items.bicicleta')
            ->where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        return view('cart.historial', compact('orders'));
    }
}

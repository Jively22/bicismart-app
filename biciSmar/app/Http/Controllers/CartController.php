<?php

namespace App\Http\Controllers;

use App\Models\Accesory;
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
        $cartBikes = session('cart', []);
        $cartAccessories = session('cart_accessories', []);

        $bicicletas = !empty($cartBikes) ? Bicicleta::whereIn('id', array_keys($cartBikes))->get() : collect();
        $accesories = !empty($cartAccessories) ? Accesory::whereIn('id', array_keys($cartAccessories))->get() : collect();

        $total = 0;
        foreach ($bicicletas as $bici) {
            $total += ($bici->precio_venta ?? 0) * $cartBikes[$bici->id];
        }
        foreach ($accesories as $acc) {
            $total += ($acc->precio ?? 0) * $cartAccessories[$acc->id];
        }

        return view('cart.index', [
            'cart' => $cartBikes,
            'bicicletas' => $bicicletas,
            'cartAccessories' => $cartAccessories,
            'accesories' => $accesories,
            'total' => $total,
        ]);
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

    public function addAccessory(Accesory $accesory)
    {
        $cart = session('cart_accessories', []);
        $cart[$accesory->id] = ($cart[$accesory->id] ?? 0) + 1;
        session(['cart_accessories' => $cart]);

        return back()->with('success', 'Accesorio añadido al carrito.');
    }

    public function updateAccessory(Request $request, Accesory $accesory)
    {
        $cart = session('cart_accessories', []);
        $cantidad = max(1, (int) $request->input('cantidad', 1));
        $cart[$accesory->id] = $cantidad;
        session(['cart_accessories' => $cart]);

        return back()->with('success', 'Carrito de accesorios actualizado.');
    }

    public function removeAccessory(Accesory $accesory)
    {
        $cart = session('cart_accessories', []);
        unset($cart[$accesory->id]);
        session(['cart_accessories' => $cart]);

        return back()->with('success', 'Accesorio eliminado del carrito.');
    }

    public function checkout(Request $request)
    {
        $cartBikes = session('cart', []);
        $cartAccessories = session('cart_accessories', []);

        if (empty($cartBikes) && empty($cartAccessories)) {
            return back()->with('success', 'Tu carrito está vacío.');
        }

        $request->validate([
            'metodo_pago' => 'required|in:tarjeta,yape_plin,efectivo',
            'card_nombre' => 'required_if:metodo_pago,tarjeta|string|max:191',
            'card_numero' => 'required_if:metodo_pago,tarjeta|string|max:25',
            'card_exp' => 'required_if:metodo_pago,tarjeta|string|max:10',
            'card_cvv' => 'required_if:metodo_pago,tarjeta|string|max:10',
        ]);

        try {
            DB::transaction(function () use ($cartBikes, $cartAccessories) {
                $user = Auth::user();

                $total = 0;

                $bicicletas = collect();
                if (!empty($cartBikes)) {
                    $bicicletas = Bicicleta::whereIn('id', array_keys($cartBikes))
                        ->lockForUpdate()
                        ->get();

                    if ($bicicletas->count() !== count($cartBikes)) {
                        throw new \RuntimeException('Algunas bicicletas ya no están disponibles.');
                    }

                    foreach ($bicicletas as $bici) {
                        $cantidad = $cartBikes[$bici->id];
                        $precioUnitario = $bici->precio_venta ?? 0;

                        if ($precioUnitario <= 0) {
                            throw new \RuntimeException('Hay bicicletas sin precio de venta configurado.');
                        }

                        if (($bici->estado !== 'disponible') || ($bici->stock < $cantidad)) {
                            throw new \RuntimeException("Stock insuficiente o no disponible: {$bici->nombre}");
                        }

                        $total += $precioUnitario * $cantidad;
                    }
                }

                $accesories = collect();
                if (!empty($cartAccessories)) {
                    $accesories = Accesory::whereIn('id', array_keys($cartAccessories))
                        ->lockForUpdate()
                        ->get();

                    if ($accesories->count() !== count($cartAccessories)) {
                        throw new \RuntimeException('Algunos accesorios ya no están disponibles.');
                    }

                    foreach ($accesories as $acc) {
                        $cantidad = $cartAccessories[$acc->id];
                        $precioUnitario = $acc->precio ?? 0;

                        if ($precioUnitario <= 0) {
                            throw new \RuntimeException('Hay accesorios sin precio configurado.');
                        }

                        if (($acc->estado !== 'disponible') || ($acc->stock < $cantidad)) {
                            throw new \RuntimeException("Stock insuficiente o no disponible: {$acc->nombre}");
                        }

                        $total += $precioUnitario * $cantidad;
                    }
                }

                $order = Order::create([
                    'user_id' => $user->id,
                    'total' => $total,
                ]);

                foreach ($bicicletas as $bici) {
                    $cantidad = $cartBikes[$bici->id];
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

                foreach ($accesories as $acc) {
                    $cantidad = $cartAccessories[$acc->id];
                    $precioUnitario = $acc->precio ?? 0;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'accesory_id' => $acc->id,
                        'cantidad' => $cantidad,
                        'precio_unitario' => $precioUnitario,
                        'subtotal' => $precioUnitario * $cantidad,
                    ]);

                    $acc->decrement('stock', $cantidad);
                }
            });
        } catch (\Throwable $e) {
            return back()->withErrors(['checkout' => $e->getMessage()]);
        }

        session()->forget('cart');
        session()->forget('cart_accessories');

        return redirect()->route('cart.historial')->with('success', 'Compra registrada correctamente.');
    }

    public function historial()
    {
        $orders = Order::with(['items.bicicleta', 'items.accesory'])
            ->where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        return view('cart.historial', compact('orders'));
    }
}

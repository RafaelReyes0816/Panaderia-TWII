<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleCompra;
use App\Models\Inventario;
use App\Models\Producto;

class DetalleCompraController extends Controller
{
    public function index()
    {
        $detalles = DetalleCompra::with(['compra', 'producto'])->get();
        return view('detalle_compra.index', compact('detalles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'compra_id' => 'required|exists:compras,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
        ]);

        $detalle = DetalleCompra::create($validated);

        Inventario::create([
            'producto_id' => $detalle->producto_id,
            'tipo_movimiento' => 'entrada',
            'cantidad' => $detalle->cantidad,
            'fecha' => now(),
            'observacion' => 'Compra registrada',
        ]);

        $producto = Producto::find($detalle->producto_id);
        if ($producto) {
            $producto->stock += $detalle->cantidad;
            $producto->save();
        }

        return redirect()->back()->with('success', 'Detalle de compra registrado y entrada en inventario creada.');
    }
}

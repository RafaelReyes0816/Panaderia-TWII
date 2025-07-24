<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleVenta;
use App\Models\Inventario;
use App\Models\Producto;

class DetalleVentaController extends Controller
{
    public function index()
    {
        $detalles = DetalleVenta::with(['venta', 'producto'])->get();
        return view('detalle_venta.index', compact('detalles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'venta_id' => 'required|exists:ventas,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'subtotal' => 'required|numeric|min:0',
        ]);

        $detalle = DetalleVenta::create($validated);

        Inventario::create([
            'producto_id' => $detalle->producto_id,
            'tipo_movimiento' => 'salida',
            'cantidad' => $detalle->cantidad,
            'fecha' => now(),
            'observacion' => 'Venta realizada',
        ]);

        $producto = Producto::find($detalle->producto_id);
        if ($producto) {
            $producto->stock = max(0, $producto->stock - $detalle->cantidad);
            $producto->save();
        }

        return redirect()->back()->with('success', 'Detalle de venta registrado y salida en inventario creada.');
    }
}

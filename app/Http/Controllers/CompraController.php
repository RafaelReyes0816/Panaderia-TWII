<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\DetalleCompra;
use App\Models\Inventario;

class CompraController extends Controller
{
    //tabla
    public function index(Request $request)
    {
        $query = \App\Models\Compra::with('proveedor');
        if ($request->filled('buscar')) {
            $query->whereHas('proveedor', function($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->buscar . '%');
            });
        }
        $compras = $query->orderByDesc('fecha')->paginate(5)->withQueryString();
        return view('compras.index', compact('compras'));
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        return view('compras.create', compact('proveedores', 'productos'));
    }

    //Validación
    public function store(Request $request)
    {
        $validated = $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
            'productos' => 'required|array|min:1',
            'productos.*' => 'exists:productos,id',
            'cantidades' => 'required|array|min:1',
            'cantidades.*' => 'integer|min:1',
            'precios_unitarios' => 'required|array|min:1',
            'precios_unitarios.*' => 'numeric|min:0',
        ]);

        //Crear la compra
        $compra = Compra::create([
            'proveedor_id' => $validated['proveedor_id'],
            'fecha' => $validated['fecha'],
            'total' => $validated['total'],
        ]);

        foreach ($validated['productos'] as $index => $productoId) {
            $cantidad = $validated['cantidades'][$index];
            $precioUnitario = $validated['precios_unitarios'][$index];
            $producto = Producto::find($productoId);
            
            if ($producto) {
                $detalle = DetalleCompra::create([
                    'compra_id' => $compra->id,
                    'producto_id' => $productoId,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precioUnitario,
                    'subtotal' => $precioUnitario * $cantidad,
                ]);
                Inventario::create([
                    'producto_id' => $productoId,
                    'tipo_movimiento' => 'entrada',
                    'cantidad' => $cantidad,
                    'fecha' => now(),
                    'observacion' => 'Compra #' . $compra->id,
                ]);

                $producto->stock += $cantidad;
                $producto->save();
            }
        }

        return redirect()->route('compras.index')->with('success', 'Compra creada correctamente.');
    }

    public function show(string $id)
    {
        $compra = Compra::with('proveedor')->findOrFail($id);
        return view('compras.show', compact('compra'));
    }

    public function edit(string $id)
    {
        $compra = Compra::findOrFail($id);
        $proveedores = Proveedor::all();
        return view('compras.edit', compact('compra', 'proveedores'));
    }
    
    public function update(Request $request, string $id)
    {
        $compra = Compra::findOrFail($id);
        $validated = $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
        ]);
        $compra->update($validated);
        return redirect()->route('compras.index')->with('success', 'Compra actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        $compra = Compra::findOrFail($id);
        $compra->delete();
        return redirect()->route('compras.index')->with('success', 'Compra eliminada correctamente.');
    }
}

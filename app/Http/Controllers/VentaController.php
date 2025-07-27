<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\DetalleVenta;
use App\Models\Inventario;

class VentaController extends Controller
{
    //Lista
    public function index(Request $request)
    {
        $query = \App\Models\Venta::with('cliente');
        if ($request->filled('buscar')) {
            $query->whereHas('cliente', function($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->buscar . '%');
            });
        }
        $ventas = $query->orderByDesc('fecha')->paginate(5)->withQueryString();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('ventas.create', compact('clientes', 'productos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => 'nullable|exists:clientes,id',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
            'productos' => 'required|array|min:1',
            'productos.*' => 'exists:productos,id',
            'cantidades' => 'required|array|min:1',
            'cantidades.*' => 'integer|min:1',
        ]);

        // Verificar stock disponible antes de procesar
        $productosSinStock = [];
        foreach ($validated['productos'] as $index => $productoId) {
            $cantidad = $validated['cantidades'][$index];
            $producto = Producto::find($productoId);
            
            if ($producto && $producto->stock < $cantidad) {
                $productosSinStock[] = $producto->nombre . ' (Stock: ' . $producto->stock . ', Solicitado: ' . $cantidad . ')';
            }
        }

        if (!empty($productosSinStock)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Stock insuficiente para: ' . implode(', ', $productosSinStock));
        }

        // Crear la venta
        $venta = Venta::create([
            'cliente_id' => $validated['cliente_id'],
            'fecha' => $validated['fecha'],
            'total' => $validated['total'],
        ]);

        // Procesar cada producto de la venta
        foreach ($validated['productos'] as $index => $productoId) {
            $cantidad = $validated['cantidades'][$index];
            $producto = Producto::find($productoId);
            
            if ($producto) {
                // Crear detalle de venta
                $detalle = DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $productoId,
                    'cantidad' => $cantidad,
                    'subtotal' => $producto->precio * $cantidad,
                ]);

                // Registrar movimiento de inventario (salida)
                Inventario::create([
                    'producto_id' => $productoId,
                    'tipo_movimiento' => 'salida',
                    'cantidad' => $cantidad,
                    'fecha' => now(),
                    'observacion' => 'Venta #' . $venta->id,
                ]);

                // Actualizar stock del producto
                $producto->stock = max(0, $producto->stock - $cantidad);
                $producto->save();
            }
        }

        return redirect()->route('ventas.index')->with('success', 'Venta creada correctamente.');
    }

    public function show(string $id)
    {
        $venta = Venta::with(['cliente', 'detalles.producto'])->findOrFail($id);
        return view('ventas.show', compact('venta'));
    }

    public function edit(string $id)
    {
        $venta = Venta::findOrFail($id);
        $clientes = Cliente::all();
        return view('ventas.edit', compact('venta', 'clientes'));
    }

    //Actualización
    public function update(Request $request, string $id)
    {
        $venta = Venta::findOrFail($id);
        $validated = $request->validate([
            'cliente_id' => 'nullable|exists:clientes,id',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
        ]);
        $venta->update($validated);
        return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        $venta = Venta::findOrFail($id);
        $venta->delete();
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente.');
    }
}

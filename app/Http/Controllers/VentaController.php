<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Producto;

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
        ]);
        Venta::create($validated);
        return redirect()->route('ventas.index')->with('success', 'Venta creada correctamente.');
    }

    public function show(string $id)
    {
        $venta = Venta::with('cliente')->findOrFail($id);
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

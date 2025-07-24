<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Proveedor;

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
        return view('compras.create', compact('proveedores'));
    }

    //Validación
    public function store(Request $request)
    {
        $validated = $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
        ]);
        Compra::create($validated);
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

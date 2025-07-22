<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Proveedor;

class CompraController extends Controller
{
    //Lista de compras
    public function index()
    {
        $compras = Compra::with('proveedor')->get();
        return view('compras.index', compact('compras'));
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        return view('compras.create', compact('proveedores'));
    }

    //Validaciones
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

    //Muestra una compra en específico
    public function show(string $id)
    {
        $compra = Compra::with('proveedor')->findOrFail($id);
        return view('compras.show', compact('compra'));
    }

    //Edición
    public function edit(string $id)
    {
        $compra = Compra::findOrFail($id);
        $proveedores = Proveedor::all();
        return view('compras.edit', compact('compra', 'proveedores'));
    }

    //Actualización
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Inventario;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{

    public function index(Request $request)
    {
        $query = \App\Models\Producto::query();
        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }
        $productos = $query->orderBy('nombre')->paginate(5)->withQueryString();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate(Producto::$rules);

        $validator = Validator::make($validated, [
            'nombre' => [
                'required',
                'string',
                'max:100',
                'min:2',
                function ($attribute, $value, $fail) {
                    if (trim($value) === '') {
                        $fail('El nombre del producto no puede estar vacío.');
                    }
                    
                    if (Producto::where('nombre', trim($value))->exists()) {
                        $fail('Ya existe un producto con este nombre.');
                    }
                },
            ],
            'precio' => [
                'required',
                'numeric',
                'min:0',
                'max:999999.99',
                function ($attribute, $value, $fail) {
                    if ($value <= 0) {
                        $fail('El precio debe ser mayor a 0.');
                    }
                },
            ],
            'stock' => [
                'required',
                'integer',
                'min:0',
                'max:999999',
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $ruta = $imagen->storeAs('productos', $nombreImagen, 'public');
            $validated['imagen'] = $ruta;
        }

        $producto = Producto::create($validated);

        if ($producto->stock > 0) {
            Inventario::create([
                'producto_id' => $producto->id,
                'tipo_movimiento' => 'entrada',
                'cantidad' => $producto->stock,
                'fecha' => now(),
                'observacion' => 'Alta de producto',
            ]);
        }

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    public function show(string $id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, string $id)
    {
        $producto = Producto::findOrFail($id);
        
        $validated = $request->validate(Producto::$rulesUpdate);

        $validator = Validator::make($validated, [
            'nombre' => [
                'sometimes',
                'required',
                'string',
                'max:100',
                'min:2',
                function ($attribute, $value, $fail) use ($producto) {
                    if (trim($value) === '') {
                        $fail('El nombre del producto no puede estar vacío.');
                    }
                    
                    if (Producto::where('nombre', trim($value))
                        ->where('id', '!=', $producto->id)
                        ->exists()) {
                        $fail('Ya existe otro producto con este nombre.');
                    }
                },
            ],
            'precio' => [
                'sometimes',
                'required',
                'numeric',
                'min:0',
                'max:999999.99',
                function ($attribute, $value, $fail) {
                    if ($value <= 0) {
                        $fail('El precio debe ser mayor a 0.');
                    }
                },
            ],
            'stock' => [
                'sometimes',
                'required',
                'integer',
                'min:0',
                'max:999999',
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $ruta = $imagen->storeAs('productos', $nombreImagen, 'public');
            $validated['imagen'] = $ruta;
        }

        $producto->update($validated);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}

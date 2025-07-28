<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Validator;

class ProveedorController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Proveedor::query();
        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }
        $proveedores = $query->orderBy('nombre')->paginate(5)->withQueryString();
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(Proveedor::$rules);

        $validator = Validator::make($validated, [
            'nombre' => [
                'required',
                'string',
                'max:100',
                'min:2',
                function ($attribute, $value, $fail) {
                    if (trim($value) === '') {
                        $fail('El nombre del proveedor no puede estar vacío.');
                    }
                    
                    if (Proveedor::where('nombre', trim($value))->exists()) {
                        $fail('Ya existe un proveedor con este nombre.');
                    }
                },
            ],
            'telefono' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[0-9\-\+\(\)\s]+$/',
                function ($attribute, $value, $fail) {
                    if ($value && strlen(trim($value)) < 7) {
                        $fail('El teléfono debe tener al menos 7 dígitos.');
                    }
                },
            ],
            'direccion' => [
                'nullable',
                'string',
                'max:255',
                'min:5',
                function ($attribute, $value, $fail) {
                    if ($value && trim($value) === '') {
                        $fail('La dirección no puede estar vacía si se proporciona.');
                    }
                },
            ],
            'contacto' => [
                'nullable',
                'string',
                'max:100',
                'min:2',
                function ($attribute, $value, $fail) {
                    if ($value && trim($value) === '') {
                        $fail('El contacto no puede estar vacío si se proporciona.');
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Proveedor::create($validated);
        return redirect()->route('proveedores.index')->with('success', 'Proveedor creado correctamente.');
    }

    public function show(string $id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('proveedores.show', compact('proveedor'));
    }

    public function edit(string $id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, string $id)
    {
        $proveedor = Proveedor::findOrFail($id);
        
        $validated = $request->validate(Proveedor::$rulesUpdate);

        $validator = Validator::make($validated, [
            'nombre' => [
                'sometimes',
                'required',
                'string',
                'max:100',
                'min:2',
                function ($attribute, $value, $fail) use ($proveedor) {
                    if (trim($value) === '') {
                        $fail('El nombre del proveedor no puede estar vacío.');
                    }
                    
                    if (Proveedor::where('nombre', trim($value))
                        ->where('id', '!=', $proveedor->id)
                        ->exists()) {
                        $fail('Ya existe otro proveedor con este nombre.');
                    }
                },
            ],
            'telefono' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[0-9\-\+\(\)\s]+$/',
                function ($attribute, $value, $fail) {
                    if ($value && strlen(trim($value)) < 7) {
                        $fail('El teléfono debe tener al menos 7 dígitos.');
                    }
                },
            ],
            'direccion' => [
                'nullable',
                'string',
                'max:255',
                'min:5',
                function ($attribute, $value, $fail) {
                    if ($value && trim($value) === '') {
                        $fail('La dirección no puede estar vacía si se proporciona.');
                    }
                },
            ],
            'contacto' => [
                'nullable',
                'string',
                'max:100',
                'min:2',
                function ($attribute, $value, $fail) {
                    if ($value && trim($value) === '') {
                        $fail('El contacto no puede estar vacío si se proporciona.');
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $proveedor->update($validated);
        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado correctamente.');
    }
}

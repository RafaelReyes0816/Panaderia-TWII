<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $query = Cliente::query();
        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }
        $clientes = $query->orderBy('nombre')->paginate(5)->withQueryString();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:100',
                'min:2',
                function ($attribute, $value, $fail) {
                    if (trim($value) === '') {
                        $fail('El nombre del cliente no puede estar vacío.');
                    }
                    
                    if (Cliente::where('nombre', trim($value))->exists()) {
                        $fail('Ya existe un cliente con este nombre.');
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
        ]);

        Cliente::create($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente.');
    }

    public function show(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    public function edit(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, string $id)
    {
        $cliente = Cliente::findOrFail($id);
        
        $request->validate([
            'nombre' => [
                'sometimes',
                'required',
                'string',
                'max:100',
                'min:2',
                function ($attribute, $value, $fail) use ($cliente) {
                    if (trim($value) === '') {
                        $fail('El nombre del cliente no puede estar vacío.');
                    }
                    
                    if (Cliente::where('nombre', trim($value))
                        ->where('id', '!=', $cliente->id)
                        ->exists()) {
                        $fail('Ya existe otro cliente con este nombre.');
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
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Producto;

class InventarioController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Inventario::with('producto');
        if ($request->filled('buscar')) {
            $query->whereHas('producto', function($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->buscar . '%');
            });
        }
        $inventario = $query->orderBy('producto_id')->paginate(7)->withQueryString();
        return view('inventario.index', compact('inventario'));
    }
}

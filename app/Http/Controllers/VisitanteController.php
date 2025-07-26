<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class VisitanteController extends Controller
{
    public function index()
    {
        $productosDestacados = Producto::where('stock', '<=', 10)
            ->where('stock', '>', 0)
            ->orderBy('stock', 'asc')
            ->take(6)
            ->get();

        return view('visitantes.index', compact('productosDestacados'));
    }

    public function productos()
    {
        $productos = Producto::where('stock', '>', 0)
            ->orderBy('nombre', 'asc')
            ->paginate(6);

        return view('visitantes.productos', compact('productos'));
    }

    public function contacto()
    {
        return view('visitantes.contacto');
    }
}

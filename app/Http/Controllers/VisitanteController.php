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

    public function productos(Request $request)
    {
        $query = Producto::where('stock', '>', 0);
        
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function($q) use ($buscar) {
                $q->where('nombre', 'like', '%' . $buscar . '%')
                  ->orWhere('descripcion', 'like', '%' . $buscar . '%');
            });
        }
        
        if ($request->filled('filtro_stock')) {
            switch ($request->filtro_stock) {
                case 'disponible':
                    $query->where('stock', '>', 10);
                    break;
                case 'pocas':
                    $query->whereBetween('stock', [6, 10]);
                    break;
                case 'agotado':
                    $query->where('stock', '<=', 5);
                    break;
            }
        }
        
        $productos = $query->orderBy('nombre', 'asc')->paginate(6)->withQueryString();

        return view('visitantes.productos', compact('productos'));
    }

    public function contacto()
    {
        return view('visitantes.contacto');
    }
}

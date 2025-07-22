<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;

class InventarioController extends Controller
{
    //Movimientos de inventario
    public function index()
    {
        $movimientos = Inventario::with('producto')->get();
        return view('inventario.index', compact('movimientos'));
    }
}

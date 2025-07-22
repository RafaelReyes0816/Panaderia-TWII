<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleCompra;

class DetalleCompraController extends Controller
{
    //Lista de detalles de compra
    public function index()
    {
        $detalles = DetalleCompra::with(['compra', 'producto'])->get();
        return view('detalle_compra.index', compact('detalles'));
    }
}

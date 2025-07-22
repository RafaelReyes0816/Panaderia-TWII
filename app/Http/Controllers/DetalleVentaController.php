<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleVenta;

class DetalleVentaController extends Controller
{
    //Detalles de venta
    public function index()
    {
        $detalles = DetalleVenta::with(['venta', 'producto'])->get();
        return view('detalle_venta.index', compact('detalles'));
    }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\HTTP\Controllers\ProveedorController;
use App\HTTP\Controllers\CompraController;
use App\HTTP\Controllers\VentaController;


use App\HTTP\Controllers\DetalleVentaController;
use App\HTTP\Controllers\DetalleCompraController;
use App\HTTP\Controllers\InventarioController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('productos', ProductoController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('proveedores', ProveedorController::class);
Route::resource('compras', CompraController::class);
Route::resource('ventas', VentaController::class);

Route::get('detalle-compras', [DetalleCompraController::class, 'index'])->name('detalle-compras.index');
Route::get('detalle-ventas', [DetalleVentaController::class, 'index'])->name('detalle-ventas.index');
Route::get('inventario', [InventarioController::class, 'index'])->name('inventario.index');
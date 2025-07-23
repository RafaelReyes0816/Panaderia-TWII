<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\DetalleCompraController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\PrestamoController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Rutas personalizadas para productos
Route::get('/', [ProductoController::class, 'index']);
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/crear', [ProductoController::class, 'create'])->name('productos.create');
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
Route::get('/productos/{id}/editar', [ProductoController::class, 'edit'])->name('productos.edit');
Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');


// Rutas personalizadas para proveedores
Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
Route::get('/proveedores/crear', [ProveedorController::class, 'create'])->name('proveedores.create');
Route::post('/proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');
Route::get('/proveedores/{id}/editar', [ProveedorController::class, 'edit'])->name('proveedores.edit');
Route::put('/proveedores/{id}', [ProveedorController::class, 'update'])->name('proveedores.update');
Route::delete('/proveedores/{id}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');


// Rutas personalizadas para compras
Route::get('/compras', [CompraController::class, 'index'])->name('compras.index');
Route::get('/compras/crear', [CompraController::class, 'create'])->name('compras.create');
Route::post('/compras', [CompraController::class, 'store'])->name('compras.store');
Route::get('/compras/{id}/editar', [CompraController::class, 'edit'])->name('compras.edit');
Route::put('/compras/{id}', [CompraController::class, 'update'])->name('compras.update');
Route::delete('/compras/{id}', [CompraController::class, 'destroy'])->name('compras.destroy');


// Rutas personalizadas para ventas
Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
Route::get('/ventas/crear', [VentaController::class, 'create'])->name('ventas.create');
Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
Route::get('/ventas/{id}/editar', [VentaController::class, 'edit'])->name('ventas.edit');
Route::put('/ventas/{id}', [VentaController::class, 'update'])->name('ventas.update');
Route::delete('/ventas/{id}', [VentaController::class, 'destroy'])->name('ventas.destroy');



Route::get('detalle-compras', [DetalleCompraController::class, 'index'])->name('detalle-compras.index');
Route::get('detalle-ventas', [DetalleVentaController::class, 'index'])->name('detalle-ventas.index');
Route::get('inventario', [InventarioController::class, 'index'])->name('inventario.index');
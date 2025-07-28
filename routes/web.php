<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\DetalleCompraController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\VisitanteController;
use App\Http\Controllers\Auth\AuthController;

use App\Models\DetalleVenta;
use App\Models\DetalleCompra;

Route::middleware('auth')->group(function () {
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/crear', [ProductoController::class, 'create'])->name('productos.create');
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');
Route::get('/productos/{id}/editar', [ProductoController::class, 'edit'])->name('productos.edit');
Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');

Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
Route::get('/proveedores/crear', [ProveedorController::class, 'create'])->name('proveedores.create');
Route::post('/proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');
Route::get('/proveedores/{id}', [ProveedorController::class, 'show'])->name('proveedores.show');
Route::get('/proveedores/{id}/editar', [ProveedorController::class, 'edit'])->name('proveedores.edit');
Route::put('/proveedores/{id}', [ProveedorController::class, 'update'])->name('proveedores.update');
Route::delete('/proveedores/{id}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');

Route::get('/compras', [CompraController::class, 'index'])->name('compras.index');
Route::get('/compras/crear', [CompraController::class, 'create'])->name('compras.create');
Route::post('/compras', [CompraController::class, 'store'])->name('compras.store');
Route::get('/compras/{id}', [CompraController::class, 'show'])->name('compras.show');
Route::get('/compras/{id}/editar', [CompraController::class, 'edit'])->name('compras.edit');
Route::put('/compras/{id}', [CompraController::class, 'update'])->name('compras.update');
Route::delete('/compras/{id}', [CompraController::class, 'destroy'])->name('compras.destroy');

Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
Route::get('/ventas/crear', [VentaController::class, 'create'])->name('ventas.create');
Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
Route::get('/ventas/{id}', [VentaController::class, 'show'])->name('ventas.show');
Route::get('/ventas/{id}/editar', [VentaController::class, 'edit'])->name('ventas.edit');
Route::put('/ventas/{id}', [VentaController::class, 'update'])->name('ventas.update');
Route::delete('/ventas/{id}', [VentaController::class, 'destroy'])->name('ventas.destroy');

Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
Route::get('/clientes/crear', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('/clientes/{id}', [ClienteController::class, 'show'])->name('clientes.show');
Route::get('/clientes/{id}/editar', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('clientes.update');
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

Route::get('/inventario', [InventarioController::class, 'index'])->name('inventario.index');

Route::get('detalle-compras', [DetalleCompraController::class, 'index'])->name('detalle-compras.index');
Route::get('detalle-ventas', [DetalleVentaController::class, 'index'])->name('detalle-ventas.index');

Route::get('/detalles', function (\Illuminate\Http\Request $request) {
    $tipo = $request->query('tipo', 'venta');
    $detallesVenta = collect();
    $detallesCompra = collect();
    if ($tipo === 'venta') {
        $detallesVenta = \App\Models\DetalleVenta::with(['venta', 'producto'])->paginate(5);
    } elseif ($tipo === 'compra') {
        $detallesCompra = \App\Models\DetalleCompra::with(['compra', 'producto'])->paginate(5);
    }
    return view('detalles', compact('detallesVenta', 'detallesCompra'));
})->name('detalles.index');
});

Route::get('/', [VisitanteController::class, 'index'])->name('inicio');
Route::get('/menu', [VisitanteController::class, 'productos'])->name('visitantes.menu');
Route::get('/contacto', [VisitanteController::class, 'contacto'])->name('visitantes.contacto');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
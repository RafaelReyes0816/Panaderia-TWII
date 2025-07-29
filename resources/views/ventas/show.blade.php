@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Detalles de la Venta #{{ $venta->id }}</h2>
                <div>
                    <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Volver</a>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Información de la Venta</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Cliente:</strong> {{ $venta->cliente->nombre ?? 'Cliente no especificado' }}</p>
                            <p><strong>Fecha:</strong> {{ $venta->fecha }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Total:</strong> Bs {{ number_format($venta->total, 2) }}</p>
                            <p><strong>ID de Venta:</strong> {{ $venta->id }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Productos Vendidos</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($venta->detalles as $detalle)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($detalle->producto)
                                                <strong>{{ $detalle->producto->nombre }}</strong>
                                                <br>
                                                <small class="text-muted">ID: {{ $detalle->producto_id }}</small>
                                            @else
                                                <span class="text-danger">Producto no encontrado (ID: {{ $detalle->producto_id }})</span>
                                            @endif
                                        </td>
                                        <td>{{ $detalle->cantidad }}</td>
                                        <td>Bs {{ number_format($detalle->producto ? $detalle->producto->precio : 0, 2) }}</td>
                                        <td>Bs {{ number_format($detalle->subtotal, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No hay productos en esta venta.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
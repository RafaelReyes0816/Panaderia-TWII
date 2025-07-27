@extends('layouts.app')

@section('content')
<div class="container p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Detalles de Ventas</h2>
        <a href="{{ route('detalles.index') }}" class="btn btn-secondary">Volver a Detalles</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Venta ID</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @forelse($detalles as $detalle)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $detalle->venta_id }}</td>
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
                        <td>Bs {{ number_format($detalle->subtotal, 2) }}</td>
                        <td>{{ $detalle->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay detalles de ventas registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection 
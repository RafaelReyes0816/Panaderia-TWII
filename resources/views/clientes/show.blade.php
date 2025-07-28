@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Detalles del Cliente</h2>
        <div>
            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning">Editar Cliente</a>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Información del Cliente</h5>
                    <table class="table table-borderless">
                        <tr>
                            <th width="150">ID:</th>
                            <td>{{ $cliente->id }}</td>
                        </tr>
                        <tr>
                            <th>Nombre:</th>
                            <td>{{ $cliente->nombre }}</td>
                        </tr>
                        <tr>
                            <th>Teléfono:</th>
                            <td>{{ $cliente->telefono ?? 'No especificado' }}</td>
                        </tr>
                        <tr>
                            <th>Dirección:</th>
                            <td>{{ $cliente->direccion ?? 'No especificada' }}</td>
                        </tr>
                        <tr>
                            <th>Fecha de Registro:</th>
                            <td>{{ $cliente->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Última Actualización:</th>
                            <td>{{ $cliente->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5 class="card-title">Estadísticas</h5>
                    <div class="row">
                        <div class="col-6">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h4>{{ $cliente->ventas->count() }}</h4>
                                    <p class="mb-0">Ventas Realizadas</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h4>Bs {{ number_format($cliente->ventas->sum('total'), 2) }}</h4>
                                    <p class="mb-0">Total Compras</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($cliente->ventas->count() > 0)
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Historial de Ventas</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cliente->ventas as $venta)
                                <tr>
                                    <td>{{ $venta->id }}</td>
                                    <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                                    <td>Bs {{ number_format($venta->total, 2) }}</td>
                                    <td>
                                        <span class="badge bg-success">Completada</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-info btn-sm">Ver Detalles</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info mt-4">
            <i class="fas fa-info-circle me-2"></i>
            Este cliente aún no ha realizado ninguna compra.
        </div>
    @endif
@endsection 
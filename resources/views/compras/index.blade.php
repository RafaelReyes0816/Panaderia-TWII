@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Listado de Compras</h1>
    <a href="{{ route('compras.create') }}" class="btn btn-success mb-3">Registrar Compra</a>

    <form method="GET" action="{{ route('compras.index') }}" class="mb-3">
        <div class="input-group" style="max-width: 350px;">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar por proveedor..." value="{{ request('buscar') }}">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle" style="padding: 1rem;">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Proveedor</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($compras as $compra)
                    <tr>
                        <td>{{ $compra->id }}</td>
                        <td>{{ $compra->proveedor->nombre ?? '' }}</td>
                        <td>{{ $compra->fecha }}</td>
                        <td>Bs {{ number_format($compra->total, 2) }}</td>
                        <td>
                            <a href="{{ route('compras.show', $compra->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('compras.edit', $compra->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('compras.destroy', $compra->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta compra?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No hay compras registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $compras->links('pagination::bootstrap-5') }}
    </div>
@endsection 
@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Ventas</h2>
        <a href="{{ route('ventas.create') }}" class="btn btn-success">Registrar Venta</a>
    </div>

    <form method="GET" action="{{ route('ventas.index') }}" class="mb-3">
        <div class="input-group" style="max-width: 350px;">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar por cliente..." value="{{ request('buscar') }}">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle" style="padding: 1rem;">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ventas as $venta)
                    <tr>
                        <td>{{ ($ventas->currentPage() - 1) * $ventas->perPage() + $loop->iteration }}</td>
                        <td>{{ $venta->cliente->nombre ?? '' }}</td>
                        <td>{{ $venta->fecha }}</td>
                        <td>{{ $venta->total }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No hay ventas registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $ventas->links('pagination::bootstrap-5') }}
    </div>
@endsection 
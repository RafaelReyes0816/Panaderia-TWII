@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Inventario</h2>
    </div>

    <form method="GET" action="{{ route('inventario.index') }}" class="mb-3">
        <div class="input-group" style="max-width: 350px;">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar por producto..." value="{{ request('buscar') }}">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle" style="padding: 1rem;">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Tipo de movimiento</th>
                    <th>Cantidad</th>
                    <th>Fecha</th>
                    <th>Observación</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inventario as $item)
                    <tr>
                        <td>{{ ($inventario->currentPage() - 1) * $inventario->perPage() + $loop->iteration }}</td>
                        <td>{{ $item->producto->nombre ?? '' }}</td>
                        <td>
                            @if($item->tipo_movimiento === 'entrada')
                                <span class="badge bg-success">Entrada</span>
                            @else
                                <span class="badge bg-danger">Salida</span>
                            @endif
                        </td>
                        <td>{{ $item->cantidad }}</td>
                        <td>{{ $item->fecha }}</td>
                        <td>{{ $item->observacion }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay movimientos de inventario.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $inventario->links('pagination::bootstrap-5') }}
    </div>
@endsection

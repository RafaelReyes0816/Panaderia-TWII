@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Listado de Ventas</h1>
    <a href="{{ route('ventas.create') }}" class="btn btn-success mb-3">Registrar Venta</a>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
                    <td>{{ $venta->cliente->nombre ?? '' }}</td>
                    <td>{{ $venta->fecha }}</td>
                    <td>{{ $venta->total }}</td>
                    <td>
                        <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection 
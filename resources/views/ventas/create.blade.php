@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Registrar Venta</h1>
    <form action="{{ route('ventas.store') }}" method="POST" class="card p-4">
        @csrf
        <div class="mb-3">
            <label class="form-label">Cliente:</label>
            <select name="cliente_id" class="form-control">
                <option value="">Seleccione un cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                @endforeach
            </select>
            @error('cliente_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha:</label>
            <input type="date" name="fecha" value="{{ old('fecha') }}" class="form-control">
            @error('fecha') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Total:</label>
            <input type="number" step="0.01" name="total" value="{{ old('total') }}" class="form-control">
            @error('total') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection 
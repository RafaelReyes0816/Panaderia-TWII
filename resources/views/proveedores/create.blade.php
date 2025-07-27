@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Crear Proveedor</h1>
    <form action="{{ route('proveedores.store') }}" method="POST" class="card p-4">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control">
            @error('nombre') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Teléfono:</label>
            <input type="text" name="telefono" value="{{ old('telefono') }}" class="form-control">
            @error('telefono') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Dirección:</label>
            <textarea name="direccion" class="form-control" rows="3" placeholder="Ingrese la dirección completa del proveedor">{{ old('direccion') }}</textarea>
            @error('direccion') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Contacto:</label>
            <input type="text" name="contacto" value="{{ old('contacto') }}" class="form-control">
            @error('contacto') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection 
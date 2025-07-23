@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Editar Proveedor</h1>
    <form action="{{ route('proveedores.update', $proveedor->id) }}" method="POST" class="card p-4">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" name="nombre" value="{{ old('nombre', $proveedor->nombre) }}" class="form-control">
            @error('nombre') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Teléfono:</label>
            <input type="text" name="telefono" value="{{ old('telefono', $proveedor->telefono) }}" class="form-control">
            @error('telefono') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Dirección:</label>
            <input type="text" name="direccion" value="{{ old('direccion', $proveedor->direccion) }}" class="form-control">
            @error('direccion') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Contacto:</label>
            <input type="text" name="contacto" value="{{ old('contacto', $proveedor->contacto) }}" class="form-control">
            @error('contacto') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection 
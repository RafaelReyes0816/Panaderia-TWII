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
            <label class="form-label">Email:</label>
            <input type="email" name="email" value="{{ old('email', $proveedor->email) }}" class="form-control">
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection 
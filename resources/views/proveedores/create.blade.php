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
            <label class="form-label">Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection 
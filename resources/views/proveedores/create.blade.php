@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Crear Proveedor</h1>
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    <form action="{{ route('proveedores.store') }}" method="POST" class="card p-4">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nombre: <span class="text-danger">*</span></label>
            <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control" required maxlength="100">
        </div>
        <div class="mb-3">
            <label class="form-label">Teléfono: <span class="text-danger">*</span></label>
            <input type="text" name="telefono" value="{{ old('telefono') }}" class="form-control" required maxlength="20">
        </div>
        <div class="mb-3">
            <label class="form-label">Dirección:</label>
            <textarea name="direccion" class="form-control" rows="3" placeholder="Ingrese la dirección completa del proveedor" maxlength="255">{{ old('direccion') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Contacto:</label>
            <input type="text" name="contacto" value="{{ old('contacto') }}" class="form-control" maxlength="100">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection 
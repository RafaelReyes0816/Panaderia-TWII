@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Crear Producto</h1>
    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" class="card p-4">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control">
            @error('nombre') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Precio:</label>
            <input type="number" name="precio" value="{{ old('precio') }}" class="form-control">
            @error('precio') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción:</label>
            <input type="text" name="descripcion" value="{{ old('descripcion') }}" class="form-control">
            @error('descripcion') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Stock:</label>
            <input type="number" name="stock" value="{{ old('stock') }}" class="form-control">
            @error('stock') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Imagen:</label>
            <div class="custom-file">
                <input type="file" name="imagen" class="custom-file-input" id="imagenInput" accept="image/*" style="display:none;" onchange="document.getElementById('imagenLabel').innerText = this.files[0]?.name || 'Ningún archivo seleccionado';">
                <button type="button" class="btn btn-primary" style="background-color: #6B3F1D; color: #FFD700; border: none;" onclick="document.getElementById('imagenInput').click();">
                    Seleccionar imagen
                </button>
                <span id="imagenLabel" class="ms-2 text-muted">Ningún archivo seleccionado</span>
            </div>
            @error('imagen') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection 
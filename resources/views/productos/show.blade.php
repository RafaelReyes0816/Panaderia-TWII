@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Detalles del Producto</h2>
                    <div>
                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-primary">Editar</a>
                        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                @if($producto->imagen)
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" 
                                         alt="{{ $producto->nombre }}" 
                                         class="img-fluid rounded" 
                                         style="width: 100%; max-width: 300px; height: auto;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                                         style="width: 100%; max-width: 300px; height: 200px; border: 1px solid #dee2e6;">
                                        <i class="fas fa-image text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <h3 class="card-title">{{ $producto->nombre }}</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p><strong>Precio:</strong> Bs {{ number_format($producto->precio, 2) }}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p>
                                            <strong>Stock:</strong> 
                                            <span class="badge {{ $producto->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $producto->stock }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <p><strong>Descripción:</strong></p>
                                        <p class="text-muted">{{ $producto->descripcion ?: 'Sin descripción' }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p><strong>ID del Producto:</strong> {{ $producto->id }}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p><strong>Creado:</strong> {{ $producto->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <p><strong>Última actualización:</strong> {{ $producto->updated_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 
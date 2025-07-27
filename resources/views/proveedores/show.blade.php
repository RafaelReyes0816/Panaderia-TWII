@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Detalles del Proveedor</h2>
                    <div>
                        <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-primary">Editar</a>
                        <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h3 class="card-title">{{ $proveedor->nombre }}</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p><strong>Teléfono:</strong> {{ $proveedor->telefono ?: 'No especificado' }}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p><strong>Contacto:</strong> {{ $proveedor->contacto ?: 'No especificado' }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <p><strong>Dirección:</strong></p>
                                        <p class="text-muted">{{ $proveedor->direccion ?: 'No especificada' }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p><strong>ID del Proveedor:</strong> {{ $proveedor->id }}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p><strong>Creado:</strong> {{ $proveedor->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <p><strong>Última actualización:</strong> {{ $proveedor->updated_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <i class="fas fa-building fa-3x text-muted mb-3"></i>
                                        <h5 class="card-title">Información del Proveedor</h5>
                                        <p class="card-text">Este proveedor puede ser utilizado para realizar compras en el sistema.</p>
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
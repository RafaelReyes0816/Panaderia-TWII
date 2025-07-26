@extends('layouts.public')

@section('title', 'PAN Y PUNTO - Productos Frescos')

@section('content')
<div class="row">
    <div class="col-12 text-center py-5">
        <h1 class="display-4 fw-bold mb-4">¡Productos Frescos que se Agotan Rápido!</h1>
        <p class="lead mb-4">Descubre nuestros productos más populares que vuelan de los estantes</p>
        <div class="alert alert-warning" role="alert">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>¡Últimas unidades disponibles!</strong> No te quedes sin tus favoritos.
        </div>
    </div>

    <!-- Productos mostrados por bajo stock -->
    <div class="col-12 mb-5">
        <h2 class="text-center mb-5">Productos Destacados</h2>
        <div class="row">
            @forelse($productosDestacados as $producto)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3">{{ $producto->nombre }}</h5>
                        <p class="card-text mb-3">{{ $producto->descripcion }}</p>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="h5 text-success mb-0">Bs {{ number_format($producto->precio, 2) }}</span>
                            @if($producto->stock <= 5)
                                <span class="badge bg-danger">¡Solo {{ $producto->stock }} disponibles!</span>
                            @elseif($producto->stock <= 10)
                                <span class="badge bg-warning text-dark">Pocas unidades</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer bg-transparent p-3">
                        <small class="text-muted">
                            <i class="fas fa-clock"></i> Horario: 8:00 AM - 19:00 PM
                        </small>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <div class="alert alert-info p-4">
                    <i class="fas fa-info-circle"></i>
                    Próximamente más productos frescos disponibles.
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <div class="col-12 text-center mb-5">
        <div class="bg-light p-5 rounded">
            <h3 class="mb-4">¿Quieres ver todos nuestros productos?</h3>
            <p class="mb-4">Explora nuestra completa selección de panes frescos y pastelería</p>
            <a href="{{ route('visitantes.menu') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-bread-slice"></i> Ver Todos los Productos
            </a>
        </div>
    </div>

    <div class="col-12 py-5" id="contacto">
        <div class="row">
            <div class="col-md-6 mb-4">
                <h3 class="mb-4"><i class="fas fa-map-marker-alt"></i> Ubicación</h3>
                <p class="mb-3"><strong>PAN Y PUNTO</strong><br>
                Calle Principal #123<br>
                Ciudad, Estado 12345</p>
                
                <h3 class="mb-4"><i class="fas fa-clock"></i> Horarios</h3>
                <p><strong>Lunes a Domingo:</strong><br>
                8:00 AM - 19:00 PM</p>
            </div>
            <div class="col-md-6 mb-4">
                <h3 class="mb-4"><i class="fas fa-phone"></i> Contacto</h3>
                <p class="mb-3"><strong>Teléfono:</strong> (123) 456-7890<br>
                <strong>WhatsApp:</strong> +1 (123) 456-7890<br>
                <strong>Email:</strong> info@panypunto.com</p>
                
                <h3 class="mb-4"><i class="fas fa-star"></i> ¿Por qué elegirnos?</h3>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-check text-success"></i> Productos frescos todos los días</li>
                    <li class="mb-2"><i class="fas fa-check text-success"></i> Recetas tradicionales</li>
                    <li class="mb-2"><i class="fas fa-check text-success"></i> Atención personalizada</li>
                    <li class="mb-2"><i class="fas fa-check text-success"></i> Calidad garantizada</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

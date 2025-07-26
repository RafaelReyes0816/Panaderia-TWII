@extends('layouts.public')

@section('title', 'PAN Y PUNTO - Nuestros Productos')

@section('content')
<div class="row">
    <div class="col-12 text-center mb-4">
        <h1 class="display-4 fw-bold mb-3">Nuestros Productos Frescos</h1>
        <p class="lead mb-3">Descubre nuestra completa selección de panes, pasteles y dulces artesanales</p>
    </div>

    <div class="col-12 mb-4">
        <div class="card p-3">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <label for="buscar" class="form-label">Buscar producto:</label>
                    <input type="text" class="form-control" id="buscar" placeholder="Escribe el nombre del producto...">
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="row">
            @forelse($productos as $producto)
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body p-2">
                        <div class="text-center mb-2">
                            <i class="fas fa-bread-slice fa-2x text-warning"></i>
                        </div>
                        <h5 class="card-title text-center mb-2">{{ $producto->nombre }}</h5>
                        <p class="card-text text-muted text-center mb-2">{{ $producto->descripcion }}</p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="h5 text-success fw-bold mb-0">Bs {{ number_format($producto->precio, 2) }}</span>
                            @if($producto->stock <= 5)
                                <span class="badge bg-danger">¡Solo {{ $producto->stock }} disponibles!</span>
                            @elseif($producto->stock <= 10)
                                <span class="badge bg-warning text-dark">Pocas unidades</span>
                            @else
                                <span class="badge bg-success">Disponible</span>
                            @endif
                        </div>
                        
                        <div class="text-center">
                            <small class="text-muted">
                                <i class="fas fa-box"></i> Stock: {{ $producto->stock }} unidades
                            </small>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 text-center p-2">
                        <button class="btn btn-outline-primary btn-sm" onclick="contactarProducto('{{ $producto->nombre }}')">
                            <i class="fas fa-phone"></i> Consultar
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <div class="alert alert-info p-3">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <h4>No hay productos disponibles en este momento</h4>
                    <p>Próximamente tendremos más productos frescos para ti.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <div class="col-12 mt-4">
        <div class="d-flex justify-content-center">
            {{ $productos->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <div class="col-12 mt-4">
        <div class="card p-3 bg-light">
            <div class="row">
                <div class="col-md-8">
                    <h3><i class="fas fa-shopping-cart"></i> ¿Cómo hacer tu pedido?</h3>
                    <p class="mb-3">Para realizar tu pedido, puedes contactarnos de las siguientes maneras:</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone text-success"></i> <strong>Teléfono:</strong> (123) 456-7890</li>
                        <li><i class="fab fa-whatsapp text-success"></i> <strong>WhatsApp:</strong> +1 (123) 456-7890</li>
                        <li><i class="fas fa-envelope text-success"></i> <strong>Email:</strong> pedidos@panypunto.com</li>
                    </ul>
                </div>
                <div class="col-md-4 text-center">
                    <div class="alert alert-warning">
                        <i class="fas fa-clock fa-2x mb-2"></i>
                        <h5>Horario de atención</h5>
                        <p class="mb-0">Lunes a Domingo<br>8:00 AM - 19:00 PM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .pagination .page-link {
        color: #6B3F1D;
        background-color: #FFF8E7;
        border-color: #F9C846;
    }
    .pagination .page-link:hover {
        color: #FFF8E7;
        background-color: #6B3F1D;
        border-color: #6B3F1D;
    }
    .pagination .page-item.active .page-link {
        background-color: #6B3F1D;
        border-color: #6B3F1D;
        color: #FFD700;
    }
</style>
@endpush

@push('scripts')
<script>
function contactarProducto(nombre) {
    const mensaje = `Hola, me interesa el producto: ${nombre}. ¿Podrían darme más información?`;
    const whatsapp = `https://wa.me/11234567890?text=${encodeURIComponent(mensaje)}`;
    window.open(whatsapp, '_blank');
}

//búsqueda
document.addEventListener('DOMContentLoaded', function() {
    const buscarInput = document.getElementById('buscar');
    const productos = document.querySelectorAll('.col-lg-4.col-md-6');
    
    buscarInput.addEventListener('input', function() {
        const busqueda = this.value.toLowerCase().trim();
        
        productos.forEach(producto => {
            const nombre = producto.querySelector('.card-title').textContent.toLowerCase();
            const descripcion = producto.querySelector('.card-text').textContent.toLowerCase();
            
            if (nombre.includes(busqueda) || descripcion.includes(busqueda)) {
                producto.style.display = 'block';
            } else {
                producto.style.display = 'none';
            }
        });
    });
});
</script>
@endpush

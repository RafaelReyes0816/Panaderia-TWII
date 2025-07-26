@extends('layouts.public')

@section('title', 'PAN Y PUNTO - Contacto')

@section('content')
<div class="row">
    <div class="col-12 text-center mb-4">
        <h1 class="display-4 fw-bold mb-3">Contáctanos</h1>
        <p class="lead mb-3">Estamos aquí para atenderte. ¡No dudes en contactarnos!</p>
    </div>

    <div class="col-12 mb-4">
        <div class="card p-3">
            <div class="row">
                <!-- Ubicación -->
                <div class="col-md-6 mb-4">
                    <h3 class="mb-4"><i class="fas fa-map-marker-alt text-primary"></i> Ubicación</h3>
                    <p class="mb-3">
                        <strong>PAN Y PUNTO</strong><br>
                        Calle Principal #123<br>
                        Ciudad, Estado 12345<br>
                        Bolivia
                    </p>
                </div>
                <div class="col-md-6 mb-4">
                    <h3 class="mb-4"><i class="fas fa-clock text-primary"></i> Horarios de Atención</h3>
                    <p><strong>Lunes a Domingo:</strong><br>
                    8:00 AM - 19:00 PM</p>
                </div>
                <div class="col-md-6 mb-4">
                    <h3 class="mb-4"><i class="fas fa-phone text-primary"></i> Teléfono</h3>
                    <p class="mb-3">
                        <i class="fas fa-phone text-success"></i> <strong>Teléfono:</strong><br>
                        (591) 123-456-789
                    </p>
                    <p class="mb-3">
                        <i class="fas fa-envelope text-success"></i> <strong>Email:</strong><br>
                        info@panypunto.com
                    </p>
                </div>

                <div class="col-md-6 mb-4">
                    <h3 class="mb-4"><i class="fab fa-whatsapp text-success"></i> WhatsApp</h3>
                    <p class="mb-3">
                        <i class="fab fa-whatsapp text-success"></i> <strong>WhatsApp:</strong><br>
                        +591 123-456-789
                    </p>
                    <p class="mb-3">
                        <i class="fab fa-facebook text-primary"></i> <strong>Facebook:</strong><br>
                        @panypunto
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 text-center mt-4">
        <div class="alert alert-info">
            <h4><i class="fab fa-whatsapp"></i> ¿Necesitas ayuda inmediata?</h4>
            <p class="mb-3">Escríbenos por WhatsApp para una respuesta más rápida.</p>
            <a href="https://wa.me/591123456789" class="btn btn-success" target="_blank">
                <i class="fab fa-whatsapp"></i> WhatsApp
            </a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

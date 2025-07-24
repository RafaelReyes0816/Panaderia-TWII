@extends('layouts.app')

@section('content')
    <div class="text-center py-5">
        <h1 class="display-4 mb-4">¡Bienvenido!</h1>
        <p class="lead mb-4">Sistema de gestión para administrar productos, clientes, proveedores, compras y ventas de tu panadería.</p>
        
        <div id="bannerCarrusel" class="carousel slide mb-5" data-bs-ride="carousel">
            <div class="carousel-inner rounded shadow">
                <div class="carousel-item active">
                    <img src="{{ asset('PanaderiaComrpimida.webp') }}" class="d-block w-100" style="max-height: 300px; object-fit: cover;" alt="Banner 1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('Panaderia2Comprimida.webp') }}" class="d-block w-100" style="max-height: 300px; object-fit: cover;" alt="Banner 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('Panaderia3Comprimida.webp') }}" class="d-block w-100" style="max-height: 300px; object-fit: cover;" alt="Banner 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarrusel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#bannerCarrusel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
        
    </div>
@endsection 
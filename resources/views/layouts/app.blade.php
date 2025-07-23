<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panadería</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
    <style>
        body {
            background-color: #FFF8E7;
            color: #6B3F1D;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        header, footer {
            background-color: #B88B4A !important;
            color: #6B3F1D !important;
        }
        header h1, footer p {
            color: #6B3F1D;
        }
        nav a.btn {
            background-color: #F9C846;
            color: #6B3F1D;
            border: none;
            margin-right: 10px;
            font-weight: bold;
            transition: background 0.2s, color 0.2s;
        }
        nav a.btn:last-child {
            margin-right: 0;
        }
        nav a.btn:hover {
            background-color: #6B3F1D;
            color: #FFD700;
        }
        main.container {
            background: #FFFFFF;
            border-radius: 10px;
            box-shadow: 0 2px 8px #b88b4a33;
            padding: 2rem;
        }
        h1, h2, h3, h4, h5, h6 {
            color: #6B3F1D;
        }
        .table thead {
            background-color: #6B3F1D;
            color: #FFD700;
        }
        .table tbody tr:nth-child(even) {
            background-color: #FFF8E7;
        }
        .table tbody tr:nth-child(odd) {
            background-color: #FFFFFF;
        }
        .btn-primary, .btn-success {
            background-color: #6B3F1D !important;
            color: #FFD700 !important;
            border: none;
        }
        .btn-primary:hover, .btn-success:hover {
            background-color: #F9C846 !important;
            color: #6B3F1D !important;
        }
        .btn-danger {
            background-color: #B88B4A !important;
            color: #FFF8E7 !important;
            border: none;
        }
        .btn-danger:hover {
            background-color: #6B3F1D !important;
            color: #FFD700 !important;
        }
    </style>
</head>
<body>
    <header class="p-3 mb-4">
        <div class="container">
            <h1>Panadería</h1>
            <nav>
                <a class="btn btn-light me-2" href="{{ url('/') }}">Inicio</a>
                <a class="btn btn-light me-2" href="{{ route('productos.index') }}">Productos</a>
                <a class="btn btn-light me-2" href="{{ route('proveedores.index') }}">Proveedores</a>
                <a class="btn btn-light me-2" href="{{ route('compras.index') }}">Compras</a>
                <a class="btn btn-light" href="{{ route('ventas.index') }}">Ventas</a>
                <a class="btn btn-light" href="{{ route('clientes.index') }}">Clientes</a>
                <a class="btn btn-light" href="{{ route('inventario.index') }}">Inventario</a>
            </nav>
        </div>
    </header>

    <main class="container mb-5" style="min-height: 70vh;">
        @yield('content')
    </main>

    <footer class="text-center py-3">
        <p>&copy; {{ date('Y') }} Panadería. Todos los derechos reservados.</p>
    </footer>
    @stack('scripts')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

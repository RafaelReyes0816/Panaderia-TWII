<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PAN Y PUNTO</title>
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
        .logo-container {
            transition: transform 0.2s ease;
        }
        .logo-container:hover {
            transform: scale(1.05);
        }
        .logo-container img {
            filter: drop-shadow(0 2px 4px rgba(139, 69, 19, 0.3));
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #8B4513;
        }
    </style>
</head>
<body>
    <header class="p-3 mb-4">
        <div class="container">
            <nav class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <a href="{{ route('inicio') }}" class="me-3 logo-container">
                        <img src="{{ asset('images/WhatsApp Image 2025-07-28 at 3.55.10 PM.jpeg') }}" alt="PAN Y PUNTO" style="height: 50px; width: auto;">
                    </a>
                    <div>
                        <a class="btn btn-light me-2" href="{{ route('inicio') }}">Inicio</a>
                        <a class="btn btn-light me-2" href="{{ route('visitantes.menu') }}">Menú</a>
                        <a class="btn btn-light me-2" href="{{ route('visitantes.contacto') }}">Contacto</a>
                    </div>
                </div>
                <div>
                    <a class="btn btn-outline-light" href="{{ route('login') }}">
                        <i class="fas fa-user me-1"></i>
                        Empleados
                    </a>
                </div>
            </nav>
        </div>
    </header>

    <main class="container mb-5" style="min-height: 70vh;">
        @yield('content')
    </main>

    <footer class="text-center py-3">
        <p>&copy; {{ date('Y') }} PAN Y PUNTO. Todos los derechos reservados.</p>
    </footer>
    @yield('scripts')
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

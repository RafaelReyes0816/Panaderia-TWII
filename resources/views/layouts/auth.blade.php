<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PAN Y PUNTO - Acceso Empleados</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @stack('styles')
    <style>
        body {
            background: linear-gradient(135deg, #FFF8E7 0%, #F9C846 100%);
            color: #6B3F1D;
            font-family: 'Segoe UI', Arial, sans-serif;
            min-height: 100vh;
        }
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .auth-card {
            background: #FFFFFF;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(107, 63, 29, 0.2);
            border: none;
            max-width: 500px;
            width: 100%;
        }
        .auth-header {
            background: linear-gradient(135deg, #6B3F1D 0%, #B88B4A 100%);
            color: #FFD700;
            border-radius: 15px 15px 0 0;
            padding: 2rem;
            text-align: center;
        }
        .auth-header h4 {
            margin: 0;
            font-weight: bold;
        }
        .auth-body {
            padding: 2rem;
        }
        .form-control {
            border: 2px solid #F9C846;
            border-radius: 10px;
            padding: 12px 15px;
            background-color: #FFF8E7;
            color: #6B3F1D;
        }
        .form-control:focus {
            border-color: #6B3F1D;
            box-shadow: 0 0 0 0.2rem rgba(107, 63, 29, 0.25);
            background-color: #FFFFFF;
        }
        .form-label {
            font-weight: bold;
            color: #6B3F1D;
        }
        .btn-primary {
            background: linear-gradient(135deg, #6B3F1D 0%, #B88B4A 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #B88B4A 0%, #6B3F1D 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(107, 63, 29, 0.3);
        }
        .back-link {
            color: #6B3F1D;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .back-link:hover {
            color: #B88B4A;
        }
        .alert {
            border-radius: 10px;
            border: none;
        }
        .alert-danger {
            background-color: #FFE6E6;
            color: #B88B4A;
            border-left: 4px solid #B88B4A;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        @yield('content')
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html> 
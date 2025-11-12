<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Inventario - Inca Garcilaso de la Vega</title>
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <style>
        body {
            background: url('vendor/adminlte/dist/img/fondo.png') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Capa oscura encima del fondo */
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.6);
            z-index: -1;
        }

        .hero {
            text-align: center;
            margin-top: 100px;
        }

        .hero img {
            width: 250px;
            margin-bottom: 5px;
        }

        .btn-login {
            font-size: 18px;
            padding: 12px 30px;
            border-radius: 30px;
        }

        .features {
            background: rgba(255,255,255,0.9);
            color: #333;
            padding: 40px 20px;
            border-radius: 15px;
            margin: 40px auto;
            max-width: 1000px;
        }

        .feature-box {
            padding: 20px;
        }

        footer {
            padding: 15px;
            text-align: center;
            background: rgba(0,0,0,0.7);
            color: #ddd;
        }
    </style>
</head>
<body>
    <!-- Hero principal -->
    <div class="hero">
        <img src="vendor/adminlte/dist/img/logo.png" alt="Logo Colegio Inca Garcilaso de la Vega">
        <h1 class="display-4">Sistema de Inventario Escolar</h1>
        <p class="lead">Colegio Inca Garcilaso de la Vega</p>
        <a href="{{ route('login') }}" class="btn btn-light btn-lg btn-login mt-3">
            <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
        </a>
    </div>

    <!-- Sección informativa -->
    <div class="features row text-center">
        <div class="col-md-4 feature-box">
            <i class="fas fa-box fa-3x text-primary mb-3"></i>
            <h5>Gestión de Bienes</h5>
            <p>Registro detallado de muebles, equipos y recursos escolares.</p>
        </div>
        <div class="col-md-4 feature-box">
            <i class="fas fa-lock fa-3x text-success mb-3"></i>
            <h5>Acceso Seguro</h5>
            <p>Protección mediante usuarios y roles autorizados.</p>
        </div>
        <div class="col-md-4 feature-box">
            <i class="fas fa-chart-pie fa-3x text-warning mb-3"></i>
            <h5>Reportes</h5>
            <p>Obtén informes en tiempo real de los bienes del colegio.</p>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        © {{ date('Y') }} – Colegio Inca Garcilaso de la Vega | Sistema de Inventario Escolar
    </footer>
</body>
</html>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Sistema de Inventario</title>
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background: url('vendor/adminlte/dist/img/fondo.png') no-repeat center center fixed;
            background-size: cover;


            /* 🔹 Centrar el formulario */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: inherit;
            filter: blur(6px);
            /* 🔹 Ajusta el nivel de difuminado */
            z-index: -1;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .login-container img {
            width: 100px;
            margin-bottom: 15px;
        }

        .btn-custom {
            border-radius: 30px;
        }
    </style>
</head>

<body>
    <div class="login-container text-center">
        <img src='vendor/adminlte/dist/img/logo.png' alt="Logo Colegio">
        <h3 class="mb-3">Sistema de Inventario</h3>
        <p class="text-muted">Colegio Inca Garcilaso de la Vega</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required
                    autofocus>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
            </div>
            <div class="mb-3 form-check text-start">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label for="remember" class="form-check-label">Recuérdame</label>
            </div>
            <button type="submit" class="btn btn-primary w-100 btn-custom">
                <i class="fas fa-sign-in-alt"></i> Ingresar
            </button>
        </form>

        <div class="mt-3">
            <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Restablecer Contraseña - Sistema de Inventario</title>
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background: url('{{ asset('vendor/adminlte/dist/img/fondo.png') }}') no-repeat center center fixed;
            background-size: cover;
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
            z-index: -1;
        }

        .reset-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .reset-container img {
            width: 100px;
            margin-bottom: 15px;
        }

        .btn-custom {
            border-radius: 30px;
        }
    </style>
</head>

<body>
    <div class="reset-container text-center">
        <img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" alt="Logo Colegio">
        <h3 class="mb-3">Restablecer Contraseña</h3>
        <p class="text-muted">Sistema de Inventario - Colegio Inca Garcilaso de la Vega</p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Correo electrónico"
                    value="{{ old('email') }}" required autofocus>
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Nueva contraseña" required>
            </div>

            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control"
                    placeholder="Confirmar contraseña" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 btn-custom">
                <i class="fas fa-key"></i> Restablecer Contraseña
            </button>
        </form>

        <div class="mt-3">
            <a href="{{ route('login') }}">← Volver al inicio de sesión</a>
        </div>
    </div>
</body>

</html>

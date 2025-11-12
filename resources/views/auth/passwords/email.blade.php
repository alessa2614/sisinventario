<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña - Sistema de Inventario</title>
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
            text-align: center;
        }

        .reset-container img {
            width: 100px;
            margin-bottom: 15px;
        }

        .btn-custom {
            border-radius: 30px;
        }

        .text-muted {
            color: #666 !important;
        }
    </style>
</head>

<body>
    <div class="reset-container">
        <img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" alt="Logo Colegio">
        <h3 class="mb-3">Recuperar Contraseña</h3>
        <p class="text-muted">Ingresa tu correo electrónico para recibir un enlace de recuperación.</p>

        {{-- Mensaje de éxito --}}
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-3">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="Correo electrónico" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100 btn-custom">
                <i class="fas fa-paper-plane"></i> Enviar enlace
            </button>
        </form>

        <div class="mt-3">
            <a href="{{ route('login') }}">Volver al inicio de sesión</a>
        </div>
    </div>
</body>

</html>

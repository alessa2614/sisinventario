<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Error 403 - Acceso Denegado</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

  * {
    box-sizing: border-box;
  }

  body {
    margin: 0;
    background: #fff;
    font-family: 'Poppins', sans-serif;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #333;
  }

  .error-container {
    background: #fafafa;
    max-width: 420px;
    width: 90%;
    padding: 40px 35px;
    border-radius: 15px;
    box-shadow: 0 12px 28px rgba(0,0,0,0.1);
    text-align: center;
  }

  .error-code {
    font-size: 96px;
    font-weight: 900;
    color: #e34857; /* rojo estilo bootstrap */
    margin: 0;
    letter-spacing: 8px;
  }

  .error-title {
    font-size: 30px;
    font-weight: 600;
    margin: 20px 0 10px;
    color: #222;
  }

  .error-message {
    font-size: 17px;
    color: #555;
    line-height: 1.6;
    margin-bottom: 30px;
  }

  .btn-home {
    display: inline-block;
    padding: 14px 38px;
    background: #dc3545;
    color: #fff;
    font-weight: 600;
    font-size: 16px;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    text-decoration: none;
    box-shadow: 0 6px 15px rgba(220, 53, 69, 0.3);
    transition: all 0.3s ease;
  }

  .btn-home:hover {
    background: #b02a37;
    box-shadow: 0 8px 20px rgba(176, 42, 55, 0.5);
    transform: translateY(-3px);
  }

  /* Responsive */
  @media (max-width: 480px) {
    .error-code {
      font-size: 72px;
      letter-spacing: 5px;
    }
    .error-title {
      font-size: 24px;
    }
  }
</style>
</head>
<body>
  <div class="error-container" role="alert" aria-labelledby="errorTitle" aria-describedby="errorMessage">
    <h1 id="errorCode" class="error-code">403</h1>
    <h2 id="errorTitle" class="error-title">Acceso Denegado</h2>
    <p id="errorMessage" class="error-message">
      Lo sentimos, no tienes los permisos necesarios para acceder a esta página.<br />
      Contacta al administrador del sistema si crees que esto es un error.
    </p>
    <a href="/admin" class="btn-home" role="button" aria-label="Volver al inicio">Volver al Inicio</a>
  </div>
</body>
</html>

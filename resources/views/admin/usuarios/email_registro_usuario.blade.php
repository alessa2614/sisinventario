<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro exitoso</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f6f8; font-family: Arial, sans-serif;">

    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding:20px;">
        <tr>
            <td align="center">

                <!-- Contenedor -->
                <table width="650" border="0" cellspacing="0" cellpadding="0" 
                       style="background-color:#ffffff; border-radius:16px; overflow:hidden; box-shadow:0px 6px 18px rgba(0,0,0,0.1);">

                    <!-- Cabecera -->
                    <tr>
                        <td align="center" style="background-color:#0056b3; padding:25px;">
                            <!-- Logo del colegio -->
                           
                            <h1 style="color:#ffffff; margin:0; font-size:24px;">Sistema de Inventario</h1>
                            <p style="color:#ecf0f1; margin:8px 0 0 0; font-size:14px; letter-spacing:0.5px;">
                                I.E.S. Inca Garcilaso de la Vega
                            </p>
                        </td>
                    </tr>

                    <!-- Bienvenida -->
                    <tr>
                        <td style="padding:35px; text-align:left;">
                            <h2 style="color:#2c3e50; margin-top:0; font-size:22px;">Bienvenido/a {{ $usuario->nombres }} {{ $usuario->apellidos }}</h2>
                            <p style="color:#555; font-size:15px; line-height:1.7;">
                                Tu cuenta ha sido creada exitosamente en el sistema de inventario.  
                                A continuación encontrarás tus credenciales y los pasos para ingresar.
                            </p>

                            <!-- Tarjeta de contraseña -->
                            <div style="border-radius:10px; background:#0056b3; padding:20px; text-align:center; margin:25px 0;">
                                <p style="color:#ecf0f1; font-size:15px; margin:0 0 10px 0;">Tu contraseña temporal es:</p>
                                <p style="background:#ffffff; display:inline-block; padding:12px 25px; border-radius:8px; font-size:20px; font-weight:bold; color:#2c3e50; letter-spacing:1px; margin:0;">
                                    {{ $passwordTemporal }}
                                </p>
                                <p style="color:#ecf0f1; font-size:13px; margin-top:12px; font-style:italic;">
                                    Recuerda cambiarla en tu primer inicio de sesión
                                </p>
                            </div>

                            <!-- Pasos -->
                            <h3 style="color:#2c3e50; font-size:18px; margin-bottom:15px;">Pasos para ingresar</h3>
                            <table width="100%" cellspacing="0" cellpadding="0" style="margin-bottom:20px;">
                                <tr>
                                    <td style="padding:10px; vertical-align:top; width:50px;">
                                        <div style="width:40px; height:40px; border-radius:50%; background:#0056b3; color:#fff; text-align:center; line-height:40px; font-weight:bold;">1</div>
                                    </td>
                                    <td style="padding:10px;">
                                        <p style="margin:0; color:#2c3e50; font-size:15px;"><strong>Haz clic en el botón Iniciar Sesión</strong></p>
                                        <p style="margin:5px 0 0; color:#555; font-size:13px;">Serás redirigido a la página de acceso del sistema.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px; vertical-align:top; width:50px;">
                                        <div style="width:40px; height:40px; border-radius:50%; background:#0056b3; color:#fff; text-align:center; line-height:40px; font-weight:bold;">2</div>
                                    </td>
                                    <td style="padding:10px;">
                                        <p style="margin:0; color:#2c3e50; font-size:15px;"><strong>Ingresa tu correo y la contraseña temporal</strong></p>
                                        <p style="margin:5px 0 0; color:#555; font-size:13px;">Utiliza el correo con el que fuiste registrado.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px; vertical-align:top; width:50px;">
                                        <div style="width:40px; height:40px; border-radius:50%; background:#0056b3; color:#fff; text-align:center; line-height:40px; font-weight:bold;">3</div>
                                    </td>
                                    <td style="padding:10px;">
                                        <p style="margin:0; color:#2c3e50; font-size:15px;"><strong>Cambia tu contraseña</strong></p>
                                        <p style="margin:5px 0 0; color:#555; font-size:13px;">Por motivos de seguridad, el sistema solicitará una nueva clave.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px; vertical-align:top; width:50px;">
                                        <div style="width:40px; height:40px; border-radius:50%; background:#0056b3; color:#fff; text-align:center; line-height:40px; font-weight:bold;">4</div>
                                    </td>
                                    <td style="padding:10px;">
                                        <p style="margin:0; color:#2c3e50; font-size:15px;"><strong>Comienza a usar el sistema</strong></p>
                                        <p style="margin:5px 0 0; color:#555; font-size:13px;">Ya podrás gestionar el inventario de manera fácil y segura.</p>
                                    </td>
                                </tr>
                            </table>

                            <!-- Botón -->
                            <div style="text-align:center; margin:30px 0;">
                                <a href="{{ url('/login') }}" 
                                   style="background:#0056b3; color:#ffffff; text-decoration:none; padding:14px 32px; border-radius:8px; font-size:16px; font-weight:bold; display:inline-block; box-shadow:0px 3px 8px rgba(0,0,0,0.15);">
                                    Iniciar Sesión
                                </a>
                            </div>

                            <!-- Despedida -->
                            <p style="color:#555; font-size:14px; text-align:center; margin-top:25px;">
                                Gracias por unirte al <strong>Sistema de Inventario</strong> del  
                                <br><strong>I.E.S. Inca Garcilaso de la Vega</strong>.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="background-color:#0056b3; padding:15px;">
                            <p style="color:#ecf0f1; font-size:12px; margin:0;">
                                © {{ date('Y') }} Colegio Inca Garcilaso de la Vega - Sistema de Inventario  
                                <br>Este es un mensaje automático, no responda a este correo.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización</title>
</head>
<body>
    <p>Hola {{ $cotizacion->solicitud->nombre_completo }},</p>

    <p>Te informamos que tu solicitud fue aceptada y aquí está tu cotización.</p>

    <p>Adjuntamos el archivo con el detalle de la cotización.</p>

    <p>
        Gracias,<br>
        Transporte y Comercializadora Roceval S.A.S
    </p>
</body>
</html>

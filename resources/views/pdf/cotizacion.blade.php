<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización #{{ $cotizacion->id }}</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 12px; color: #111; }
        .container { width: 100%; }
        h1 { font-size: 18px; margin: 0 0 8px 0; }
        h2 { font-size: 14px; margin: 16px 0 8px 0; }
        .muted { color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th, td { border: 1px solid #ddd; padding: 6px; vertical-align: top; }
        th { background: #f2f2f2; text-align: left; }
        .right { text-align: right; }
    </style>
</head>
<body>
<div class="container">
    <h1>Cotización #{{ $cotizacion->id }}</h1>
    <div class="muted">Solicitud #{{ $cotizacion->solicitud->id }} - {{ $cotizacion->created_at->format('Y-m-d H:i') }}</div>

    <h2>Cliente</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <td>{{ $cotizacion->solicitud->nombre_completo }}</td>
        </tr>
        <tr>
            <th>Empresa</th>
            <td>{{ $cotizacion->solicitud->empresa ?: 'N/A' }}</td>
        </tr>
        <tr>
            <th>Correo</th>
            <td>{{ $cotizacion->solicitud->correo }}</td>
        </tr>
        <tr>
            <th>Teléfono</th>
            <td>{{ $cotizacion->solicitud->telefono }}</td>
        </tr>
    </table>

    <h2>Ruta</h2>
    <table>
        <tr>
            <th>Origen</th>
            <td>{{ $cotizacion->solicitud->ciudad_origen }} ({{ $cotizacion->solicitud->pais_origen }})</td>
        </tr>
        <tr>
            <th>Destino</th>
            <td>{{ $cotizacion->solicitud->ciudad_destino }} ({{ $cotizacion->solicitud->pais_destino }})</td>
        </tr>
        <tr>
            <th>Fechas estimadas</th>
            <td>
                @if($cotizacion->solicitud->fecha_inicial && $cotizacion->solicitud->fecha_final)
                    {{ $cotizacion->solicitud->fecha_inicial }} - {{ $cotizacion->solicitud->fecha_final }}
                @else
                    {{ $cotizacion->solicitud->fecha_recogida }}
                @endif
            </td>
        </tr>
    </table>

    <h2>Detalle de cotización</h2>
    <table>
        <tr>
            <th>Precio total</th>
            <td class="right">{{ number_format($cotizacion->precio_total, 2) }} {{ $cotizacion->moneda }}</td>
        </tr>
        <tr>
            <th>Tiempo de tránsito</th>
            <td>{{ $cotizacion->tiempo_transito ?: 'N/A' }}</td>
        </tr>
        <tr>
            <th>Validez</th>
            <td>{{ $cotizacion->validez_oferta ?: 'N/A' }}</td>
        </tr>
        <tr>
            <th>Incluye aduanas</th>
            <td>{{ $cotizacion->incluye_aduanas ? 'Sí' : 'No' }}</td>
        </tr>
        <tr>
            <th>Incluye seguro</th>
            <td>{{ $cotizacion->incluye_seguro ? 'Sí' : 'No' }}</td>
        </tr>
        <tr>
            <th>Observaciones</th>
            <td>{{ $cotizacion->observaciones ?: 'N/A' }}</td>
        </tr>
    </table>

    <p style="margin-top: 18px;" class="muted">
        Transporte y Comercializadora Roceval S.A.S
    </p>
</div>
</body>
</html>

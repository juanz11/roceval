<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización #{{ $cotizacion->id }} - Solicitud #{{ $cotizacion->solicitud->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark no-print">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.solicitudes.index') }}">Panel Roceval</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.solicitudes.index') }}">Solicitudes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.solicitudes.historial') }}">Historial</a>
                </li>
            </ul>
            <form class="d-flex" action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">Cerrar sesión</button>
            </form>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
        <h1 class="mb-0">Cotización #{{ $cotizacion->id }}</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.solicitudes.cotizar', $cotizacion->solicitud) }}" class="btn btn-outline-secondary btn-sm">Editar cotización</a>
            <button onclick="window.print()" class="btn btn-primary btn-sm">Imprimir / Guardar como PDF</button>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Datos del cliente y la solicitud</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-1"><strong>Solicitud #:</strong> {{ $cotizacion->solicitud->id }}</p>
                    <p class="mb-1"><strong>Nombre:</strong> {{ $cotizacion->solicitud->nombre_completo }}</p>
                    <p class="mb-1"><strong>Empresa:</strong> {{ $cotizacion->solicitud->empresa ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Correo:</strong> {{ $cotizacion->solicitud->correo }}</p>
                    <p class="mb-1"><strong>Teléfono:</strong> {{ $cotizacion->solicitud->telefono }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1"><strong>Origen:</strong> {{ $cotizacion->solicitud->ciudad_origen }} ({{ $cotizacion->solicitud->pais_origen }})</p>
                    <p class="mb-1"><strong>Destino:</strong> {{ $cotizacion->solicitud->ciudad_destino }} ({{ $cotizacion->solicitud->pais_destino }})</p>
                    <p class="mb-1"><strong>Fecha de recogida:</strong> {{ $cotizacion->solicitud->fecha_recogida }}</p>
                    <p class="mb-1"><strong>Tipo de carga:</strong> {{ $cotizacion->solicitud->tipo_carga ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Tipo de servicio:</strong> {{ $cotizacion->solicitud->tipo_servicio ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Detalles de la cotización</div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <p class="mb-1"><strong>Precio total:</strong> {{ number_format($cotizacion->precio_total, 2) }} {{ $cotizacion->moneda }}</p>
                </div>
                <div class="col-md-4">
                    <p class="mb-1"><strong>Tiempo de tránsito estimado:</strong> {{ $cotizacion->tiempo_transito ?? 'N/A' }}</p>
                </div>
                <div class="col-md-4">
                    <p class="mb-1"><strong>Validez de la oferta:</strong> {{ $cotizacion->validez_oferta ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <p class="mb-1"><strong>Incluye servicios aduaneros:</strong> {{ $cotizacion->incluye_aduanas ? 'Sí' : 'No' }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1"><strong>Incluye seguro:</strong> {{ $cotizacion->incluye_seguro ? 'Sí' : 'No' }}</p>
                </div>
            </div>

            <div class="mb-0">
                <p class="mb-1"><strong>Observaciones:</strong></p>
                <p class="mb-0">{{ $cotizacion->observaciones ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

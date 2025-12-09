<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotizar solicitud #{{ $solicitud->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                    <a class="nav-link" href="{{ url('/') }}">Inicio público</a>
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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Cotizar solicitud #{{ $solicitud->id }}</h1>
        <a href="{{ route('admin.solicitudes.index') }}" class="btn btn-outline-secondary btn-sm">Volver al listado</a>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">Datos del cliente</div>
                <div class="card-body">
                    <p class="mb-1"><strong>Nombre:</strong> {{ $solicitud->nombre_completo }}</p>
                    <p class="mb-1"><strong>Empresa:</strong> {{ $solicitud->empresa ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Correo:</strong> {{ $solicitud->correo }}</p>
                    <p class="mb-1"><strong>Teléfono:</strong> {{ $solicitud->telefono }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">Datos de la ruta</div>
                <div class="card-body">
                    <p class="mb-1"><strong>Origen:</strong> {{ $solicitud->ciudad_origen }} ({{ $solicitud->pais_origen }})</p>
                    <p class="mb-1"><strong>Destino:</strong> {{ $solicitud->ciudad_destino }} ({{ $solicitud->pais_destino }})</p>
                    <p class="mb-1"><strong>Fecha de recogida:</strong> {{ $solicitud->fecha_recogida }}</p>
                    <p class="mb-1"><strong>Tipo de carga:</strong> {{ $solicitud->tipo_carga ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Tipo de servicio:</strong> {{ $solicitud->tipo_servicio ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Información para cotizar</div>
        <div class="card-body">
            <p class="text-muted mb-3">
                Aquí puedes añadir el formulario de cotización (precio, moneda, tiempos, observaciones, etc.).
                Por ahora esta pantalla solo muestra la información de la solicitud para facilitarte la cotización manual.
            </p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

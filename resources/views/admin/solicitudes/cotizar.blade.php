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
                    <a class="nav-link" href="{{ route('admin.solicitudes.historial') }}">Historial</a>
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
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.solicitudes.cotizar.guardar', $solicitud) }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <label for="precio_total" class="form-label">Precio total *</label>
                        <input type="number" step="0.01" min="0" class="form-control" id="precio_total" name="precio_total" required value="{{ old('precio_total', $cotizacion->precio_total ?? '') }}">
                        @error('precio_total')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="moneda" class="form-label">Moneda *</label>
                        <select id="moneda" name="moneda" class="form-select" required>
                            @php
                                $monedaActual = old('moneda', $cotizacion->moneda ?? 'USD');
                            @endphp
                            <option value="USD" {{ $monedaActual === 'USD' ? 'selected' : '' }}>USD</option>
                            <option value="COP" {{ $monedaActual === 'COP' ? 'selected' : '' }}>COP</option>
                            <option value="VES" {{ $monedaActual === 'VES' ? 'selected' : '' }}>VES</option>
                        </select>
                        @error('moneda')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="tiempo_transito" class="form-label">Tiempo de tránsito estimado</label>
                        <input type="text" class="form-control" id="tiempo_transito" name="tiempo_transito" placeholder="Ej: 5-7 días" value="{{ old('tiempo_transito', $cotizacion->tiempo_transito ?? '') }}">
                        @error('tiempo_transito')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="validez_oferta" class="form-label">Validez de la oferta</label>
                        <input type="text" class="form-control" id="validez_oferta" name="validez_oferta" placeholder="Ej: 10 días a partir de la fecha" value="{{ old('validez_oferta', $cotizacion->validez_oferta ?? '') }}">
                        @error('validez_oferta')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label d-block">¿Incluye servicios aduaneros? *</label>
                        @php
                            $aduanasActual = old('incluye_aduanas', isset($cotizacion) ? (int) $cotizacion->incluye_aduanas : 1);
                        @endphp
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="incluye_aduanas" id="aduanas_si" value="1" {{ $aduanasActual ? 'checked' : '' }}>
                            <label class="form-check-label" for="aduanas_si">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="incluye_aduanas" id="aduanas_no" value="0" {{ !$aduanasActual ? 'checked' : '' }}>
                            <label class="form-check-label" for="aduanas_no">No</label>
                        </div>
                        @error('incluye_aduanas')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label d-block">¿Incluye seguro? *</label>
                        @php
                            $seguroActual = old('incluye_seguro', isset($cotizacion) ? (int) $cotizacion->incluye_seguro : 0);
                        @endphp
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="incluye_seguro" id="seguro_si" value="1" {{ $seguroActual ? 'checked' : '' }}>
                            <label class="form-check-label" for="seguro_si">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="incluye_seguro" id="seguro_no" value="0" {{ !$seguroActual ? 'checked' : '' }}>
                            <label class="form-check-label" for="seguro_no">No</label>
                        </div>
                        @error('incluye_seguro')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="observaciones" class="form-label">Observaciones</label>
                    <textarea class="form-control" id="observaciones" name="observaciones" rows="4" placeholder="Detalles adicionales, condiciones especiales, etc.">{{ old('observaciones', $cotizacion->observaciones ?? '') }}</textarea>
                    @error('observaciones')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ isset($cotizacion) ? 'Actualizar cotización' : 'Guardar cotización' }}
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

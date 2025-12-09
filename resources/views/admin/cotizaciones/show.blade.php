<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización #{{ $cotizacion->id }} - Solicitud #{{ $cotizacion->solicitud->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fa;
            position: relative;
        }

        .pdf-wrapper {
            background: #ffffff;
            max-width: 900px;
            margin: 2rem auto;
            padding: 3rem 3rem 2rem;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
            position: relative;
        }

        .watermark-logo {
            position: absolute;
            top: 35%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.06;
            width: 60%;
            max-width: 450px;
            pointer-events: none;
            z-index: 0;
        }

        .pdf-content {
            position: relative;
            z-index: 1;
        }

        .pdf-header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .pdf-header-logo img {
            max-height: 70px;
        }

        .pdf-header-title {
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            line-height: 1.4;
        }

        .pdf-subtitle {
            font-size: 0.8rem;
            color: #555555;
        }

        .section-title {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.9rem;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }

        .table-condensed th,
        .table-condensed td {
            padding: 0.3rem 0.5rem;
            font-size: 0.8rem;
        }

        .page-break-before {
            page-break-before: always;
            margin-top: 3rem;
        }

        @media print {
            body {
                background: #ffffff;
            }

            .no-print {
                display: none !important;
            }

            .pdf-wrapper {
                box-shadow: none;
                margin: 0;
                padding: 2rem;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

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

<div class="container py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-3 no-print">
        <h1 class="h4 mb-0">Cotización #{{ $cotizacion->id }}</h1>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('admin.solicitudes.cotizar', $cotizacion->solicitud) }}" class="btn btn-outline-secondary btn-sm text-nowrap">Editar cotización</a>
            <button onclick="window.print()" class="btn btn-primary btn-sm text-nowrap">Imprimir / Guardar como PDF</button>
        </div>
    </div>

    <div class="pdf-wrapper">
        <img src="{{ asset('img/157973.png') }}" alt="Roceval" class="watermark-logo">

        <div class="pdf-content">
            <div class="pdf-header">
                <div class="pdf-header-logo">
                    <img src="{{ asset('img/157973.png') }}" alt="Logo Roceval">
                </div>
                <div>
                    <div class="pdf-header-title">
                        TRANSPORTE Y COMERCIALIZADORA ROCEVAL S.A.S<br>
                        NIT. 901.101.398-8 – RÉGIMEN COMÚN
                    </div>
                    <div class="pdf-subtitle">
                        Servicios de transporte y logística internacional
                    </div>
                </div>
            </div>

            @php
                $sol = $cotizacion->solicitud;
                $fecha = \Carbon\Carbon::parse($sol->created_at)->translatedFormat('d F \d\e\l Y');
            @endphp

            <div class="mb-3" style="font-size: 0.85rem;">
                <strong>CUCUTA, {{ mb_strtoupper($fecha, 'UTF-8') }}</strong>
            </div>

            <div style="font-size: 0.85rem;" class="mb-3">
                <p class="mb-1"><strong>SEÑORES:</strong> {{ $sol->empresa ?: $sol->nombre_completo }}</p>
                <p class="mb-1"><strong>Atención:</strong> {{ $sol->nombre_completo }}</p>
                <p class="mb-1"><strong>Asunto:</strong> Cotización de servicio de transporte</p>
            </div>

            <div style="font-size: 0.85rem;" class="mb-3">
                <p class="mb-1">
                    A continuación, presentamos nuestra propuesta para el servicio de transporte de su carga
                    desde <strong>{{ $sol->ciudad_origen }} ({{ $sol->pais_origen }})</strong> hasta
                    <strong>{{ $sol->ciudad_destino }} ({{ $sol->pais_destino }})</strong>.
                </p>
            </div>

            <div class="section-title">Detalle económico</div>

            <table class="table table-bordered table-sm table-condensed mb-3">
                <thead class="table-light">
                <tr>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th class="text-end">Valor flete</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $sol->ciudad_origen }} ({{ $sol->pais_origen }})</td>
                    <td>{{ $sol->ciudad_destino }} ({{ $sol->pais_destino }})</td>
                    <td class="text-end">
                        {{ number_format($cotizacion->precio_total, 2) }} {{ $cotizacion->moneda }}
                        <span class="d-block small text-muted">Sujeto al precio de la TRM del día</span>
                    </td>
                </tr>
                </tbody>
            </table>

            <div style="font-size: 0.8rem;" class="mb-3">
                <p class="mb-1">Máximo: 32 toneladas.</p>
                <p class="mb-1">Cupo máximo:</p>
                <ul class="mb-1">
                    <li>- 27 toneladas en contenedor.</li>
                    <li>- Por plancha 33 TN.</li>
                </ul>
                <p class="mb-1">
                    <strong>Nota:</strong> Peso mayor a 32 TN tendrá un valor adicional de 1.000.000,00 COP.
                </p>
            </div>

            <div class="section-title">Tarifa cubre / no cubre</div>

            <div class="row" style="font-size: 0.8rem;">
                <div class="col-md-6 mb-2">
                    <strong>Tarifa cubre:</strong>
                    <ul class="mb-2">
                        <li>Flete de origen a destino.</li>
                        <li>Cargue en origen.</li>
                        <li>Descargue en destino.</li>
                        <li>Registro fotográfico de la operación.</li>
                        <li>Documentos (carta porte, manifiesto, DTI).</li>
                        <li>Supervisión de la carga de origen a destino.</li>
                        <li>GPS satelital.</li>
                    </ul>
                </div>
                <div class="col-md-6 mb-2">
                    <strong>Tarifa no cubre:</strong>
                    <ul class="mb-2">
                        <li>Gastos logísticos adicionales no especificados.</li>
                        <li>Seguro de la mercancía (según lo acordado en la cotización).</li>
                        <li>Costos por sobrepesos o sobretiempos adicionales.</li>
                    </ul>
                </div>
            </div>

            <div class="page-break-before">
                <div class="section-title">Vigencia, documentación y forma de pago</div>

                <div style="font-size: 0.8rem;" class="mb-3">
                    <p class="mb-1"><strong>Vigencia:</strong> Treinta (30) días.</p>
                    <p class="mb-1"><strong>Documentación necesaria:</strong> Factura, SAE, FMM, 1162, 1416, 1209 y 1154.</p>
                </div>

                <div style="font-size: 0.8rem;" class="mb-3">
                    <p class="mb-1"><strong>Forma de pago:</strong> 50% cargando y 50% al descargar.</p>
                    <p class="mb-1">
                        Se procederá a cobrar STAN BY por un valor de $100,00 por día por gandola después de 6 días libres
                        (incluye 1 día para cargar, 2 días del lado colombiano aduana, 2 días lado venezolano aduana
                        y 1 día para descargar).
                    </p>
                </div>

                <div class="section-title">Datos bancarios</div>

                <div style="font-size: 0.8rem;" class="mb-3">
                    <p class="mb-1">El pago de las facturas se realizaría de la siguiente manera:</p>
                    <p class="mb-1"><strong>Depósito en la cuenta de TRANSPORTE Y COMERCIALIZADORA ROCEVAL S.A.S:</strong></p>
                    <ul class="mb-2">
                        <li>Tipo: Cuenta de ahorro</li>
                        <li>Número de cuenta: 82400002244</li>
                        <li>Banco: Bancolombia</li>
                        <li>Beneficiario: Transporte y Comercializadora Roceval S.A.S</li>
                        <li>NIT: 901.101.398-8</li>
                        <li>Correo: transporteroceval@gmail.com</li>
                    </ul>
                </div>

                <div class="section-title">Observaciones</div>

                <div style="font-size: 0.8rem;" class="mb-3">
                    <p class="mb-1">
                        Es necesario de su parte, si acepta esta cotización, hacerlo por escrito. Asimismo, realizar una
                        programación semanal confirmando los días de cargue para poder coordinar de la mejor manera la
                        operación y hacerle llegar los datos del vehículo y del conductor.
                    </p>

                    <p class="mb-1"><strong>Observaciones adicionales de la cotización:</strong></p>
                    <p class="mb-0">{{ $cotizacion->observaciones ?? 'N/A' }}</p>
                </div>

                <div class="mt-5" style="font-size: 0.8rem;">
                    <p class="mb-1">Atentamente,</p>
                    <p class="mb-1"><strong>TRANSPORTE Y COMERCIALIZADORA ROCEVAL S.A.S</strong></p>
                    <p class="mb-0">NIT. 901.101.398-8 – Régimen Común</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

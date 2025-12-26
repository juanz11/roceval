<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chofer #{{ $chofer->id }} - Panel Roceval</title>
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
                    <a class="nav-link active" aria-current="page" href="{{ route('admin.choferes.index') }}">Choferes</a>
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
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
        <div>
            <h1 class="mb-0">Chofer #{{ $chofer->id }}</h1>
            <div class="text-muted small">{{ $chofer->nombre }} {{ $chofer->apellidos }} - {{ $chofer->cedula }}</div>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('admin.choferes.edit', $chofer) }}" class="btn btn-primary btn-sm">Editar</a>
            <a href="{{ route('admin.choferes.index') }}" class="btn btn-outline-secondary btn-sm">Volver al listado</a>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">Datos</div>
                <div class="card-body">
                    <p class="mb-1"><strong>Nombres:</strong> {{ $chofer->nombre }}</p>
                    <p class="mb-1"><strong>Apellidos:</strong> {{ $chofer->apellidos }}</p>
                    <p class="mb-0"><strong>Cédula:</strong> {{ $chofer->cedula }}</p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">Chuto</div>
                <div class="card-body">
                    <p class="mb-1"><strong>Placa:</strong> {{ $chofer->placa_chuto ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Marca:</strong> {{ $chofer->marca_chuto ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Año:</strong> {{ $chofer->ano_chuto ?? 'N/A' }}</p>
                    <p class="mb-0"><strong>Color:</strong> {{ $chofer->color_chuto ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">Batea</div>
                <div class="card-body">
                    <p class="mb-1"><strong>Placa:</strong> {{ $chofer->placa_batea ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Marca:</strong> {{ $chofer->marca_batea ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Año:</strong> {{ $chofer->ano_batea ?? 'N/A' }}</p>
                    <p class="mb-0"><strong>Color:</strong> {{ $chofer->color_batea ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">Contenedor</div>
                <div class="card-body">
                    <p class="mb-1"><strong>Número:</strong> {{ $chofer->numero_contenedor ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Marca:</strong> {{ $chofer->marca_contenedor ?? 'N/A' }}</p>
                    <p class="mb-0"><strong>Color:</strong> {{ $chofer->color_contenedor ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">Documentos</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered align-middle mb-0">
                    <thead>
                    <tr>
                        <th>Título</th>
                        <th>Archivo</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($chofer->documentos as $doc)
                        <tr>
                            <td>{{ $doc->titulo }}</td>
                            <td>
                                <a href="{{ \Illuminate\Support\Facades\Storage::url($doc->ruta_archivo) }}" target="_blank" rel="noopener">{{ $doc->nombre_original ?? 'Ver archivo' }}</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center text-muted">Sin documentos cargados.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

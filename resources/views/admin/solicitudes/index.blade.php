<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Solicitudes</title>
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
                    <a class="nav-link active" aria-current="page" href="{{ route('admin.solicitudes.index') }}">Solicitudes</a>
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

<div class="container py-4 py-md-5 px-2 px-md-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Solicitudes de Cotización</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle mb-0">
        <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Origen</th>
            <th>Destino</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @forelse($solicitudes as $solicitud)
            <tr>
                <td>{{ $solicitud->id }}</td>
                <td>{{ $solicitud->created_at->format('Y-m-d H:i') }}</td>
                <td>{{ $solicitud->nombre_completo }}</td>
                <td>{{ $solicitud->correo }}</td>
                <td>{{ $solicitud->telefono }}</td>
                <td>{{ $solicitud->ciudad_origen }} ({{ $solicitud->pais_origen }})</td>
                <td>{{ $solicitud->ciudad_destino }} ({{ $solicitud->pais_destino }})</td>
                <td>
                    @php
                        $estado = $solicitud->estado;
                        $color = $estado === 'pendiente'
                            ? 'warning'
                            : ($estado === 'aceptada' ? 'success' : ($estado === 'cotizada' ? 'info' : 'danger'));
                    @endphp
                    <span class="badge bg-{{ $color }}">
                        {{ ucfirst($estado) }}
                    </span>
                </td>
                <td>
                    <div class="d-flex flex-wrap gap-2">
                        <form action="{{ route('admin.solicitudes.aceptar', $solicitud) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success text-nowrap" {{ in_array($solicitud->estado, ['aceptada', 'cotizada']) ? 'disabled' : '' }}>Aceptar</button>
                        </form>
                        <form action="{{ route('admin.solicitudes.rechazar', $solicitud) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger text-nowrap" {{ $solicitud->estado === 'rechazada' ? 'disabled' : '' }}>Rechazar</button>
                        </form>
                        @if(in_array($solicitud->estado, ['aceptada', 'cotizada']))
                            <a href="{{ route('admin.solicitudes.cotizar', $solicitud) }}" class="btn btn-sm btn-primary text-nowrap">Cotizar</a>
                        @endif
                        @if($solicitud->cotizacion)
                            <a href="{{ route('admin.cotizaciones.show', $solicitud->cotizacion) }}" class="btn btn-sm btn-outline-primary text-nowrap">Ver cotización</a>
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center">No hay solicitudes registradas todavía.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    </div>

    {{ $solicitudes->links() }}
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

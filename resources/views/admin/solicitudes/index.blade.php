<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Solicitudes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Solicitudes de Cotización</h1>
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-secondary btn-sm">Cerrar sesión</button>
        </form>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped table-bordered align-middle">
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
                    <span class="badge bg-{{ $solicitud->estado === 'pendiente' ? 'warning' : ($solicitud->estado === 'aceptada' ? 'success' : 'danger') }}">
                        {{ ucfirst($solicitud->estado) }}
                    </span>
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <form action="{{ route('admin.solicitudes.aceptar', $solicitud) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success" {{ $solicitud->estado === 'aceptada' ? 'disabled' : '' }}>Aceptar</button>
                        </form>
                        <form action="{{ route('admin.solicitudes.rechazar', $solicitud) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" {{ $solicitud->estado === 'rechazada' ? 'disabled' : '' }}>Rechazar</button>
                        </form>
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

    {{ $solicitudes->links() }}
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

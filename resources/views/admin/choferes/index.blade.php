<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choferes - Panel Roceval</title>
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
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
        <h1 class="mb-0">Choferes</h1>
        <a href="{{ route('admin.choferes.create') }}" class="btn btn-primary btn-sm">Nuevo chofer</a>
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
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Cédula</th>
                <th>Placa chuto</th>
                <th>Placa batea</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($choferes as $chofer)
                <tr>
                    <td>{{ $chofer->id }}</td>
                    <td>{{ $chofer->nombre }}</td>
                    <td>{{ $chofer->apellidos }}</td>
                    <td>{{ $chofer->cedula }}</td>
                    <td>{{ $chofer->placa_chuto ?? 'N/A' }}</td>
                    <td>{{ $chofer->placa_batea ?? 'N/A' }}</td>
                    <td>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('admin.choferes.show', $chofer) }}" class="btn btn-sm btn-outline-secondary text-nowrap">Ver</a>
                            <a href="{{ route('admin.choferes.edit', $chofer) }}" class="btn btn-sm btn-primary text-nowrap">Editar</a>
                            <form action="{{ route('admin.choferes.destroy', $chofer) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este chofer?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger text-nowrap">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No hay choferes registrados todavía.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $choferes->links() }}
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

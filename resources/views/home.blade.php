<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roceval - Sistema de Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f1f3f5; /* gris claro de fondo */
            color: #ffffff;
        }
        .card-home {
            max-width: 900px;
            width: 100%;
            border-radius: 1rem;
            overflow: hidden;
        }
        .logo-img {
            max-height: 90px;
        }
        .home-sidebar {
            background-color: #0b1b34; /* azul muy oscuro que combina con negro y logo */
        }
        .home-primary-text {
            color: #0b1b34; /* mismo azul oscuro para textos principales en la parte blanca */
        }
        .btn-home-primary {
            background-color: #0b1b34;
            border-color: #0b1b34;
        }
        .btn-home-primary:hover {
            background-color: #122549;
            border-color: #122549;
        }
        .btn-home-outline {
            border-color: #0b1b34;
            color: #0b1b34;
        }
        .btn-home-outline:hover {
            background-color: #0b1b34;
            color: #ffffff;
        }
    </style>
</head>
<body>
<div class="container px-3 px-md-0">
    <div class="card card-home shadow-lg border-0">
        <div class="row g-0">
            <div class="col-md-5 home-sidebar d-flex flex-column justify-content-center align-items-center p-4">
                <img src="{{ asset('img/157975.png') }}" alt="Logo Roceval" class="logo-img mb-3">
                <p class="text-white-50 mb-0 text-center small">
                    Sistema interno para gestionar y facilitar el registro de solicitudes de transporte.
                </p>
            </div>
            <div class="col-md-7 bg-white text-dark p-4 p-md-5 d-flex flex-column justify-content-center">
                <div class="mb-3">
                    <img src="{{ asset('img/157973.png') }}" alt="Roceval" class="logo-img mb-3">
                    <h1 class="h3 fw-bold mb-2 home-primary-text">Roceval - Sistema para facilitar su registro</h1>
                    <p class="text-muted mb-0">
                        Completa un sencillo formulario con los datos de contacto, ruta y características de la carga
                        para que podamos cotizar tu servicio de transporte de manera rápida y organizada.
                    </p>
                </div>

                <ul class="text-muted small mb-4">
                    <li>Centraliza todas las solicitudes en un solo lugar.</li>
                    <li>Permite a los administradores visualizar, aceptar o rechazar solicitudes.</li>
                    <li>Optimiza el tiempo y mejora el seguimiento de cada operación.</li>
                </ul>

                <div class="d-flex flex-column flex-sm-row gap-2 align-items-stretch align-items-sm-center">
                    <a href="{{ route('formulario.show') }}" class="btn btn-home-primary btn-lg flex-fill text-white">
                        Empezar formulario
                    </a>
                    <a href="{{ route('admin.solicitudes.index') }}" class="btn btn-home-outline flex-fill">
                        Ir al panel de administración
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

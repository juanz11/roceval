<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T.C.R S.A.S - Solicitudes de transporte</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #0b1b34;
            --navy-soft: #12294d;
            --accent: #1e88e5;
        }
        body {
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif;
            color: var(--navy);
            background-color: #f4f6fb;
        }
        .navbar-brand img {
            height: 44px;
        }
        .hero {
            position: relative;
            overflow: hidden;
            color: #fff;
            background:
                radial-gradient(900px 500px at 85% -10%, rgba(30, 136, 229, 0.55), transparent 60%),
                radial-gradient(700px 500px at 0% 110%, rgba(30, 136, 229, 0.28), transparent 55%),
                linear-gradient(140deg, #061020 0%, var(--navy) 55%, #103a70 100%);
        }
        .hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: url('{{ asset('img/157973.png') }}') no-repeat right -60px bottom -40px;
            background-size: 520px auto;
            opacity: 0.07;
            filter: invert(1);
            pointer-events: none;
        }
        .hero-content {
            position: relative;
            z-index: 1;
        }
        .hero h1 {
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -0.5px;
        }
        .pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 999px;
            padding: 0.35rem 0.9rem;
            font-size: 0.85rem;
        }
        .btn-cta {
            background: #fff;
            color: var(--navy);
            font-weight: 700;
            border-radius: 0.85rem;
            padding: 0.9rem 1.6rem;
            border: 0;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }
        .btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.3);
            color: var(--navy);
        }
        .btn-ghost {
            border-radius: 0.85rem;
            padding: 0.9rem 1.6rem;
            font-weight: 600;
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.45);
        }
        .btn-ghost:hover {
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
        }
        .hero-panel {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 1.25rem;
            backdrop-filter: blur(6px);
        }
        .step-number {
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.16);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
        }
        .feature-card {
            border: 1px solid rgba(11, 27, 52, 0.08);
            border-radius: 1rem;
            background: #fff;
            height: 100%;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }
        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 40px rgba(11, 27, 52, 0.1);
        }
        .feature-icon {
            width: 46px;
            height: 46px;
            border-radius: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(30, 136, 229, 0.12);
            color: var(--accent);
            font-size: 1.25rem;
        }
        .cta-band {
            border-radius: 1.25rem;
            background: linear-gradient(120deg, var(--navy) 0%, var(--navy-soft) 60%, #17559b 100%);
            color: #fff;
        }
        footer {
            background: var(--navy);
            color: rgba(255, 255, 255, 0.7);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container py-2">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
            <img src="{{ asset('img/157973.png') }}" alt="T.C.R S.A.S">
        </a>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('admin.solicitudes.index') }}" class="btn btn-link text-decoration-none fw-semibold" style="color: var(--navy);">
                Panel administrativo
            </a>
            <a href="{{ route('formulario.show') }}" class="btn btn-dark rounded-3 px-3 fw-semibold" style="background-color: var(--navy); border-color: var(--navy);">
                Ir al formulario
            </a>
        </div>
    </div>
</nav>

<header class="hero">
    <div class="container hero-content py-5">
        <div class="row align-items-center g-5 py-lg-4">
            <div class="col-lg-6">
                <span class="pill mb-3">
                    <i class="bi bi-truck"></i> Transporte de carga
                </span>
                <h1 class="display-5 mb-3">Solicita tu cotización de transporte en minutos</h1>
                <p class="lead text-white-50 mb-4">
                    Completa un formulario sencillo con tus datos de contacto, la ruta y las características
                    de la carga. Nuestro equipo revisa la solicitud y te envía la cotización por correo.
                </p>
                <div class="d-flex flex-column flex-sm-row gap-3">
                    <a href="{{ route('formulario.show') }}" class="btn btn-cta btn-lg">
                        <i class="bi bi-pencil-square me-2"></i>Ir al formulario
                    </a>
                    <a href="#como-funciona" class="btn btn-ghost btn-lg">Cómo funciona</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-panel p-4 p-md-5">
                    <h2 class="h5 fw-bold mb-4">Tu solicitud, paso a paso</h2>
                    <div class="d-flex gap-3 mb-4">
                        <div class="step-number">1</div>
                        <div>
                            <div class="fw-semibold">Completa el formulario</div>
                            <div class="small text-white-50">Datos de contacto, origen, destino y tipo de carga.</div>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mb-4">
                        <div class="step-number">2</div>
                        <div>
                            <div class="fw-semibold">Revisamos la solicitud</div>
                            <div class="small text-white-50">El equipo la acepta y prepara la cotización.</div>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="step-number">3</div>
                        <div>
                            <div class="fw-semibold">Recibes tu cotización</div>
                            <div class="small text-white-50">Te llega por correo con el detalle del servicio.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<section id="como-funciona" class="py-5">
    <div class="container py-lg-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-2">Todo el proceso en un solo lugar</h2>
            <p class="text-muted mb-0">Solicitudes, cotizaciones y choferes gestionados desde la misma plataforma.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card p-4">
                    <div class="feature-icon mb-3"><i class="bi bi-clipboard-check"></i></div>
                    <h3 class="h6 fw-bold">Solicitudes centralizadas</h3>
                    <p class="text-muted small mb-0">
                        Cada solicitud queda registrada con toda la información de la ruta y la carga.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card p-4">
                    <div class="feature-icon mb-3"><i class="bi bi-envelope-paper"></i></div>
                    <h3 class="h6 fw-bold">Cotizaciones por correo</h3>
                    <p class="text-muted small mb-0">
                        Al aceptar una solicitud, el cliente recibe la cotización en PDF directamente en su correo.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card p-4">
                    <div class="feature-icon mb-3"><i class="bi bi-people"></i></div>
                    <h3 class="h6 fw-bold">Choferes y documentos</h3>
                    <p class="text-muted small mb-0">
                        Administra los choferes y sus documentos para asignarlos a cada servicio.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pb-5">
    <div class="container">
        <div class="cta-band p-4 p-md-5">
            <div class="row align-items-center g-3">
                <div class="col-md-8">
                    <h2 class="h4 fw-bold mb-1">¿Listo para cotizar tu servicio?</h2>
                    <p class="mb-0 text-white-50">Toma menos de 3 minutos completar la solicitud.</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('formulario.show') }}" class="btn btn-cta btn-lg w-100 w-md-auto">
                        <i class="bi bi-arrow-right-circle me-2"></i>Ir al formulario
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="py-4">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 small">
        <span>T.C.R S.A.S &middot; Nit 901101398-8</span>
        <a href="{{ route('admin.login.show') }}" class="text-decoration-none text-white-50">Acceso administradores</a>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

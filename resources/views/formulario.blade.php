<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Cotización de Transporte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body.bg-light {
            background: radial-gradient(1200px 600px at 20% -10%, rgba(13, 110, 253, 0.12), transparent 55%),
                        radial-gradient(1000px 600px at 90% 0%, rgba(32, 201, 151, 0.10), transparent 50%),
                        #f8f9fa;
        }
        .hero-card {
            border: 0;
            border-radius: 1rem;
            background: linear-gradient(135deg, rgba(13,110,253,0.10), rgba(32,201,151,0.08));
        }
        .form-shell {
            border: 0;
            border-radius: 1rem;
            overflow: hidden;
        }
        .section-card {
            border-radius: 0.9rem;
            border: 1px solid rgba(0,0,0,0.06);
        }
        .section-title {
            font-weight: 700;
            letter-spacing: 0.2px;
        }
        .form-control,
        .form-select {
            border-radius: 0.75rem;
            padding-top: 0.7rem;
            padding-bottom: 0.7rem;
        }
        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,0.15);
        }
        .btn-primary.btn-cta {
            border-radius: 0.85rem;
            padding: 0.9rem 1rem;
            font-weight: 700;
            letter-spacing: 0.2px;
            background-image: linear-gradient(135deg, #0d6efd, #20c997);
            border: 0;
        }
        .btn-primary.btn-cta:hover {
            filter: brightness(0.98);
        }
    </style>
</head>
<body class="bg-light">
<div class="container py-4 py-md-5 px-3 px-md-0" style="max-width: 980px;">
    <div class="card hero-card shadow-sm mb-4">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div>
                    <h1 class="mb-2">Solicitud de Cotización de Transporte</h1>
                    <p class="mb-0 text-secondary">Completa tus datos y te responderemos con una propuesta.</p>
                </div>
                <div class="text-md-end">
                    <span class="badge text-bg-primary-subtle border border-primary-subtle rounded-pill px-3 py-2">Tiempo estimado: 2-3 min</span>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('formulario.enviar') }}" method="POST" class="card form-shell shadow-sm bg-white">
        @csrf
        <div class="card-body p-3 p-md-4">
            <div class="card section-card mb-4 shadow-sm">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <div class="d-flex align-items-center justify-content-between gap-2">
                        <h4 class="mb-0 section-title">Sección 1: Datos de Contacto</h4>
                        <span class="badge text-bg-light border">Obligatorio</span>
                    </div>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre_completo" class="form-label">Nombre Completo *</label>
                            <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" required>
                        </div>
                        <div class="col-md-6">
                            <label for="empresa" class="form-label">Empresa (Opcional)</label>
                            <input type="text" class="form-control" id="empresa" name="empresa">
                        </div>
                    </div>

                    <div class="row g-3 mt-0">
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono (incluir código de país) *</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" required>
                        </div>
                        <div class="col-md-6">
                            <label for="correo" class="form-label">Correo Electrónico *</label>
                            <input type="email" class="form-control" id="correo" name="correo" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card section-card mb-4 shadow-sm">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h4 class="mb-0 section-title">Sección 2: Detalles de la Ruta</h4>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="pais_origen" class="form-label">País de Origen</label>
                            <select id="pais_origen" name="pais_origen" class="form-select">
                                <option value="Colombia" selected>Colombia</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Panamá">Panamá</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="ciudad_origen" class="form-label">Ciudad/Departamento</label>
                            <input type="text" class="form-control" id="ciudad_origen" name="ciudad_origen" placeholder="Ej: Bogotá, Medellín, Cali...">
                        </div>
                    </div>

                    <div class="row g-3 mt-0">
                        <div class="col-md-6">
                            <label for="pais_destino" class="form-label">País de Destino</label>
                            <select id="pais_destino" name="pais_destino" class="form-select">
                                <option value="Venezuela" selected>Venezuela</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Panamá">Panamá</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="ciudad_destino" class="form-label">Ciudad/Estado de Entrega</label>
                            <input type="text" class="form-control" id="ciudad_destino" name="ciudad_destino" placeholder="Ej: Caracas, Valencia, Maracaibo...">
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Fecha Estimada *</label>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="fecha_inicial" class="form-label">Fecha inicial *</label>
                                <input type="date" class="form-control" id="fecha_inicial" name="fecha_inicial" required>
                            </div>
                            <div class="col-md-6">
                                <label for="fecha_final" class="form-label">Fecha final *</label>
                                <input type="date" class="form-control" id="fecha_final" name="fecha_final" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card section-card mb-4 shadow-sm">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h4 class="mb-0 section-title">Sección 3: Descripción de la Carga</h4>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="tipo_carga" class="form-label">Tipo de Carga</label>
                            <select id="tipo_carga" name="tipo_carga" class="form-select">
                                <option value="Carga Seca">Carga Seca</option>
                                <option value="Perecederos">Perecederos</option>
                                <option value="Maquinaria/Pesada">Maquinaria/Pesada</option>
                                <option value="Quimicos">Químicos</option>
                                <option value="Otros">Otros</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label d-block">Tipo de Servicio</label>
                            <div class="p-3 rounded-3 border bg-light-subtle">
                                <div class="form-check form-check-inline mb-0">
                                    <input class="form-check-input" type="radio" name="tipo_servicio" id="servicio_ftl" value="FTL" checked>
                                    <label class="form-check-label" for="servicio_ftl">FTL (Contenedor/Camión Completo)</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-0">
                        <div class="col-md-6">
                            <label for="cantidad_bultos" class="form-label">Cantidad de Bultos/Paletas</label>
                            <input type="number" class="form-control" id="cantidad_bultos" name="cantidad_bultos" placeholder="Ej: 25 cajas, 10 paletas...">
                        </div>
                        <div class="col-md-6">
                            <label for="peso_bruto" class="form-label">Peso Bruto Total (Kg)</label>
                            <input type="number" step="0.01" class="form-control" id="peso_bruto" name="peso_bruto" placeholder="Ej: 1500">
                        </div>
                    </div>

                    <div class="mt-3">
                        <label for="dimensiones" class="form-label">Dimensiones Aproximadas</label>
                        <textarea class="form-control" id="dimensiones" name="dimensiones" rows="3" placeholder="Indicar Largo x Ancho x Alto (en metros o cm)"></textarea>
                    </div>

                    <div class="mt-3">
                        <label class="form-label d-block">¿Necesitas servicios aduaneros?</label>
                        <div class="p-3 rounded-3 border bg-light-subtle">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="servicios_aduaneros" id="aduanas_si" value="Si" checked>
                                <label class="form-check-label" for="aduanas_si">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="servicios_aduaneros" id="aduanas_no" value="No">
                                <label class="form-check-label" for="aduanas_no">No</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-cta btn-lg">Enviar solicitud</button>
                <div class="text-center text-secondary small">Al enviar, confirmas que la información es correcta.</div>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

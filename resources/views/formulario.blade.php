<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Cotización de Transporte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4 py-md-5 px-3 px-md-0">
    <h1 class="mb-4">Solicitud de Cotización de Transporte</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('formulario.enviar') }}" method="POST" class="card p-3 p-md-4 shadow-sm bg-white">
        @csrf

        <h4 class="mb-3">Sección 1: Datos de Contacto</h4>
        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <label for="nombre_completo" class="form-label">Nombre Completo *</label>
                <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="empresa" class="form-label">Empresa (Opcional)</label>
                <input type="text" class="form-control" id="empresa" name="empresa">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <label for="telefono" class="form-label">Teléfono (incluir código de país) *</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="correo" class="form-label">Correo Electrónico *</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
        </div>

        <hr class="my-4">

        <h4 class="mb-3">Sección 2: Detalles de la Ruta</h4>
        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <label for="pais_origen" class="form-label">País de Origen</label>
                <select id="pais_origen" name="pais_origen" class="form-select">
                    <option value="Colombia" selected>Colombia</option>
                    <option value="Venezuela">Venezuela</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="ciudad_origen" class="form-label">Ciudad/Departamento</label>
                <input type="text" class="form-control" id="ciudad_origen" name="ciudad_origen" placeholder="Ej: Bogotá, Medellín, Cali...">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <label for="pais_destino" class="form-label">País de Destino</label>
                <select id="pais_destino" name="pais_destino" class="form-select">
                    <option value="Venezuela" selected>Venezuela</option>
                    <option value="Colombia">Colombia</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="ciudad_destino" class="form-label">Ciudad/Estado de Entrega</label>
                <input type="text" class="form-control" id="ciudad_destino" name="ciudad_destino" placeholder="Ej: Caracas, Valencia, Maracaibo...">
            </div>
        </div>

        <div class="mb-3">
            <label for="fecha_recogida" class="form-label">Fecha Estimada *</label>
            <input type="date" class="form-control" id="fecha_recogida" name="fecha_recogida" required>
        </div>

        <hr class="my-4">

        <h4 class="mb-3">Sección 3: Descripción de la Carga</h4>
        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <label for="tipo_carga" class="form-label">Tipo de Carga</label>
                <select id="tipo_carga" name="tipo_carga" class="form-select">
                    <option value="Carga Seca">Carga Seca</option>
                    <option value="Perecederos">Perecederos</option>
                    <option value="Maquinaria/Pesada">Maquinaria/Pesada</option>
                    <option value="Quimicos">Químicos</option>
                    <option value="Otros">Otros</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label d-block">Tipo de Servicio</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo_servicio" id="servicio_ftl" value="FTL" checked>
                    <label class="form-check-label" for="servicio_ftl">FTL (Contenedor/Camión Completo)</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo_servicio" id="servicio_ltl" value="LTL">
                    <label class="form-check-label" for="servicio_ltl">LTL (Carga Consolidada/Parcial)</label>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <label for="cantidad_bultos" class="form-label">Cantidad de Bultos/Paletas</label>
                <input type="number" class="form-control" id="cantidad_bultos" name="cantidad_bultos" placeholder="Ej: 25 cajas, 10 paletas...">
            </div>
            <div class="col-md-6 mb-3">
                <label for="peso_bruto" class="form-label">Peso Bruto Total (Kg)</label>
                <input type="number" step="0.01" class="form-control" id="peso_bruto" name="peso_bruto" placeholder="Ej: 1500">
            </div>
        </div>

        <div class="mb-3">
            <label for="dimensiones" class="form-label">Dimensiones Aproximadas</label>
            <textarea class="form-control" id="dimensiones" name="dimensiones" rows="3" placeholder="Indicar Largo x Ancho x Alto (en metros o cm)"></textarea>
        </div>

        <div class="mb-4">
            <label class="form-label d-block">¿Necesitas servicios aduaneros?</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="servicios_aduaneros" id="aduanas_si" value="Si" checked>
                <label class="form-check-label" for="aduanas_si">Sí</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="servicios_aduaneros" id="aduanas_no" value="No">
                <label class="form-check-label" for="aduanas_no">No</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Enviar solicitud</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

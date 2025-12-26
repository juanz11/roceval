@php
    $isEdit = isset($chofer);
@endphp

<div class="row mb-3">
    <div class="col-md-6 mb-3">
        <label for="nombre" class="form-label">Nombres *</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required value="{{ old('nombre', $chofer->nombre ?? '') }}">
        @error('nombre')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="apellidos" class="form-label">Apellidos *</label>
        <input type="text" class="form-control" id="apellidos" name="apellidos" required value="{{ old('apellidos', $chofer->apellidos ?? '') }}">
        @error('apellidos')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="cedula" class="form-label">Cédula *</label>
        <input type="text" class="form-control" id="cedula" name="cedula" required value="{{ old('cedula', $chofer->cedula ?? '') }}">
        @error('cedula')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
</div>

<hr class="my-4">

<h5 class="mb-3">Chuto</h5>
<div class="row mb-3">
    <div class="col-md-3 mb-3">
        <label for="placa_chuto" class="form-label">Placa chuto</label>
        <input type="text" class="form-control" id="placa_chuto" name="placa_chuto" value="{{ old('placa_chuto', $chofer->placa_chuto ?? '') }}">
        @error('placa_chuto')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label for="marca_chuto" class="form-label">Marca chuto</label>
        <input type="text" class="form-control" id="marca_chuto" name="marca_chuto" value="{{ old('marca_chuto', $chofer->marca_chuto ?? '') }}">
        @error('marca_chuto')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label for="ano_chuto" class="form-label">Año chuto</label>
        <input type="number" class="form-control" id="ano_chuto" name="ano_chuto" min="1900" max="2100" value="{{ old('ano_chuto', $chofer->ano_chuto ?? '') }}">
        @error('ano_chuto')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label for="color_chuto" class="form-label">Color chuto</label>
        <input type="text" class="form-control" id="color_chuto" name="color_chuto" value="{{ old('color_chuto', $chofer->color_chuto ?? '') }}">
        @error('color_chuto')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
</div>

<hr class="my-4">

<h5 class="mb-3">Batea</h5>
<div class="row mb-3">
    <div class="col-md-3 mb-3">
        <label for="placa_batea" class="form-label">Placa batea</label>
        <input type="text" class="form-control" id="placa_batea" name="placa_batea" value="{{ old('placa_batea', $chofer->placa_batea ?? '') }}">
        @error('placa_batea')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label for="marca_batea" class="form-label">Marca batea</label>
        <input type="text" class="form-control" id="marca_batea" name="marca_batea" value="{{ old('marca_batea', $chofer->marca_batea ?? '') }}">
        @error('marca_batea')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label for="ano_batea" class="form-label">Año batea</label>
        <input type="number" class="form-control" id="ano_batea" name="ano_batea" min="1900" max="2100" value="{{ old('ano_batea', $chofer->ano_batea ?? '') }}">
        @error('ano_batea')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label for="color_batea" class="form-label">Color batea</label>
        <input type="text" class="form-control" id="color_batea" name="color_batea" value="{{ old('color_batea', $chofer->color_batea ?? '') }}">
        @error('color_batea')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
</div>

<hr class="my-4">

<h5 class="mb-3">Contenedor</h5>
<div class="row mb-3">
    <div class="col-md-4 mb-3">
        <label for="numero_contenedor" class="form-label">Número contenedor</label>
        <input type="text" class="form-control" id="numero_contenedor" name="numero_contenedor" value="{{ old('numero_contenedor', $chofer->numero_contenedor ?? '') }}">
        @error('numero_contenedor')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label for="marca_contenedor" class="form-label">Marca contenedor</label>
        <input type="text" class="form-control" id="marca_contenedor" name="marca_contenedor" value="{{ old('marca_contenedor', $chofer->marca_contenedor ?? '') }}">
        @error('marca_contenedor')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label for="color_contenedor" class="form-label">Color contenedor</label>
        <input type="text" class="form-control" id="color_contenedor" name="color_contenedor" value="{{ old('color_contenedor', $chofer->color_contenedor ?? '') }}">
        @error('color_contenedor')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
</div>

<hr class="my-4">

<h5 class="mb-3">Documentos</h5>

@if($isEdit)
    <div class="mb-3">
        <div class="table-responsive">
            <table class="table table-sm table-bordered align-middle mb-0">
                <thead>
                <tr>
                    <th>Título</th>
                    <th>Archivo</th>
                    <th style="width: 1%;">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse(($chofer->documentos ?? []) as $doc)
                    <tr>
                        <td>{{ $doc->titulo }}</td>
                        <td>
                            <a href="{{ \Illuminate\Support\Facades\Storage::url($doc->ruta_archivo) }}" target="_blank" rel="noopener">{{ $doc->nombre_original ?? 'Ver archivo' }}</a>
                        </td>
                        <td>
                            <form action="{{ route('admin.choferes.documentos.destroy', [$chofer, $doc]) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este documento?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">Sin documentos cargados.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="fw-semibold">Agregar documentos</div>
            <button type="button" class="btn btn-sm btn-outline-primary" id="btnAddDoc">Agregar documento</button>
        </div>

        <div id="docsContainer" class="d-grid gap-2"></div>

        <div class="text-muted small mt-2">
            Puedes agregar varios documentos (ej: Cédula, Licencia, etc.).
        </div>
    </div>
</div>

<template id="docRowTemplate">
    <div class="row g-2 align-items-end doc-row">
        <div class="col-md-5">
            <label class="form-label">Título</label>
            <input type="text" class="form-control" name="documentos_titulo[]" placeholder="Ej: Cédula">
        </div>
        <div class="col-md-6">
            <label class="form-label">Archivo</label>
            <input type="file" class="form-control" name="documentos_archivo[]">
        </div>
        <div class="col-md-1 d-grid">
            <button type="button" class="btn btn-outline-danger btn-remove-doc">X</button>
        </div>
    </div>
</template>

<script>
    (function () {
        const btnAdd = document.getElementById('btnAddDoc');
        const container = document.getElementById('docsContainer');
        const tpl = document.getElementById('docRowTemplate');

        if (!btnAdd || !container || !tpl) return;

        function addRow() {
            const node = tpl.content.cloneNode(true);
            container.appendChild(node);
        }

        btnAdd.addEventListener('click', addRow);

        container.addEventListener('click', function (e) {
            const btn = e.target.closest('.btn-remove-doc');
            if (!btn) return;
            const row = btn.closest('.doc-row');
            if (row) row.remove();
        });

        addRow();
    })();
</script>

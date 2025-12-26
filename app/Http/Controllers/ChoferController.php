<?php

namespace App\Http\Controllers;

use App\Models\Chofer;
use App\Models\ChoferDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChoferController extends Controller
{
    private function ensureAdmin()
    {
        if (!session('is_admin')) {
            return redirect()->route('admin.login.show');
        }

        return null;
    }

    public function index()
    {
        if ($redirect = $this->ensureAdmin()) {
            return $redirect;
        }

        $choferes = Chofer::orderByDesc('created_at')->paginate(20);

        return view('admin.choferes.index', compact('choferes'));
    }

    public function create()
    {
        if ($redirect = $this->ensureAdmin()) {
            return $redirect;
        }

        return view('admin.choferes.create');
    }

    public function store(Request $request)
    {
        if ($redirect = $this->ensureAdmin()) {
            return $redirect;
        }

        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'cedula' => 'required|string|max:255|unique:choferes,cedula',

            'placa_chuto' => 'nullable|string|max:255',
            'marca_chuto' => 'nullable|string|max:255',
            'ano_chuto' => 'nullable|integer|min:1900|max:2100',
            'color_chuto' => 'nullable|string|max:255',

            'placa_batea' => 'nullable|string|max:255',
            'ano_batea' => 'nullable|integer|min:1900|max:2100',
            'marca_batea' => 'nullable|string|max:255',
            'color_batea' => 'nullable|string|max:255',

            'numero_contenedor' => 'nullable|string|max:255',
            'marca_contenedor' => 'nullable|string|max:255',
            'color_contenedor' => 'nullable|string|max:255',

            'documentos_titulo' => 'nullable|array',
            'documentos_titulo.*' => 'nullable|string|max:255',
            'documentos_archivo' => 'nullable|array',
            'documentos_archivo.*' => 'nullable|file|max:10240',
        ]);

        $chofer = Chofer::create($data);

        $this->guardarDocumentosDesdeRequest($request, $chofer);

        return redirect()->route('admin.choferes.index')->with('success', 'Chofer creado correctamente.');
    }

    public function show(Chofer $chofer)
    {
        if ($redirect = $this->ensureAdmin()) {
            return $redirect;
        }

        $chofer->load('documentos');

        return view('admin.choferes.show', compact('chofer'));
    }

    public function edit(Chofer $chofer)
    {
        if ($redirect = $this->ensureAdmin()) {
            return $redirect;
        }

        $chofer->load('documentos');

        return view('admin.choferes.edit', compact('chofer'));
    }

    public function update(Request $request, Chofer $chofer)
    {
        if ($redirect = $this->ensureAdmin()) {
            return $redirect;
        }

        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'cedula' => 'required|string|max:255|unique:choferes,cedula,' . $chofer->id,

            'placa_chuto' => 'nullable|string|max:255',
            'marca_chuto' => 'nullable|string|max:255',
            'ano_chuto' => 'nullable|integer|min:1900|max:2100',
            'color_chuto' => 'nullable|string|max:255',

            'placa_batea' => 'nullable|string|max:255',
            'ano_batea' => 'nullable|integer|min:1900|max:2100',
            'marca_batea' => 'nullable|string|max:255',
            'color_batea' => 'nullable|string|max:255',

            'numero_contenedor' => 'nullable|string|max:255',
            'marca_contenedor' => 'nullable|string|max:255',
            'color_contenedor' => 'nullable|string|max:255',

            'documentos_titulo' => 'nullable|array',
            'documentos_titulo.*' => 'nullable|string|max:255',
            'documentos_archivo' => 'nullable|array',
            'documentos_archivo.*' => 'nullable|file|max:10240',
        ]);

        $chofer->update($data);

        $this->guardarDocumentosDesdeRequest($request, $chofer);

        return redirect()->route('admin.choferes.edit', $chofer)->with('success', 'Chofer actualizado correctamente.');
    }

    public function destroy(Chofer $chofer)
    {
        if ($redirect = $this->ensureAdmin()) {
            return $redirect;
        }

        $chofer->load('documentos');
        foreach ($chofer->documentos as $doc) {
            Storage::disk('public')->delete($doc->ruta_archivo);
        }

        Storage::disk('public')->deleteDirectory('choferes/' . $chofer->id);

        $chofer->delete();

        return redirect()->route('admin.choferes.index')->with('success', 'Chofer eliminado correctamente.');
    }

    public function destroyDocumento(Chofer $chofer, ChoferDocumento $documento)
    {
        if ($redirect = $this->ensureAdmin()) {
            return $redirect;
        }

        if ((int) $documento->chofer_id !== (int) $chofer->id) {
            abort(404);
        }

        Storage::disk('public')->delete($documento->ruta_archivo);
        $documento->delete();

        return redirect()->route('admin.choferes.edit', $chofer)->with('success', 'Documento eliminado correctamente.');
    }

    private function guardarDocumentosDesdeRequest(Request $request, Chofer $chofer): void
    {
        $titulos = $request->input('documentos_titulo', []);
        $archivos = $request->file('documentos_archivo', []);

        foreach ($archivos as $i => $archivo) {
            if (!$archivo) {
                continue;
            }

            $titulo = $titulos[$i] ?? null;
            if (!$titulo) {
                $titulo = 'Documento';
            }

            $path = $archivo->store('choferes/' . $chofer->id . '/documentos', 'public');

            ChoferDocumento::create([
                'chofer_id' => $chofer->id,
                'titulo' => $titulo,
                'ruta_archivo' => $path,
                'nombre_original' => $archivo->getClientOriginalName(),
                'mime' => $archivo->getClientMimeType(),
                'tamano' => $archivo->getSize(),
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chofer;
use Illuminate\Http\Request;

class ChoferController extends Controller
{
    public function index(Request $request)
    {
        $query = Chofer::query()->orderByDesc('created_at');

        if ($search = $request->query('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', '%' . $search . '%')
                    ->orWhere('apellidos', 'like', '%' . $search . '%')
                    ->orWhere('cedula', 'like', '%' . $search . '%')
                    ->orWhere('placa_chuto', 'like', '%' . $search . '%')
                    ->orWhere('placa_batea', 'like', '%' . $search . '%');
            });
        }

        return response()->json($query->paginate(20));
    }

    public function show(Chofer $chofer)
    {
        $chofer->load('documentos');
        return response()->json($chofer);
    }

    public function store(Request $request)
    {
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
        ]);

        $chofer = Chofer::create($data);

        return response()->json($chofer, 201);
    }

    public function update(Request $request, Chofer $chofer)
    {
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
        ]);

        $chofer->update($data);

        return response()->json($chofer);
    }

    public function destroy(Chofer $chofer)
    {
        $chofer->delete();
        return response()->json(['message' => 'Deleted.']);
    }
}

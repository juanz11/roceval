<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cotizacion;
use App\Models\Solicitud;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function index()
    {
        return response()->json(Solicitud::latest()->paginate(20));
    }

    public function historial()
    {
        return response()->json(Solicitud::orderByDesc('created_at')->paginate(50));
    }

    public function show(Solicitud $solicitud)
    {
        $solicitud->load('cotizacion');
        return response()->json($solicitud);
    }

    public function aceptar(Solicitud $solicitud)
    {
        $solicitud->update(['estado' => 'aceptada']);
        return response()->json(['message' => 'Solicitud aceptada.', 'solicitud' => $solicitud]);
    }

    public function rechazar(Solicitud $solicitud)
    {
        $solicitud->update(['estado' => 'rechazada']);
        return response()->json(['message' => 'Solicitud rechazada.', 'solicitud' => $solicitud]);
    }

    public function guardarCotizacion(Request $request, Solicitud $solicitud)
    {
        $data = $request->validate([
            'precio_total' => 'required|numeric|min:0',
            'moneda' => 'required|string|max:10',
            'tiempo_transito' => 'nullable|string|max:255',
            'validez_oferta' => 'nullable|string|max:255',
            'incluye_aduanas' => 'required|boolean',
            'incluye_seguro' => 'required|boolean',
            'observaciones' => 'nullable|string',
        ]);

        $data['incluye_aduanas'] = (bool) $data['incluye_aduanas'];
        $data['incluye_seguro'] = (bool) $data['incluye_seguro'];

        $cotizacion = Cotizacion::updateOrCreate(
            ['solicitud_id' => $solicitud->id],
            $data
        );

        $solicitud->update(['estado' => 'cotizada']);

        $cotizacion->load('solicitud');

        return response()->json([
            'message' => 'Cotización guardada.',
            'cotizacion' => $cotizacion,
        ]);
    }
}

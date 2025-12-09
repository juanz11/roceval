<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Cotizacion;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre_completo'    => 'required|string|max:255',
            'empresa'            => 'nullable|string|max:255',
            'telefono'           => 'required|string|max:50',
            'correo'             => 'required|email|max:255',
            'pais_origen'        => 'nullable|string|max:255',
            'ciudad_origen'      => 'nullable|string|max:255',
            'pais_destino'       => 'nullable|string|max:255',
            'ciudad_destino'     => 'nullable|string|max:255',
            'fecha_recogida'     => 'required|date',
            'tipo_carga'         => 'nullable|string|max:255',
            'tipo_servicio'      => 'nullable|string|max:255',
            'cantidad_bultos'    => 'nullable|integer',
            'peso_bruto'         => 'nullable|numeric',
            'dimensiones'        => 'nullable|string',
            'servicios_aduaneros'=> 'nullable|string|max:10',
        ]);

        Solicitud::create($data);

        return redirect()
            ->route('formulario.show')
            ->with('success', 'Gracias por completar el formulario. Tu solicitud ha sido enviada correctamente.');
    }

    public function index()
    {
        if (!session('is_admin')) {
            return redirect()->route('admin.login.show');
        }

        $solicitudes = Solicitud::latest()->paginate(20);

        return view('admin.solicitudes.index', compact('solicitudes'));
    }

    public function historial()
    {
        if (!session('is_admin')) {
            return redirect()->route('admin.login.show');
        }

        $solicitudes = Solicitud::orderByDesc('created_at')->paginate(50);

        return view('admin.solicitudes.historial', compact('solicitudes'));
    }

    public function aceptar(Solicitud $solicitud)
    {
        if (!session('is_admin')) {
            return redirect()->route('admin.login.show');
        }

        $solicitud->update(['estado' => 'aceptada']);

        return redirect()->back()->with('success', 'Solicitud aceptada correctamente.');
    }

    public function rechazar(Solicitud $solicitud)
    {
        if (!session('is_admin')) {
            return redirect()->route('admin.login.show');
        }

        $solicitud->update(['estado' => 'rechazada']);

        return redirect()->back()->with('success', 'Solicitud rechazada correctamente.');
    }

    public function cotizar(Solicitud $solicitud)
    {
        if (!session('is_admin')) {
            return redirect()->route('admin.login.show');
        }
        $cotizacion = $solicitud->cotizacion;

        return view('admin.solicitudes.cotizar', compact('solicitud', 'cotizacion'));
    }

    public function guardarCotizacion(Request $request, Solicitud $solicitud)
    {
        if (!session('is_admin')) {
            return redirect()->route('admin.login.show');
        }

        $data = $request->validate([
            'precio_total'    => 'required|numeric|min:0',
            'moneda'          => 'required|string|max:10',
            'tiempo_transito' => 'nullable|string|max:255',
            'validez_oferta'  => 'nullable|string|max:255',
            'incluye_aduanas' => 'required|boolean',
            'incluye_seguro'  => 'required|boolean',
            'observaciones'   => 'nullable|string',
        ]);

        $data['incluye_aduanas'] = (bool) $data['incluye_aduanas'];
        $data['incluye_seguro'] = (bool) $data['incluye_seguro'];

        Cotizacion::updateOrCreate(
            ['solicitud_id' => $solicitud->id],
            $data
        );

        $solicitud->update(['estado' => 'cotizada']);

        return redirect()
            ->route('admin.cotizaciones.show', $solicitud->cotizacion ?? $solicitud->refresh()->cotizacion)
            ->with('success', 'Cotización guardada correctamente.');
    }

    public function verCotizacion(Cotizacion $cotizacion)
    {
        if (!session('is_admin')) {
            return redirect()->route('admin.login.show');
        }

        $cotizacion->load('solicitud');

        return view('admin.cotizaciones.show', compact('cotizacion'));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    /**
     * Tabla asociada al modelo.
     */
    protected $table = 'solicitudes';

    protected $fillable = [
        'nombre_completo',
        'empresa',
        'telefono',
        'correo',
        'pais_origen',
        'ciudad_origen',
        'pais_destino',
        'ciudad_destino',
        'fecha_inicial',
        'fecha_final',
        'fecha_recogida',
        'tipo_carga',
        'tipo_servicio',
        'cantidad_bultos',
        'peso_bruto',
        'dimensiones',
        'servicios_aduaneros',
        'estado',
    ];

    public function cotizacion()
    {
        return $this->hasOne(Cotizacion::class);
    }
}

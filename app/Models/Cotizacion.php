<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $table = 'cotizaciones';

    protected $fillable = [
        'solicitud_id',
        'precio_total',
        'moneda',
        'tiempo_transito',
        'validez_oferta',
        'incluye_aduanas',
        'incluye_seguro',
        'observaciones',
    ];

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class);
    }
}

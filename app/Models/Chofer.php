<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chofer extends Model
{
    use HasFactory;

    protected $table = 'choferes';

    protected $fillable = [
        'nombre',
        'apellidos',
        'cedula',
        'placa_chuto',
        'marca_chuto',
        'ano_chuto',
        'color_chuto',
        'placa_batea',
        'ano_batea',
        'marca_batea',
        'color_batea',
        'numero_contenedor',
        'marca_contenedor',
        'color_contenedor',
    ];

    public function documentos()
    {
        return $this->hasMany(ChoferDocumento::class);
    }
}

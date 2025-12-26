<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChoferDocumento extends Model
{
    use HasFactory;

    protected $table = 'chofer_documentos';

    protected $fillable = [
        'chofer_id',
        'titulo',
        'ruta_archivo',
        'nombre_original',
        'mime',
        'tamano',
    ];

    public function chofer()
    {
        return $this->belongsTo(Chofer::class);
    }
}

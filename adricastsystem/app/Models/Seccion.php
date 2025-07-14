<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    use HasFactory;
    protected $table = 'secciones';
    protected $fillable = [
    'nombre',
    'descripcion',
    'icono',
    'estado',
    ];
     public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'modulo_id');
    }

    public function seccion()
    {
        return $this->belongsTo(Seccion::class, 'seccion_id');
    }
}

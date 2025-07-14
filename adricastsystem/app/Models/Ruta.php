<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    use HasFactory;

    protected $fillable = [
        'modulo_id',
        'nombre',
        'url',
        'descripcion',
        'metodo',
        'convencion',
        'estado',
        'requiere_autenticacion',
    ];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }
    public function restricciones()
    {
        return $this->hasMany(RestriccionRuta::class, 'ruta_id');
    }
}

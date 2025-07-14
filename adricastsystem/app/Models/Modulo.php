<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;
    protected $table = 'modulos';
    protected $fillable = [
        'nombre',
        'descripcion',
        'ruta',
        'icono',
        'estado',
    ];
    public function rutas()
    {
        return $this->hasMany(Ruta::class);
    }
    public function secciones()
{
    return $this->belongsToMany(Seccion::class, 'modulo_seccion', 'modulo_id', 'seccion_id');
}
}

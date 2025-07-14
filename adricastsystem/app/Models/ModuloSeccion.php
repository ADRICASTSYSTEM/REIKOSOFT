<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuloSeccion extends Model
{
    use HasFactory;
    protected $table = 'modulo_seccion'; // nombre exacto de la tabla

    protected $fillable = [
        'modulo_id',
        'seccion_id',
        'estado',
    ];

    // Relaciones opcionales, si quieres acceder al módulo o sección desde este modelo:
    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }

    public function seccion()
    {
        return $this->belongsTo(Seccion::class);
    }
}

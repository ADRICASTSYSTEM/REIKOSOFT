<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles'; // Asegúrate que apunte a la tabla correcta

    protected $fillable = [
        'id_tipousuarios',
        'id_modulos',
        'estado',
    ];

    // Relaciones
    public function tipoUsuario()
    {
        return $this->belongsTo(TipoUsuario::class, 'id_tipousuarios');
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'id_modulos');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contactoweb extends Model
{

    use HasFactory;
    protected $table = 'contactanos';
    protected $fillable = [
        'nombre',
        'telefono',
        'asunto',
        'correo',
        'mensaje',
        'status',
        'estado',
    
    ];
}

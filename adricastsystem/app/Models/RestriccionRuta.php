<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestriccionRuta extends Model
{
    use HasFactory;

      use HasFactory;

    protected $table = 'restriccion_rutas';

    protected $fillable = [
        'user_id',
        'ruta_id',
        'estado',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ruta()
    {
        return $this->belongsTo(Ruta::class, 'ruta_id');
    }
}

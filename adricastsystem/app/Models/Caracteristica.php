<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    use HasFactory;
    protected $table = 'caracteristicas';
    protected $fillable = [
        'descripcion',
        'foto',
        'estado',
    ];
   
    public function subcaracteristicas()
    {
        return $this->hasMany(Subcaracteristica::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}

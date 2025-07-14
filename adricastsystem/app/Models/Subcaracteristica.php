<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcaracteristica extends Model
{
    use HasFactory;
    protected $table = 'subcaracteristicas';
    protected $fillable = [
        'descripcion',
        'foto',
        'estado',
    ];
    public function caracteristica()
    {
        return $this->belongsTo(Caracteristica::class, 'caracteristica_id');
    }
}

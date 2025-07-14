<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $table = 'categorias';
    protected $fillable = [
        'nombre',
        'foto', // 'foto' is a column in the 'categorias' table
        'descripcion',
        'estado',
    ];
    public function productos()
{
    return $this->hasMany(Producto::class, 'categoria_id');
}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'productos';
    protected $fillable = [
        'nombre',
        'descripcion',
        'foto',
        'marca_id',
        'categoria_id',
        'precio',
        'stock',
        'codigo',
        'en_oferta',
        'precio_oferta',
        'publicar_web',
        'linkdecompra',
        'en_stock',
        'tipo_producto_id',

        'estado',
    ];
    public function tipoproducto()
    {
        return $this->belongsTo(TipoProducto::class, 'tipo_id');
    }
   
    public function categoriaproducto()
{
    return $this->belongsTo(Categoria::class, 'categoria_id');
}

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }
    
}

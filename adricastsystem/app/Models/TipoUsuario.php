<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    use HasFactory;
    protected $table = 'tipo_usuarios';
    protected $fillable = [
        'descripcion',
        'estado',
       
        
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function roles()
    {
        return $this->hasMany(Rol::class, 'id_tipousuarios', 'id');
    }
}

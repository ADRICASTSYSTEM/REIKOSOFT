<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Modulo;
use App\Models\Rol;
use App\Models\Seccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $rutaConcat;
    public function __construct()
    {
        $this->middleware('auth');
        $this->rutaConcat = config('app.ruta_concat');
    }
    public function index(User $user){
        $typeUser = auth()->user()->typeUser;
      
        $user = Auth::user();
        if ($typeUser) {
            $descripcion = $typeUser->descripcion;
        } else {
            $descripcion = 'No asignado';
        }
        $moduloIds = Rol::where('estado', 1)->pluck('id_modulos')->unique();
        $modulos = Modulo::whereIn('id', $moduloIds)->get();
        $secciones=Seccion::all();
       return view('reikosoft.presentacion', compact('descripcion','user','modulos','secciones'));
       
    }
// Devuelve todos los módulos
public function modulosTodos()
{
    // Ejemplo simple, ajusta según tu lógica
    $modulos = Modulo::all();
    return response()->json($modulos);
}

// Devuelve módulos según sección
public function modulosPorSeccion($seccion_id)
{
    // Tu lógica para filtrar por sección
    $modulos = Modulo::whereHas('secciones', function($q) use ($seccion_id) {
        $q->where('seccion_id', $seccion_id);
    })->get();

    return response()->json($modulos);
}



}

<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use Illuminate\Http\Request;
use App\Models\Caracteristica;
use App\Models\Rol;
use App\Models\Seccion;
use Illuminate\Support\Facades\Auth;

class CaracteristicasController extends Controller
{
    //
      //
  
      protected $rutaConcat;
      public function __construct()
      {
          $this->middleware('auth');
          $this->rutaConcat = config('app.ruta_concat');
      }
      public function index()
      {
          $typeUser = auth()->user()->typeUser;
        
          $user = Auth::user();
          if ($typeUser) {
              $descripcion = $typeUser->descripcion;
          } else {
              $descripcion = 'No asignado';
          }
          $moduloIds = Rol::where('estado', 1)->pluck('id_modulos')->unique();
          $modulos = Modulo::whereIn('id', $moduloIds)->get();
          $secciones = Seccion::all();
       
          return view('reikosoft.caracteristicas.index', compact('descripcion','user','modulos','secciones'));
  
      }

      public function consultarCaracteristicasProducto($id_producto)
      {
          // Obtener todas las características del producto con el ID proporcionado
          $caracteristicas = Caracteristica::with('subcaracteristicas')->where('producto_id', $id_producto)->get();
          
          return $caracteristicas;
      }
      
    public function agregarcaracteristicas($id_producto){
        $caracteristica = new Caracteristica();
        $caracteristica->producto_id = $id_producto;
        $caracteristica->descripcion = 'Nueva caracteristica';
        $caracteristica->save();
        return $caracteristica;
    }
    public function eliminarcaracteristicas($id_caracteristica){
        $caracteristica = Caracteristica::find($id_caracteristica);
        $caracteristica->delete();
        return $caracteristica;
    }
    public function actualizarCaracteristica(Request $request, $id_caracteristica) {
        // Obtener la descripción de la característica del cuerpo de la solicitud
        $descripcion = $request->input('descripcion'); // Usamos la clave 'descripcion'
    
        // Verificar si la descripción está presente antes de actualizar
        if ($descripcion !== null) {
            // Actualizar la descripción de la característica en la base de datos
            $caracteristica = Caracteristica::find($id_caracteristica);
            $caracteristica->descripcion = $descripcion;
            $caracteristica->save();
    
            return response()->json($caracteristica); // Devolver la característica actualizada como JSON
        } else {
            // La descripción está ausente, devolver un error
            return response()->json(['error' => 'La descripción está vacía'], 400);
        }
    }
}

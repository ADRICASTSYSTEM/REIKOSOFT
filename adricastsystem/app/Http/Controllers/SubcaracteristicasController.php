<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcaracteristica;

class SubcaracteristicasController extends Controller
{
    //
    protected $rutaConcat;
    public function __construct()
    {
        $this->middleware('auth');
        $this->rutaConcat = config('app.ruta_concat');
    }
    public function agregarsubcaracteristica($id_caracteristica){
        $subcaracteristica = new Subcaracteristica();
        $subcaracteristica->caracteristica_id = $id_caracteristica;
        $subcaracteristica->descripcion = 'Nueva subcaracteristica';
        $subcaracteristica->save();
        return $subcaracteristica;
    } 
    public function actualizarsubcaracteristica(Request $request, $id_subcaracteristica) {
        // Obtener la descripción de la subcaracterística del cuerpo de la solicitud
        $descripcion = $request->input('descripcion'); // Usamos la clave 'descripcion'
    
        // Verificar si la descripción está presente antes de actualizar
        if ($descripcion !== null) {
            // Actualizar la descripción de la subcaracterística en la base de datos
            $subcaracteristica = Subcaracteristica::find($id_subcaracteristica);
            $subcaracteristica->descripcion = $descripcion;
            $subcaracteristica->save();
        }
    
        return $subcaracteristica;
    }
    public function eliminarsubcaracteristica($id_subcaracteristica){
        $subcaracteristica = Subcaracteristica::find($id_subcaracteristica);
        $subcaracteristica->delete();
        return $subcaracteristica;
    }   
    public function consultarsubcaracteristicas($id_caracteristica)
    {
        // Obtener todas las subcaracterísticas de la característica con el ID proporcionado
        $subcaracteristicas = Subcaracteristica::where('caracteristica_id', $id_caracteristica)->get();
        
        return $subcaracteristicas;
    }  

}

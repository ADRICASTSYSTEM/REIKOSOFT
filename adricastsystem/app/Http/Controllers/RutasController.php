<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\Rol;
use App\Models\Ruta;
use App\Models\Seccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RutasController extends Controller
{
    //
      /**
     * Muestra la vista principal para gestionar rutas.
     */
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
        $allmodulos = Modulo::all();
        $secciones = Seccion::all();
       
        return view('reikosoft.rutas.index', compact(
        'descripcion',
        'user',
        
        
        'modulos',
        'allmodulos','secciones'

      ));
    }
 public function create(){
        $typeUser = auth()->user()->typeUser;
      
      
        $user = Auth::user();
        if ($typeUser) {
            $descripcion = $typeUser->descripcion;
        } else {
            $descripcion = 'No asignado';
        }

        $moduloIds = Rol::where('estado', 1)->pluck('id_modulos')->unique();
        $modulos = Modulo::whereIn('id', $moduloIds)->get();
        
        $allmodules = Modulo::all();
       
       $secciones =Seccion::All();
        return view('reikosoft.rutas.create' , compact('descripcion','user','modulos','allmodules','secciones'));

    }
    /**
     * Devuelve las rutas asociadas a un módulo específico (AJAX).
     */
    public function obtenerRutasPorModulo($moduloId)
    {
        $rutas = Ruta::where('modulo_id', $moduloId)->get();
        return response()->json($rutas);
    }

    /**
     * Guarda una nueva ruta en la base de datos.
     */
public function store(Request $request)
{
    $request->validate([
        'modulo_id'     => 'required|exists:modulos,id',
        'nombre'        => 'required|string|max:255',
        'ruta'          => 'required|string|max:255',
        'descripcion'   => 'required|string|max:255',
        'metodo'        => 'required|in:GET,POST,PUT,DELETE,PATCH',
        'convencion'    => 'nullable|string|in:index,store,create,show,edit,update,destroy',
        'ruta_estado'   => 'nullable|boolean',
    ]);

    try {
        $ruta = new Ruta();
        $ruta->modulo_id    = $request->modulo_id;
        $ruta->nombre       = $request->nombre;
        $ruta->url         = $request->ruta;
        $ruta->descripcion  = $request->descripcion;
        $ruta->metodo       = $request->metodo;
        $ruta->convencion   = $request->convencion ?? null;
        $ruta->estado       = $request->has('ruta_estado') ? 1 : 0;
        $ruta->save();

        return response()->json([
            'message' => 'Ruta creada correctamente',
            'ruta' => $ruta
        ], 201);
    } catch (\Exception $e) {
        \Log::error('Error al guardar ruta: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString()
        ]);

        return response()->json([
            'message' => 'Error al crear la ruta',
            'error' => $e->getMessage()
        ], 500);
    }
}
public function update(Request $request, $id)
{
    $request->validate([
        'modulo_id'     => 'required|exists:modulos,id',
        'nombre'        => 'required|string|max:255',
        'ruta'          => 'required|string|max:255',
        'descripcion'   => 'required|string|max:255',
        'metodo'        => 'required|in:GET,POST,PUT,DELETE,PATCH',
        'convencion'    => 'nullable|string|in:index,store,create,show,edit,update,destroy',
        'ruta_estado'   => 'nullable|boolean',
    ]);

    try {
        $ruta = Ruta::findOrFail($id);

        $ruta->modulo_id    = $request->modulo_id;
        $ruta->nombre       = $request->nombre;
        $ruta->url          = $request->ruta;
        $ruta->descripcion  = $request->descripcion;
        $ruta->metodo       = $request->metodo;
        $ruta->convencion   = $request->convencion ?? null;
        $ruta->estado       = $request->has('ruta_estado') ? 1 : 0;

        $ruta->save();

        return response()->json([
            'message' => 'Ruta actualizada correctamente',
            'ruta' => $ruta
        ], 200);
    } catch (\Exception $e) {
        \Log::error('Error al actualizar ruta: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString()
        ]);

        return response()->json([
            'message' => 'Error al actualizar la ruta',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function destroy($id)
{
    try {
        $ruta = Ruta::findOrFail($id); // Lanza 404 si no existe

        $ruta->delete();

        return response()->json([
            'success' => true,
            'message' => 'La ruta ha sido eliminada correctamente.'
        ]);
    } catch (\Exception $e) {
        \Log::error('Error al eliminar ruta: ' . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Ocurrió un error al eliminar la ruta.',
            'error' => $e->getMessage()
        ], 500);
    }
}
     public function show($id)
    {
        $registro = Ruta::find($id);
        return response()->json($registro);

    }
}

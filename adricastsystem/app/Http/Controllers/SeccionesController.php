<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\Rol;
use App\Models\Seccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeccionesController extends Controller
{
    /**
     * Display a listing of the resource.
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
 
        $secciones = Seccion::all();
       
        return view('reikosoft.secciones.index' , compact('descripcion','user','modulos','secciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
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
        
        $secciones = Seccion::all();
       
        return view('reikosoft.secciones.create' , compact('descripcion','user','modulos','secciones'));

    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:50|unique:secciones,nombre',
        'descripcion' => 'nullable|string|max:100',
        'icono' => 'required|string|max:50',
    ]);

    try {
        $seccion = Seccion::create([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'icono' => $request->input('icono'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'El registro ha sido guardado'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al guardar: ' . $e->getMessage()
        ], 500);
    }
}

    /**
     * Display the specified resource.
     */
      public function show($id)
    {
        $registro = Seccion::find($id);
        return response()->json($registro);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $registro = Seccion::find($id);

    $request->validate([
        'nombre' => 'required|string|max:50',
        'descripcion' => 'nullable|string|max:100',
        'icono' => 'required|string|max:50',
    ]);

    try {
        $registro->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'icono' => $request->icono,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'El registro ha sido actualizado correctamente'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al actualizar: ' . $e->getMessage()
        ], 500);
    }
}


  
     public function buscarRegistros(Request $request)
    {
         // Obtener el valor de búsqueda del campo "busqueda"
         $valorBusqueda = $request->input('termino');
 
         // Realizar la búsqueda de registros según el valor proporcionado
         $registros = Seccion::where('nombre', 'LIKE', "%$valorBusqueda%")
          
             
             ->get();
 
         // Retornar los registros en formato JSON
         return response()->json($registros->toArray());
     } 
     

     public function buscarCodigo(Request $request)
     {
         $valorBusqueda = $request->input('termino');
     
         // Realizar la búsqueda de registros según el valor proporcionado
         $seccion = Seccion::where('codigo', '=', $valorBusqueda);
     
         // Verificar si se encontró el producto
         if ($seccion) {
             // Obtener los datos del producto
             $datosSeccion = [
                 'nombre' => $seccion->nombre,
                 'descripcion' => $seccion->descripcion,
                
                 'id' => $seccion->id,
                 // Añadir cualquier otro dato del producto que desees incluir en la respuesta JSON
             ];
     
        
             // Retornar los datos del producto en formato JSON
             return response()->json($datosSeccion);
         } else {
            // El producto no fue encontrado, devuelve un mensaje de error
            return response()->json(['error' => 'Seccion no encontrado para el código proporcionado']);
        }
     }
  /**
     * Remove the specified resource from storage.
     */
 
     public function destroy($id)
    {
        $registro = Seccion::find($id);
         // Verificar si el usuario autenticado es el mismo que se está intentando eliminar
     
        $registro->delete();
      
      
          // Retornar una respuesta exitosa en formato JSON
          return response()->json(['success' => true, 'message' => 'El registro ha sido eliminado']);
    }
     
}

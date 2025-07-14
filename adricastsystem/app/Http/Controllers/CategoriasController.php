<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Modulo;
use App\Models\Rol;
use App\Models\Seccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriasController extends Controller
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
 
        $categorias = Categoria::all();
        $secciones = Seccion::all();
       
        return view('reikosoft.categorias.index', compact('descripcion','user','modulos','categorias','secciones'));
   
       }
       public function create()
       {
           $typeUser = auth()->user()->typeUser;
         
           $user = Auth::user();
           if ($typeUser) {
               $descripcion = $typeUser->descripcion;
           } else {
               $descripcion = 'No asignado';
           }
           $modulos = Modulo::all();
   
   
           return view('reikosoft.categorias.create', compact('descripcion','user','modulos'));
       }	
       public function store(Request $request)
       {
           $request->validate([
               'nombre' => 'required|string',
               'descripcion' => 'required|string',
              
               // Asegúrate de ajustar esta validación según tus necesidades
           ]);
             
           try {
               $categoria=Categoria::create(
                   [
                      
                       'nombre' => $request->nombre,
                       'descripcion' => $request->descripcion,
                    
                     
                   ]
               );
                 
            // Obtener el ID del producto después de crearlo
            $categoriaId = $categoria->id;
         

            // Verificar si hay una imagen y guardarla con el nombre del ID del producto
            if ($request->hasFile('imagencategoria')) {
                $imagen = $request->file('imagencategoria');
                $nombreImagen = $categoriaId . '.' . $imagen->getClientOriginalExtension();
                $destino = public_path($this->rutaConcat . 'img/categorias');
                $imagen->move($destino, $nombreImagen);
                $imagenUrl = $nombreImagen;
    
                // Actualizar el campo 'foto' del producto con la URL de la imagen
                $categoria->update([
                    'foto' => $imagenUrl,
                ]);
            }
    
            return response()->json(['success' => true, 'message' => 'El registro ha sido guardado']);
      
           } catch (\Exception $e) {
               dd($e->getMessage());
           }
               
           
   
       }
       public function show($id)
       {
           $registro = Categoria::find($id);
           return response()->json($registro);
   
       }
         
       public function update(Request $request, $id)
       {
           $registro = Categoria::find($id);
       
           $request->validate([
               'nombre' => 'required|string',
               'descripcion' => 'required|string',
            
           ]);
       
           // Verificar si se proporcionó una nueva imagen
           if ($request->hasFile('imagencategoria')) {
               $imagen = $request->file('imagencategoria');
               $nombreImagen = $request->id . '.' . $imagen->getClientOriginalExtension();
               $destino = public_path($this->rutaConcat . 'img/categorias');
               $imagen->move($destino, $nombreImagen);
               $imagenUrl = $nombreImagen;
       
               // Actualizar solo si se proporciona una nueva imagen
               $registro->update([
                   'foto' => $imagenUrl,
                   'nombre' => $request->nombre,
                   'descripcion' => $request->descripcion,
                 
               ]);
           } else {
               // Actualizar sin cambiar la imagen
               $registro->update([
                   'nombre' => $request->nombre,
                   'descripcion' => $request->descripcion,
                
               ]);
           }
       
           
       }
       
     public function destroy($id)
{
    $categoria = Categoria::find($id);

    if (!$categoria) {
        return response()->json(['success' => false, 'message' => 'Categoría no encontrada'], 404);
    }

    // Verificar si la categoría tiene productos asociados
    if ($categoria->productos()->exists()) {
        return response()->json([
            'success' => false,
            'message' => 'No se puede eliminar la categoría porque tiene productos asociados.'
        ], 400);
    }

    // Eliminar imagen si existe
    if ($categoria->foto != '') {
        $ruta = $this->rutaConcat . 'img/categorias/' . $categoria->foto;
        if (file_exists($ruta)) {
            unlink($ruta);
        }
    }

    // Eliminar el registro
    $categoria->delete();

    return response()->json(['success' => true, 'message' => 'El registro ha sido eliminado']);
}

       public function buscarRegistros(Request $request)
    {
         // Obtener el valor de búsqueda del campo "busqueda"
         $valorBusqueda = $request->input('termino');
 
         // Realizar la búsqueda de registros según el valor proporcionado
         $registros = Categoria::where('descripcion', 'LIKE', "%$valorBusqueda%")
             ->orWhere('nombre', 'LIKE', "%$valorBusqueda%")
             
             ->get();
 
         // Retornar los registros en formato JSON
         return response()->json($registros->toArray());
     }   
}

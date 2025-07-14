<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Marca;
use Monolog\Registry;
use App\Models\Modulo;
use App\Models\Categoria;
use App\Models\Rol;
use App\Models\Seccion;
use App\Models\TipoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarcasController extends Controller
{
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
    $descripcion = $typeUser ? $typeUser->descripcion : 'No asignado';

    // Obtener los módulos y marcas paginadas
    $moduloIds = Rol::where('estado', 1)->pluck('id_modulos')->unique();
    $modulos = Modulo::whereIn('id', $moduloIds)->get();
 
    $perPage = request()->perPage ?: 5; // Valor predeterminado 5 si no se pasa 'perPage' en la solicitud
    $marcas = Marca::paginate($perPage);
    $secciones = Seccion::all();
       

    // Retornar la vista con los datos
    return view('reikosoft.marcas.index', compact('descripcion', 'user', 'modulos', 'marcas','secciones'));
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
   
   
           return view('reikosoft.marcas.create', compact('descripcion','user','modulos'));
       }	
       public function store(Request $request)
       {
           $request->validate([
               'nombre' => 'required|string',
               'descripcion' => 'required|string',
              
               // Asegúrate de ajustar esta validación según tus necesidades
           ]);
             
           try {
               $marca=Marca::create(
                   [
                      
                       'nombre' => $request->nombre,
                       'descripcion' => $request->descripcion,
                    
                     
                   ]
               );
                 
            // Obtener el ID del producto después de crearlo
            $marcaId = $marca->id;
         

            // Verificar si hay una imagen y guardarla con el nombre del ID del producto
            if ($request->hasFile('imagenmarca')) {
                $imagen = $request->file('imagenmarca');
                $nombreImagen = $marcaId . '.' . $imagen->getClientOriginalExtension();
                $destino = public_path($this->rutaConcat.'img/marcas');
                $imagen->move($destino, $nombreImagen);
                $imagenUrl = $nombreImagen;
    
                // Actualizar el campo 'foto' del producto con la URL de la imagen
                $marca->update([
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
           $registro = Marca::find($id);
           return response()->json($registro);
   
       }
         
       public function update(Request $request, $id)
       {
           $registro = Marca::find($id);
       
           $request->validate([
               'nombre' => 'required|string',
               'descripcion' => 'required|string',
            
           ]);
       
           // Verificar si se proporcionó una nueva imagen
           if ($request->hasFile('imagenmarca')) {
               $imagen = $request->file('imagenmarca');
               $nombreImagen = $request->id . '.' . $imagen->getClientOriginalExtension();
               $destino = public_path($this->rutaConcat.'img/marcas');
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
           $registro = Marca::find($id);
           $registro->delete();
            if ($registro->foto)
            {
                $ruta= $this->rutaConcat.'img/marcas/'.$registro->foto;
                if (file_exists($ruta)) {
                 unlink($ruta);
                 }
          
            }
   
             // Retornar una respuesta exitosa en formato JSON
             return response()->json(['success' => true, 'message' => 'El registro ha sido eliminado']);
       
       }
       public function buscarRegistros(Request $request)
       {
            // Obtener el valor de búsqueda del campo "busqueda"
            $valorBusqueda = $request->input('termino');
    
            // Realizar la búsqueda de registros según el valor proporcionado
            $registros = Marca::where('descripcion', 'LIKE', "%$valorBusqueda%")
                ->orWhere('nombre', 'LIKE', "%$valorBusqueda%")
                
                ->get();
    
            // Retornar los registros en formato JSON
            return response()->json($registros->toArray());
        }   
       
}

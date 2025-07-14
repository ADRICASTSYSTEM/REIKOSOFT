<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Modulo;
use App\Models\Rol;
use App\Models\Seccion;
use App\Models\TipoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UsuariosController extends Controller
{
    //
    protected $rutaConcat;
    public function __construct()
    {
        $this->middleware('auth');
        $this->rutaConcat = config('app.ruta_concat');
    }

public function index(Request $request)
{
    // Obtener el tipo de usuario y el usuario actual
    $typeUser = auth()->user()->typeUser;
    $user = Auth::user();
    $descripcion = $typeUser ? $typeUser->descripcion : 'No asignado';

    // Obtener los módulos
    $moduloIds = Rol::where('estado', 1)->pluck('id_modulos')->unique();
    $modulos = Modulo::whereIn('id', $moduloIds)->get();
 

    // Obtener el término de búsqueda si existe
    $termino = $request->get('termino');
    $perPage = $request->perPage ?: 5; // Si no se selecciona un valor, usará 5 como predeterminado

    // Filtrar usuarios si hay un término de búsqueda
    if ($termino) {
        $usuarios = User::where('username', 'like', '%' . $termino . '%')
                        ->paginate($perPage);
    } else {
        // Si no hay término de búsqueda, mostrar todos los usuarios
        $usuarios = User::paginate($perPage);
    }
     $secciones = Seccion::all();
       
    // Pasar todas las variables a la vista
    return view('reikosoft.usuarios.index', compact('descripcion', 'user', 'modulos', 'usuarios', 'termino','secciones'));
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
        $tipousuario = TipoUsuario::all();
        return view('reikosoft.usuarios.create', compact('descripcion','user','modulos','tipousuario'));
    }	
    public function destroy($id)
    {
        $registro = User::find($id);
         // Verificar si el usuario autenticado es el mismo que se está intentando eliminar
        if (auth()->user()->id === $registro->id) {
            // Retornar una respuesta de error en formato JSON
            return response()->json(['success' => false, 'message' => 'No puedes eliminarte a ti mismo.']);
        }
    
        $registro->delete();
        if ($registro->foto == null) {
            // Retornar una respuesta exitosa en formato JSON
            return response()->json(['success' => true, 'message' => 'El registro ha sido eliminado']);
        }

        if($registro->foto){
            $ruta= $this->rutaConcat.'img/perfiles/'.$registro->foto;
            
            if (file_exists($ruta)) {
                unlink($ruta);
                // Aquí puedes realizar otras acciones después de eliminar el archivo
            } 
        }
       
          // Retornar una respuesta exitosa en formato JSON
          return response()->json(['success' => true, 'message' => 'El registro ha sido eliminado']);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'email' => 'required|string',
            'usuario' => 'required|string',
            'tipousuario_id' => 'required|string',
        ]);
        
         
        try {
            User::create(
                [
                    'nombres' => $request->nombres,
                    'apellidos' => $request->apellidos,
                    'direccion' => $request->direccion,
                    'telefono' => $request->telefono,
                    'email' => $request->email,
                    'username' => $request->usuario,
                    'name' => $request->usuario,
                    'tipousuario_id' => $request->tipousuario_id,
                    'password' => bcrypt($request->usuario),
                ]
                  
                
            );
            return response()->json(['success' => true, 'message' => 'El registro ha sido guardado']);

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
            
        

    }
    public function show($id)
    {
        $registro = User::find($id);
        return response()->json($registro);

    }
    public function update(Request $request, $id)
    {
        $registro = User::find($id);
    
        $request->validate([
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'email' => 'required|string',
            
       
        ]);
      
    
        // Verificar si se proporcionó una nueva imagen
       
        if ($request->hasFile('imagenmodulo')) {
            $imagen = $request->file('imagenmodulo');
          
            $nombreImagen = 'perfil_'. $id . '.' . $imagen->getClientOriginalExtension();
            $destino = public_path($this->rutaConcat.'img/perfiles');
            //$destino = public_path('../../public_html/img/perfiles'); para produccion hostinger cambiar a esta ruta
            $imagen->move($destino, $nombreImagen);
            $imagenUrl = $nombreImagen;
        
            // Actualizar solo si se proporciona una nueva imagen
            $registro->update([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'email' => $request->email,
                'foto' => $imagenUrl

            ]);
           
        } else {
            // Actualizar sin cambiar la imagen
            $registro->update([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'email' => $request->email

            ]);
        }
    
        
    }    
 public function buscarRegistros(Request $request)
{
    $valorBusqueda = $request->input('termino');
    $registros = User::where('username', 'LIKE', "%$valorBusqueda%")
                     ->orWhere('nombres', 'LIKE', "%$valorBusqueda%")
                     ->orWhere('apellidos', 'LIKE', "%$valorBusqueda%")
                     ->get();

    // Verifica si los registros fueron encontrados
    if ($registros->isEmpty()) {
        return response()->json(['message' => 'No se encontraron resultados'], 404);
    }

    return response()->json($registros);
}

}


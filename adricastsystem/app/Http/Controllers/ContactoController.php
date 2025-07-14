<?php

namespace App\Http\Controllers;

use App\Models\Contactoweb;
use App\Models\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactoController extends Controller
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
        if ($typeUser) {
            $descripcion = $typeUser->descripcion;
        } else {
            $descripcion = 'No asignado';
        }
        $modulos = Modulo::all();
        $mensajes= Contactoweb::all();
        
        return view('reikosoft.contacto.index', compact('descripcion','user','modulos','mensajes'));
    }
    public function destroy($id)
    {
        $registro = Contactoweb::find($id);
        $registro->delete();
        return response()->json(['success' => true, 'message' => 'El registro ha sido eliminado']);
    }
    public function show($id)
    {
        $registro = Contactoweb::find($id);
        if (!$registro) {
            return response()->json(['error' => 'El registro no fue encontrado.'], 404);
        }
    
        // Actualizar el estado a "leído"
        $registro->status = 'leido';
        $registro->save();
        return response()->json($registro);
    }   
    public function buscarRegistros(Request $request)
    {
        // Obtener el valor de búsqueda del campo "busqueda"
        $valorBusqueda = $request->input('termino');
        $tipo = $request->input('tipo');
        
        // Inicializar la consulta
        $query = Contactoweb::query();
    
        // Verificar el tipo de búsqueda y agregar las condiciones correspondientes
        if ($tipo === 'leido') {
            $query->where('status', 'leido');
        } elseif ($tipo === 'no_leido') {
            $query->where('status', 'no_leido');
        }
        
        // Agregar las condiciones de búsqueda para el término de búsqueda solo si no está vacío
        if (!empty($valorBusqueda)) {
            $query->where(function ($query) use ($valorBusqueda) {
                $query->where('nombre', 'LIKE', "%$valorBusqueda%")
                      ->orWhere('asunto', 'LIKE', "%$valorBusqueda%");
            });
        }
    
        // Obtener los registros
        $registros = $query->get();
    
        // Retornar los registros en formato JSON
        return response()->json($registros->toArray());
    }
    
}

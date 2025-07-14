<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\Seccion;
use App\Models\ModuloSeccion;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuloSeccionController extends Controller
{
    public function index(Request $request)
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

        $relaciones = ModuloSeccion::with(['modulo', 'seccion'])->get();

        return view('reikosoft.moduloseccion.index', compact('descripcion','user','modulos', 'secciones', 'relaciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'modulos' => 'required|array|min:1',
            'modulos.*' => 'exists:modulos,id',
            'secciones' => 'required|array|min:1',
            'secciones.*' => 'exists:secciones,id',
        ]);

        try {
            $modulos = $request->input('modulos');
            $secciones = $request->input('secciones');

            foreach ($modulos as $moduloId) {
                foreach ($secciones as $seccionId) {
                    ModuloSeccion::updateOrCreate(
                        [
                            'modulo_id' => $moduloId,
                            'seccion_id' => $seccionId,
                        ],
                         [
                        'estado' => true
                    ]
                    );
                }
            }

            return response()->json(['success' => true, 'message' => 'Relaciones módulo-sección guardadas correctamente']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function buscar(Request $request)
{
    $texto = $request->input('texto');

    $busquedasecciones = Seccion::where('nombre', 'LIKE', "%$texto%")
                    ->orWhere('descripcion', 'LIKE', "%$texto%")
                    ->get();

    return response()->json($busquedasecciones);
}
public function buscarModulos(Request $request)
{
    $texto = $request->input('texto');

    $busquedamodulos = Seccion::where('nombre', 'LIKE', "%$texto%")
                    ->orWhere('descripcion', 'LIKE', "%$texto%")
                 
                    ->get();

    return response()->json($busquedamodulos);
}
    public function relacionesPorSeccion($seccion_id)
    {
        $relaciones = ModuloSeccion::where('seccion_id', $seccion_id)
            ->where('estado', true)
            ->with('modulo')
            ->get()
            ->map(function ($item) {
                return [
                    'modulo_id' => $item->modulo_id,
                    'modulo_nombre' => $item->modulo ? $item->modulo->nombre : 'No encontrada',
                ];
            });

        return response()->json($relaciones);
    }

        public function relacionesPorModulo($modulo_id)
    {
        $relaciones = ModuloSeccion::where('modulo_id', $modulo_id)
            ->with('modulo')
            ->get()
            ->map(function ($item) {
                return [
                    'modulo_id' => $item->modulo_id,
                    'modulo_nombre' => $item->modulo ? $item->modulo->nombre : 'No encontrada',
                ];
            });

        return response()->json($relaciones);
    }

public function cambiarEstado(Request $request)
{
    $request->validate([
        'modulo_id' => 'required|exists:modulos,id',
        'seccion_id' => 'required|exists:secciones,id',
        'estado' => 'required|boolean',
    ]);

    $relacion = ModuloSeccion::where('modulo_id', $request->modulo_id)
                              ->where('seccion_id', $request->seccion_id)
                              ->first();

    if ($relacion) {
        // Si existe, actualizamos el estado
        $relacion->estado = $request->estado;
        $relacion->save();
    } else if ($request->estado === true) {
        // Si no existe y se desea activar
        ModuloSeccion::create([
            'modulo_id' => $request->modulo_id,
            'seccion_id' => $request->seccion_id,
            'estado' => true
        ]);
    }

    return response()->json(['success' => true, 'message' => 'Relación actualizada']);
}

}

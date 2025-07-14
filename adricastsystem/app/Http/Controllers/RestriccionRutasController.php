<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\RestriccionRuta;
use App\Models\Ruta;
use App\Models\Seccion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestriccionRutasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $typeUser = auth()->user()->typeUser;
      
        $user = Auth::user();
        if ($typeUser) {
            $descripcion = $typeUser->descripcion;
        } else {
            $descripcion = 'No asignado';
        }
    $usuarios = User::when($request->filled('buscar_usuario'), function ($query) use ($request) {
        $query->where('nombres', 'like', '%'.$request->buscar_usuario.'%');
    })->get();

    $modulos = Modulo::all();

    $rutas = Ruta::when($request->filled('modulo_id'), function ($query) use ($request) {
        $query->where('modulo_id', $request->modulo_id);
    })
    ->when($request->filled('buscar_ruta'), function ($query) use ($request) {
        $query->where('nombre', 'like', '%'.$request->buscar_ruta.'%');
    })
    ->get();
    $secciones = Seccion::all();
       
    return view('reikosoft.restriccionrutas.index', compact('descripcion','user','usuarios', 'modulos', 'rutas','secciones'));
}
public function buscar(Request $request)
{
    $texto = $request->input('texto');

    $usuarios = User::where('nombres', 'LIKE', "%$texto%")
                    ->orWhere('apellidos', 'LIKE', "%$texto%")
                    ->get();

    return response()->json($usuarios);
}
public function buscarRutas(Request $request)
{
    $texto = $request->input('texto');
    $moduloId = $request->input('modulo_id');

    $query = Ruta::query();

    if ($moduloId) {
        $query->where('modulo_id', $moduloId);
    }

    if ($texto) {
        $query->where('nombre', 'LIKE', "%$texto%");
    }

    $rutas = $query->get();

    return response()->json($rutas);
}
public function relacionesPorUsuario($user_id)
{
    $relaciones = RestriccionRuta::where('user_id', $user_id)
        ->where('estado', true) // solo activas
        ->with('ruta')          // carga la relación 'ruta' del modelo RestriccionRuta
        ->get()
        ->map(function ($item) {
            return [
                'ruta_id' => $item->ruta_id,
                'ruta_nombre' => $item->ruta ? $item->ruta->nombre : 'Ruta no encontrada',
            ];
        });

    return response()->json($relaciones);
}

public function relacionesPorRuta($ruta_id)
{
    // Aquí va la lógica para obtener los usuarios asociados a una ruta
   $relaciones = RestriccionRuta::where('ruta_id', $ruta_id)->get();

    return response()->json($relaciones);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // 1. Validación
    $request->validate([
        'usuarios' => 'required|array|min:1',
        'usuarios.*' => 'exists:users,id',
        'rutas' => 'required|array|min:1',
        'rutas.*' => 'exists:rutas,id',
    ]);

    try {
        $usuarios = $request->input('usuarios');
        $rutas = $request->input('rutas');

        // 2. Guardar o actualizar
        foreach ($usuarios as $userId) {
            foreach ($rutas as $rutaId) {
                RestriccionRuta::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'ruta_id' => $rutaId
                    ],
                    [
                        'estado' => true
                    ]
                );
            }
        }

        // 3. Retorno
        return response()->json(['success' => true, 'message' => 'Restricciones actualizadas correctamente']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
    }
}

    /**
     * Display the specified resource.
     */
    public function cambiarEstado(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'ruta_id' => 'required|exists:rutas,id',
        'estado' => 'required|boolean',
    ]);

    $relacion = RestriccionRuta::where('user_id', $request->user_id)
        ->where('ruta_id', $request->ruta_id)
        ->first();

    if (!$relacion) {
        return response()->json(['success' => false, 'error' => 'Relación no encontrada.'], 404);
    }

    $relacion->estado = $request->estado;
    $relacion->save();

    return response()->json(['success' => true, 'message' => 'Estado actualizado correctamente.']);
}

    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

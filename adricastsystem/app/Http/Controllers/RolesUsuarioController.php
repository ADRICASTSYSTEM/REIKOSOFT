<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\TipoUsuario;
use App\Models\Rol;
use App\Models\Seccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolesUsuarioController extends Controller
{
    /**
     * Muestra la vista con el formulario y las asignaciones actuales.
     */
  public function index()
{
    $user = Auth::user();
    $typeUser = $user->typeUser ?? null;
    $descripcion = $typeUser ? $typeUser->descripcion : 'No asignado';

    // Módulos asignados al usuario actual
      
    $moduloIds = Rol::where('estado', 1)->pluck('id_modulos')->unique();
    $modulos = Modulo::whereIn('id', $moduloIds)->get();
 
    
    // Todos los módulos (para el panel de asignación)
    $todosLosModulos = Modulo::all();

    $tiposUsuario = TipoUsuario::all();
    $roles = Rol::with('modulo')->where('estado', 1)->get(); // Solo activos
    $rolesPorTipoUsuario = $roles->groupBy('id_tipousuarios');
    $secciones = Seccion::all();
       
    return view('reikosoft.roles.index', compact(
        'descripcion',
        'user',
        'tiposUsuario',
        'modulos',             // Para cargar el menú según el usuario
        'todosLosModulos',     // Para asignación de roles a tipos de usuario
        'rolesPorTipoUsuario',
        'secciones'
    ));
}



    /**
     * Guarda la asignación de módulos al tipo de usuario.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo_usuario_id' => 'required|exists:tipo_usuarios,id',
        ]);

        $tipoUsuarioId = $request->input('tipo_usuario_id');
        $modulosAsignados = $request->input('modulos_asignados', []);

        // Desactiva todos los roles actuales para ese tipo de usuario
        Rol::where('id_tipousuarios', $tipoUsuarioId)
            ->update(['estado' => 0]);

        // Activa o crea los seleccionados
        foreach ($modulosAsignados as $moduloId) {
            $rol = Rol::firstOrNew([
                'id_tipousuarios' => $tipoUsuarioId,
                'id_modulos' => $moduloId,
            ]);

            $rol->estado = 1;
            $rol->save();
        }

        return redirect()->route('rolusuario.index')->with('success', 'Módulos asignados correctamente.');
    }
}

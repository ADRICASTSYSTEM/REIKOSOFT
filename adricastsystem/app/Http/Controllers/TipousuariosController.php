<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\TipoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipousuariosController extends Controller
{
     //
     public function __construct()
     {
         $this->middleware('auth');
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
         $tipousuarios = TipoUsuario::all();
         return view('reikosoft.tipousuarios.index', compact('descripcion','user','modulos','tipousuarios'));
 
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
 
 
         return view('reikosoft.tipousuarios.create', compact('descripcion','user','modulos'));
     }
     public function store(Request $request)
     {
         $request->validate([
             'descripcion' => 'required|string',
             // Asegúrate de ajustar esta validación según tus necesidades
         ]);
           
         try {
             TipoUsuario::create([
                 'descripcion' => $request->descripcion,
             ]);
             return response()->json(['success' => true, 'message' => 'El registro ha sido guardado']);
      
         } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
         }
     }
        public function edit($id)
        {
            $typeUser = auth()->user()->typeUser;
        
            $user = Auth::user();
            if ($typeUser) {
                $descripcion = $typeUser->descripcion;
            } else {
                $descripcion = 'No asignado';
            }
            $modulos = Modulo::all();
            $tipousuario = TipoUsuario::find($id);
            return view('reikosoft.tipousuarios.edit', compact('descripcion','user','modulos','tipousuario'));
        }
        public function update(Request $request, $id)
        {
            $request->validate([
                'descripcion' => 'required|string',
                // Asegúrate de ajustar esta validación según tus necesidades
            ]);
            try {
                TipoUsuario::find($id)->update([
                    'descripcion' => $request->descripcion,
                ]);
                return response()->json(['success' => true, 'message' => 'El registro ha sido actualizado']);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
        }
        public function destroy($id)
        {
            try {
                TipoUsuario::find($id)->delete();
                  // Retornar una respuesta exitosa en formato JSON
                return response()->json(['success' => true, 'message' => 'El registro ha sido eliminado']);
       
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
        }
        public function show($id)
        {
            $registro = TipoUsuario::find($id);
            return response()->json($registro);
    
        }
        public function buscarRegistros(Request $request)
        {
            $tipousuarios = TipoUsuario::where('descripcion', 'like', '%' . $request->busqueda . '%')->get();
            return response()->json($tipousuarios);
        }
}

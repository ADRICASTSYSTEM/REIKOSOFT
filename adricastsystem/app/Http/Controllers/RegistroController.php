<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TipoUsuario;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    //
    public function index(){
      
        $tipousuario = TipoUsuario::all();
        return view('reikosoft.auth.registrousuario')->with('tipousuario', $tipousuario);
    }   
    public function store(Request $request){
        $request->request->add(['username' => Str::slug($request->usuario)]);
      
        //validar datos
        $request->validate([
            'usuario'=>'required|min:4|max:20|unique:users,username',
            'nombres'=>'required|min:3|max:50',
            'apellidos'=>'required|min:3|max:50',
            'telefono'=>'required|min:10|max:14',
            'email'=>'required|min:7|max:100|unique:users|email',
            'password'=>'required|min:4|max:20|confirmed',
            'tipousuario_id' => 'required|exists:tipo_usuarios,id',
        ]);
        //dd('La validación pasó correctamente');
        //crear usuario
        try {
            User::create([
              
                'nombres'=>$request->nombres,
                'apellidos'=>$request->apellidos,
                'direccion'=>$request->direccion,
                'telefono'=>$request->telefono,
                'email'=>$request->email,
                'username'=>$request->usuario,
                'name'=>$request->usuario,
                'password'=>Hash::make($request->password),
                'tipo_usuario_id'=>$request->tipousuario_id
            
            ]);
          
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
                

        auth()->attempt($request->only('email','password'));
      
        //redireccionar al usuario
        return redirect()->route('reikosoft');
    }
}

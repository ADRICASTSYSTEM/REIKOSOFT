<?php

namespace App\Http\Controllers;

use App\Models\Contactoweb;
use App\Mail\CorreoContacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactanosController extends Controller
{
    //
    public function contactanos(){
        // Puedes pasar datos a la vista si es necesario, por ejemplo, si quieres mostrar información adicional
        $datos = [
            'nombre' => '',
            'correo' => '',
            'mensaje' => '',
            'asunto' => '',
            'telefono' => '',
        ];

        return view('paginas.contactanos', compact('datos'));
    }

    public function store(Request $request){
        $datos= $request->validate([
            'nombre' => 'required|string|max:25',
            'telefono' => 'required|string|max:20',
            'asunto' => 'required|string|max:100',
            'correo' => 'required|email|max:100',
            'mensaje' => 'required|string|max:1000',
        ]);

        try{
            Contactoweb::create([
                'nombre' => $request->nombre,
                'telefono' => $request->telefono,
                'asunto' => $request->asunto,
                'correo' => $request->correo,
                'mensaje' => $request->mensaje,
             
            ]);

            return response()->json(['success' => true, 'message' => 'El registro ha sido guardado']);

            

        }catch(\Exception $e){
            dd($e->getMessage());
        }

    }
}
    



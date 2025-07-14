<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        // Si ya está autenticado, redirige a /reikosoft
        if (Auth::check()) {
            return redirect('/home');
        }

        return view('paginas.reikosoft');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            // Autenticación exitosa
            return redirect('/home');
        } else {
            // Autenticación fallida
            return back()->with('error', 'Usuario o contraseña incorrecta');
        }
    }
}

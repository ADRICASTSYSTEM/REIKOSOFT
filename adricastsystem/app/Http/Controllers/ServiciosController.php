<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiciosController extends Controller
{
     //
     public function servicios()
     {
         return view('paginas.servicios');
     }
}

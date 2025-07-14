<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TecnologiasController extends Controller
{
    //
    public function tecnologias()
    {
        return view('paginas.tecnologias');
    }
}

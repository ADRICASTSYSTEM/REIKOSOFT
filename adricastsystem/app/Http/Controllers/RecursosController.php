<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RecursosController extends Controller
{
    //
      //
      public function show($directory, $filename)
      {
          $path = resource_path($directory . '/' . $filename);
  
          if (!file_exists($path)) {
              abort(404);
          }
  
          $fileContents = file_get_contents($path);
  
          return Response::make($fileContents, 200)->header('Content-Type', mime_content_type($path));
      }
}

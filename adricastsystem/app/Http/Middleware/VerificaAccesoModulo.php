<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RestriccionRuta;

class VerificaAccesoModulo
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();
        $tipoUsuario = $user->typeUser;

        if (!$tipoUsuario) {
            return redirect()->route('posts.index');
        }

        $rutaActual = trim($request->path(), '/');
        $metodoActual = strtoupper($request->method());

        // Rutas exentas (accesibles sin validación)
        $rutasExentas = ['home', 'inicio','modporseccion'];
        foreach ($rutasExentas as $ruta) {
            $ruta = trim($ruta, '/');
            if ($rutaActual === $ruta || str_starts_with($rutaActual, $ruta . '/')) {
                return $next($request);
            }
        }

        // Obtener módulos con rutas hijas activas del tipo de usuario
        $modulosPermitidos = $tipoUsuario->roles()
            ->where('estado', 1)
            ->with(['modulo.rutas' => function ($query) {
                $query->where('estado', 1);
            }])
            ->get()
            ->pluck('modulo')
            ->filter(function ($modulo) {
                return $modulo && $modulo->estado == 1 && $modulo->rutas->isNotEmpty();
            });

        $rutasPermitidas = [];

        foreach ($modulosPermitidos as $modulo) {
            foreach ($modulo->rutas as $ruta) {
                $rutasPermitidas[] = [
                    'url' => trim($ruta->url, '/'),
                    'metodo' => strtoupper($ruta->metodo),
                ];
            }

            if (!empty($modulo->ruta)) {
                $rutasPermitidas[] = [
                    'url' => trim($modulo->ruta, '/'),
                    'metodo' => 'GET',
                ];
            }
        }

        // Función para comparar rutas dinámicas
        $rutaCoincide = function ($rutaActual, $rutaPermitida) {
            $rutaPermitida = preg_quote($rutaPermitida, '#');
            $rutaPermitida = preg_replace('#\\\\\{[^/]+\\\\\}#', '[^/]+', $rutaPermitida);
            return preg_match("#^{$rutaPermitida}$#", $rutaActual);
        };

        // Revisar si la ruta está permitida
        foreach ($rutasPermitidas as $ruta) {
            $url = trim($ruta['url'], '/');
            $metodo = $ruta['metodo'];

            if ($rutaCoincide($rutaActual, $url)) {
                if ($metodo === null || $metodo === $metodoActual) {

                    // ================================
                    // VERIFICAR SI HAY RESTRICCIÓN
                    // ================================
                    $tieneRestriccion = RestriccionRuta::where('user_id', $user->id)
                        ->whereHas('ruta', function ($query) use ($url, $metodo, $rutaCoincide) {
                            $query->where('estado', 1)
                                  ->where(function ($q) use ($url, $rutaCoincide) {
                                      $q->whereRaw('? LIKE rutas.url', [$url]);
                                  });
                        })
                        ->where('estado', 1)
                        ->exists();

                    if ($tieneRestriccion) {
                        abort(403, 'Esta ruta está restringida para tu usuario.');
                    }

                    return $next($request);
                }
            }
        }

        abort(403, 'No tienes autorización para acceder a esta página.');
    }
}


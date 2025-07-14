<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmpleoController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\ModulosController;
use App\Http\Controllers\NosotrosController;
use App\Http\Controllers\NoticiasController;
use App\Http\Controllers\PerfilesController;
use App\Http\Controllers\RecursosController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ReikosoftController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ContactanosController;
use App\Http\Controllers\TecnologiasController;
use App\Http\Controllers\CaracteristicasController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\ModuloSeccionController;
use App\Http\Controllers\RestriccionRutasController;
use App\Http\Controllers\RolesUsuarioController;
use App\Http\Controllers\RutasController;
use App\Http\Controllers\SeccionesController;
use App\Http\Controllers\SubcaracteristicasController;
use App\Http\Controllers\TipousuariosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'inicio'])->name('paginas.inicio');
Route::get('/nosotros', [NosotrosController::class, 'nosotros'])->name('paginas.nosotros');
Route::get('/noticias', [NoticiasController::class, 'noticias'])->name('paginas.noticias');
Route::get('/tecnologias', [TecnologiasController::class, 'tecnologias'])->name('paginas.tecnologias');
Route::get('/servicios', [ServiciosController::class, 'servicios'])->name('paginas.servicios');
Route::get('/empleos', [EmpleoController::class, 'empleo'])->name('paginas.empleo');

Route::get('{directory}/{filename}', [RecursosController::class, 'show'])->name('recursos.show');
Route::post('/enviar-formulario', [ContactanosController::class, 'submit'])->name('enviarFormulario');

Route::get('/crearcuenta', [RegistroController::class, 'index'])->name('register');
Route::post('/crearcuenta', [RegistroController::class, 'store']);
Route::get('/home', [PostController::class, 'index'])->name('posts.index');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');
Route::get('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/contactanos', [ContactanosController::class, 'contactanos'])->name('paginas.contactanos');
Route::post('/contactanos', [ContactanosController::class, 'store'])->name('contactanos.store');
Route::get('/contactos', [ContactoController::class, 'index'])->name('contactos.index');
Route::delete('/contactosdelete/{id}', [ContactoController::class, 'destroy'])->name('contactos.destroy');
Route::get('/contactos/show/{id}', [ContactoController::class, 'show'])->name('contactos.show');
Route::get('/contactosbuscar', [ContactoController::class, 'buscarRegistros'])->name('contactos.buscar');

/* AUTH */
Route::middleware(['auth','verifica.modulo'])->group(function () {

    // Por ejemplo en api.php

    

// Opcional para "todos" (si usas query param o ruta específica)
// Ruta para obtener todos los módulos (sin parámetro)
Route::get('/modporseccion', [PostController::class, 'modulosTodos'])->name('modulos.todos');

// Ruta para obtener módulos por sección con parámetro obligatorio
Route::get('/modporseccion/seccion/{seccion_id}', [PostController::class, 'modulosPorSeccion'])->name('modulos.por.seccion');
   Route::get('/marcascreate', [MarcasController::class, 'create'])->name('marcas.create');
    Route::post('/marcascreate', [MarcasController::class, 'store'])->name('marcas.store');
    Route::delete('marcasdelete/{id}', [MarcasController::class, 'destroy'])->name('marcas.destroy');
    Route::get('/marcasbuscar', [MarcasController::class, 'buscarRegistros'])->name('marcas.buscar');

    Route::get('/categorias', [CategoriasController::class, 'index'])->name('categorias.index');
    Route::get('/categoriascreate', [CategoriasController::class, 'create'])->name('categorias.create');
    Route::post('/categoriascreate', [CategoriasController::class, 'store'])->name('categorias.store');
    Route::delete('/categoriasdelete/{id}', [CategoriasController::class, 'destroy'])->name('categorias.destroy');
    Route::get('/categorias/show/{id}', [CategoriasController::class, 'show'])->name('categorias.show');
    Route::put('/categorias/update/{id}', [CategoriasController::class, 'update'])->name('categorias.update');
    Route::get('/categoriasbuscar', [CategoriasController::class, 'buscarRegistros'])->name('categorias.buscar');

    Route::get('/perfiles', [PerfilesController::class, 'index'])->name('perfiles.index');
    Route::put('/perfilesupdate/', [PerfilesController::class, 'update'])->name('perfiles.update');


   
    Route::get('/moduloscreate', [ModulosController::class, 'create'])->name('cmodulos.create');
    Route::post('/moduloscreate', [ModulosController::class, 'store'])->name('cmodulos.store');
    Route::delete('/modulosdelete/{id}', [ModulosController::class, 'destroy'])->name('cmodulos.destroy');
 
    Route::get('/usuarioscreate', [UsuariosController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarioscreate', [UsuariosController::class, 'store'])->name('usuarios.store');
    Route::delete('/usuariosdelete/{id}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');
    Route::get('/usuariosbuscar', [UsuariosController::class, 'buscarRegistros'])->name('usuarios.buscar');
    
     Route::prefix('marcas')->group(function () {
        Route::get('/show/{id}', [MarcasController::class, 'show'])->name('marcas.show');
        Route::put('/update/{id}', [MarcasController::class, 'update'])->name('marcas.update');
        Route::get('/', [MarcasController::class, 'index'])->name('marcas.index');
    
    }); 
    Route::prefix('usuarios')->group(function () {
        Route::get('/', [UsuariosController::class, 'index'])->name('usuarios.index');
        Route::get('/show/{id}', [UsuariosController::class, 'show'])->name('usuarios.show');
        Route::put('/update/{id}', [UsuariosController::class, 'update'])->name('usuarios.update');
    });  
    Route::prefix('reikomodulos')->group(function () {
        Route::get('/modulosshow/{id}', [ModulosController::class, 'show'])->name('cmodulos.show');
        Route::put('/modulosupdate/{id}', [ModulosController::class, 'update'])->name('cmodulos.update');
        Route::get('/', [ModulosController::class, 'index'])->name('cmodulos.index');

    }); 
    Route::get('productoscreate', [ProductosController::class, 'create'])->name('productos.create');
    Route::post('productoscreate', [ProductosController::class, 'store'])->name('productos.store');
    Route::delete('productosdelete/{id}', [ProductosController::class, 'destroy'])->name('productos.destroy');
    Route::get('productosbuscarcodigo', [ProductosController::class, 'buscarCodigo'])->name('productos.buscarcodigo');
    Route::get('productosbuscar', [ProductosController::class, 'buscarRegistros'])->name('productos.buscar');
  
    Route::prefix('productos')->group(function () {
        Route::get('/', [ProductosController::class, 'index'])->name('productos.index');
        Route::put('/update/{id}', [ProductosController::class, 'update'])->name('productos.update');
        Route::get('/show/{id}', [ProductosController::class, 'show'])->name('productos.show');
  });
    Route::prefix('caracteristicas')->group(function () {
        Route::get('/', [CaracteristicasController::class, 'index'])->name('caracteristicas.index');
        Route::get('/buscarid/{id_producto}', [CaracteristicasController::class, 'consultarCaracteristicasProducto'])->name('caracteristicas.consultar');
        Route::get('/agregar/{id_producto}', [CaracteristicasController::class, 'agregarcaracteristicas'])->name('caracteristicas.agregar');
        Route::get('/eliminar/{id_caracteristica}', [CaracteristicasController::class, 'eliminarcaracteristicas'])->name('caracteristicas.eliminar');
        Route::post('/actualizar/{id}', [CaracteristicasController::class, 'actualizarCaracteristica'])->name('caracteristicas.actualizar');
    });

      Route::get('seccionescreate', [SeccionesController::class, 'create'])->name('secciones.create');
    Route::post('seccionescreate', [SeccionesController::class, 'store'])->name('secciones.store');
    Route::delete('seccionesdelete/{id}', [SeccionesController::class, 'destroy'])->name('secciones.destroy');
    Route::get('seccionesbuscarcodigo', [SeccionesController::class, 'buscarCodigo'])->name('secciones.buscarcodigo');
  Route::get('seccionesbuscar', [SeccionesController::class, 'buscarRegistros'])->name('secciones.buscar');
  
    Route::prefix('secciones')->group(function () {
        Route::get('/', [SeccionesController::class, 'index'])->name('secciones.index');
        Route::put('/update/{id}', [SeccionesController::class, 'update'])->name('secciones.update');
        Route::get('/show/{id}', [SeccionesController::class, 'show'])->name('secciones.show');
      

    });
    Route::prefix('modulos')->group(function () {
        Route::get('/', [ModulosController::class, 'index'])->name('modulos.index');
        Route::delete('/modulosdelete/{id}', [ModulosController::class, 'destroy'])->name('modulos.destroy');
        Route::get('/modulosshow/{id}', [ModulosController::class, 'show'])->name('modulos.show');
        Route::put('/modulosupdate/{id}', [ModulosController::class, 'update'])->name('modulos.update');
                
    });
    
    Route::get('/restbuscarrutas', [RestriccionRutasController::class, 'buscarRutas'])->name('restriccionrutas.buscarrutas');
    Route::get('/restbuscarusuarios', [RestriccionRutasController::class, 'buscar'])->name('restriccionrutas.buscar');
         // Relación por usuario (para pintar)
    Route::get('/moduloseccionbuscarmodulos', [ModuloSeccionController::class, 'buscarModulos'])->name('moduloseccion.buscarModulos');
    Route::get('/moduloseccionbuscarseccion', [ModuloSeccionController::class, 'buscar'])->name('moduloseccion.buscar');
Route::prefix('moduloseccion')->group(function () {
    // Vista principal (listado módulos y secciones)
    Route::get('/', [ModuloSeccionController::class, 'index'])->name('moduloseccion.index');

    // Guardar relaciones módulo-sección
    Route::post('/store', [ModuloSeccionController::class, 'store'])->name('moduloseccion.store');

    // Obtener secciones asociadas a un módulo (para pintar/editar)
    Route::get('/secrelacionesmodulos/{modulo_id}', [ModuloSeccionController::class, 'relacionesPorModulo'])
        ->name('moduloseccion.relacionesporModulo');
    Route::get('/secrelacionessecciones/{seccion_id}', [ModuloSeccionController::class, 'relacionesPorSeccion'])->name('moduloseccion.relacionesporSeccion');
         
    // Cambiar estado o desasociar sección de un módulo
    Route::post('/cambiarestado', [ModuloSeccionController::class, 'cambiarEstado'])
        ->name('moduloseccion.cambiarestado');
});
    Route::prefix('restriccionrutas')->group(function () {
            // Vista principal
            Route::get( '/', [RestriccionRutasController::class, 'index'])->name('restriccionrutas.index');
          
            // Guardar relaciones
            Route::post('/store', [RestriccionRutasController::class, 'store'])->name('restriccionrutas.store');
            Route::get('/retrelacionesusuario/{user_id}', [RestriccionRutasController::class, 'relacionesPorUsuario'])->name('restriccionrutas.retrelacionesusuario');

            // Relación por ruta (para pintar)
            Route::get('/retrelacionesruta/{ruta_id}', [RestriccionRutasController::class, 'relacionesPorRuta'])->name('restriccionrutas.retrelacionesruta');
            Route::post('/cambiarestado', [RestriccionRutasController::class, 'cambiarEstado'])
                ->name('restriccionrutas.cambiarestado');
    });  

    Route::get('/subcaracteristicas/buscarid/{id_caracteristica}', [SubcaracteristicasController::class, 'consultarsubcaracteristicas'])->name('subcaracteristicas.consultar');
    Route::get('/subcaracteristicas/agregar/{id_caracteristica}', [SubcaracteristicasController::class, 'agregarsubcaracteristica'])->name('subcaracteristicas.agregar');
    Route::get('/subcaracteristicas/eliminar/{id_caracteristica}', [SubcaracteristicasController::class, 'eliminarsubcaracteristica'])->name('subcaracteristicas.eliminar');
    Route::post('/subcaracteristicas/actualizar/{id}', [SubcaracteristicasController::class, 'actualizarsubcaracteristica'])->name('subcaracteristicas.actualizar');

    Route::get('/rutas', [RutasController::class, 'index'])->name('rutas.index');
    Route::get('/rutas/modulo/{moduloId}', [RutasController::class, 'obtenerRutasPorModulo'])->name('rutas.porModulo');
    Route::post('/rutas', [RutasController::class, 'store'])->name('rutas.store');
    Route::get('rutascreate', [RutasController::class, 'create'])->name('rutas.create');
    Route::post('rutascreate', [RutasController::class, 'store'])->name('rutas.store');
    Route::delete('rutasdelete/{id}', [RutasController::class, 'destroy'])->name('rutas.destroy');
    Route::get('rutas/show/{id}', [RutasController::class, 'show'])->name('rutas.show');
    Route::put('rutas/update/{id}', [RutasController::class, 'update'])->name('rutas.update');
   
    Route::prefix('chats')->group(function () {
        Route::get('/contadorconversation/aqui', [ChatsController::class, 'contadorConversaciones']);

        Route::get('/', [ChatsController::class, 'index'])->name('chats.index');
        Route::post('/store', [ChatsController::class, 'store'])->name('chats.store');
        Route::get('/show/{id}', [ChatsController::class, 'show'])->name('chats.show');
        
        Route::delete('/delete-conversation/{userId}', [ChatsController::class, 'deleteConversation']);
        Route::delete('/ocultar-conversation/{userId}', [ChatsController::class, 'ocultarConversacion']);
        Route::delete('/delete-message/{id}', [ChatsController::class, 'destroyMessage']);
        
        // Ocultar mensaje enviado (solo para el usuario que envió)
        Route::patch('/ocultar-enviado/{id}', [ChatsController::class, 'ocultarMensajeEnviado']);
        // Ocultar mensaje recibido (solo para el receptor)
        Route::patch('/ocultar-recibido/{id}', [ChatsController::class, 'ocultarMensajeRecibido']);
        Route::patch('/marcar-leidos/{userId}', [ChatsController::class, 'marcarLeidos']);
    });

    Route::get('/rolusuario', [RolesUsuarioController::class, 'index'])->name('rolusuario.index');
    Route::post('/rolusuario/store', [RolesUsuarioController::class, 'store'])->name('rolusuario.store');

    Route::get('/tipousuarios', [TipousuariosController::class, 'index'])->name('tipousuarios.index');
    Route::get('/tipousuarioscreate', [TipousuariosController::class, 'create'])->name('tipousuarios.create');
    Route::post('/tipousuarioscreate', [TipousuariosController::class, 'store'])->name('tipousuarios.store');
    Route::delete('/tipousuariosdelete/{id}', [TipousuariosController::class, 'destroy'])->name('tipousuarios.destroy');
    Route::get('/tipousuarios/show/{id}', [TipousuariosController::class, 'show'])->name('tipousuarios.show');
    Route::put('/tipousuarios/update/{id}', [TipousuariosController::class, 'update'])->name('tipousuarios.update');

});

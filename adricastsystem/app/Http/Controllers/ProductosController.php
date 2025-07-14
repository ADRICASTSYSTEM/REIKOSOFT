<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Marca;
use App\Models\Modulo;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Rol;
use App\Models\Seccion;
use App\Models\TipoProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductosController extends Controller
{
    //
      //
      protected $rutaConcat;
      public function __construct()
      {
          $this->middleware('auth');
          $this->rutaConcat = config('app.ruta_concat');
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

        $moduloIds = Rol::where('estado', 1)->pluck('id_modulos')->unique();
        $modulos = Modulo::whereIn('id', $moduloIds)->get();
 
        $productos = Producto::all();
        $tipoProductos = TipoProducto::all();
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $secciones = Seccion::all();
       
        return view('reikosoft.productos.index' , compact('descripcion','user','modulos','productos','tipoProductos','categorias','marcas','secciones'));
    }
    public function create(){
        $typeUser = auth()->user()->typeUser;
        $tipoProducto = TipoProducto::all();
      
        $user = Auth::user();
        if ($typeUser) {
            $descripcion = $typeUser->descripcion;
        } else {
            $descripcion = 'No asignado';
        }

        $moduloIds = Rol::where('estado', 1)->pluck('id_modulos')->unique();
        $modulos = Modulo::whereIn('id', $moduloIds)->get();
        
        $productos = Producto::all();
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $tipoProductos = TipoProducto::all();
        $secciones = Seccion::all();
       
        return view('reikosoft.productos.create' , compact('descripcion','user','modulos','productos','categorias','marcas','tipoProductos','secciones'));

    }
    public function store(Request $request){
        $request->validate([
            'tipo_producto_id' => 'required|exists:tipo_productos,id',
            'nombre' => 'required',
            'descripcion' => 'required',
            'categoria_id' => 'required|exists:categorias,id',
            'marca_id' => 'required|exists:marcas,id',
            'precio' => 'required|numeric|min:0|max:999999.99',
            'codigo' => 'required',
            'en_stock' => 'nullable|boolean',
            'stock' => 'nullable|numeric|min:0|max:1000', // Permitir que el campo esté vacío si en_stock no está marcado
            'en_oferta' => 'nullable|boolean',
            'precio_oferta' => 'nullable|numeric|min:0|max:999999.99', // Permitir que el campo esté vacío si no está en oferta
            
            'publicar_web' => 'nullable|boolean',
            'linkcompra' => 'nullable',
        ]);
    
        try {
            $enOferta = $request->input('en_oferta') === true;
            $enStock = $request->input('en_stock') === true;
            $enWeb = $request->input('publicar_web') === true;
    
            // Ajustar los valores si no se marcan
            $stockValue = $enStock ? $request->input('stock') : 0;
            $precioOfertaValue = $enOferta ? $request->input('precio_oferta') : 0;
    
            // Crear un nuevo producto
            $producto = Producto::create([
                'tipo_producto_id' => $request->input('tipo_producto_id'),
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'categoria_id' => $request->input('categoria_id'),
                'marca_id' => $request->input('marca_id'),
                'precio' => $request->input('precio'),
                'en_stock' => $enStock,
                'stock' => $stockValue,
                'codigo' => $request->input('codigo'),
                'en_oferta' => $enOferta,
                'precio_oferta' => $precioOfertaValue,
                'publicar_web' => $enWeb,
                'linkdecompra' => $request->input('linkcompra'),
            ]);
    
    
            // Obtener el ID del producto después de crearlo
            $productoId = $producto->id;
         

            // Verificar si hay una imagen y guardarla con el nombre del ID del producto
            if ($request->hasFile('imagenproducto')) {
                $imagen = $request->file('imagenproducto');
                $nombreImagen = $productoId . '.' . $imagen->getClientOriginalExtension();
                $destino = public_path($this->rutaConcat.'img/productos');
                $imagen->move($destino, $nombreImagen);
                $imagenUrl = $nombreImagen;
    
                // Actualizar el campo 'foto' del producto con la URL de la imagen
                $producto->update([
                    'foto' => $imagenUrl,
                ]);
            }
    
            return response()->json(['success' => true, 'message' => 'El registro ha sido guardado']);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    public function destroy($id)
    {
        $registro = Producto::find($id);
         // Verificar si el usuario autenticado es el mismo que se está intentando eliminar
     
        $registro->delete();
        if ($registro->foto == null) {
            // Retornar una respuesta exitosa en formato JSON
            return response()->json(['success' => true, 'message' => 'El registro ha sido eliminado']);
        }
        $ruta= $this->rutaConcat. 'img/productos/'.$registro->foto;
        
        if (file_exists($ruta)) {
            unlink($ruta);
            // Aquí puedes realizar otras acciones después de eliminar el archivo
        } 
          // Retornar una respuesta exitosa en formato JSON
          return response()->json(['success' => true, 'message' => 'El registro ha sido eliminado']);
    }
    public function show($id)
    {
        $registro = Producto::find($id);
        return response()->json($registro);

    }
    public function update(Request $request, $id)
    {
        $registro = Producto::find($id);
    
        $request->validate([
            'tipo_producto_id' => 'required|exists:tipo_productos,id',
            'nombre' => 'required',
            'descripcion' => 'required',
            'categoria_id' => 'required|exists:categorias,id',
            'marca_id' => 'required|exists:marcas,id',
            'precio' => 'required|numeric|min:0|max:999999.99',
            'codigo' => 'required',
            'en_stock' => 'nullable|boolean',
            'stock' => 'nullable|numeric|min:0|max:1000', // Permitir que el campo esté vacío si en_stock no está marcado
            'en_oferta' => 'nullable|boolean',
            'precio_oferta' => 'nullable|numeric|min:0|max:999999.99', // Permitir que el campo esté vacío si no está en oferta
            
            'publicar_web' => 'nullable|boolean',
            'linkcompra' => 'nullable',
        ]);
      
        try {
            $enOferta = $request->boolean('en_oferta');
            $enStock = $request->boolean('en_stock');
            $enWeb = $request->boolean('publicar_web');

            // Ajustar los valores si no se marcan
            $stockValue = $enStock ? $request->input('stock') : 0;
            $precioOfertaValue = $enOferta ? $request->input('precio_oferta') : 0;
    
        

            if ($request->hasFile('imagenmodulo')) {
                $imagen = $request->file('imagenmodulo');
                $nombreImagen = $request->id . '.' . $imagen->getClientOriginalExtension();
                $destino = public_path($this->rutaConcat.'img/productos');
                $imagen->move($destino, $nombreImagen);
                $imagenUrl = $nombreImagen;
        
                // Actualizar solo si se proporciona una nueva imagen
                $registro->update([
                   
                    'foto' => $imagenUrl,
                    'tipo_producto_id' => $request->tipo_producto_id,
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                    'categoria_id' => $request->categoria_id,
                    'marca_id' => $request->marca_id,
                    'precio' => $request->precio,
                    'en_stock' => $enStock,
                    'stock' => $stockValue,
                    'codigo' => $request->codigo,
                    'en_oferta' => $enOferta,
                    'precio_oferta' => $precioOfertaValue,
                    'publicar_web' => $enWeb,
                    'linkdecompra' => $request->linkcompra,


    
                ]);
            } else {
                // Actualizar sin cambiar la imagen
                $registro->update([
                    'tipo_producto_id' => $request->tipo_producto_id,
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                    'categoria_id' => $request->categoria_id,
                    'marca_id' => $request->marca_id,
                    'precio' => $request->precio,
                    'en_stock' => $enStock,
                    'stock' => $stockValue,
                    'codigo' => $request->codigo,
                    'en_oferta' => $enOferta,
                    'precio_oferta' => $precioOfertaValue,
                    'publicar_web' => $enWeb,
                    'linkdecompra' => $request->linkcompra,
                
                ]);
            }
    
            return response()->json(['success' => true, 'message' => 'El registro ha sido guardado']);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        // Verificar si se proporcionó una nueva imagen
      
    
        
    } 

    public function buscarRegistros(Request $request)
    {
         // Obtener el valor de búsqueda del campo "busqueda"
         $valorBusqueda = $request->input('termino');
 
         // Realizar la búsqueda de registros según el valor proporcionado
         $registros = Producto::where('codigo', 'LIKE', "%$valorBusqueda%")
             ->orWhere('nombre', 'LIKE', "%$valorBusqueda%")
             
             ->get();
 
         // Retornar los registros en formato JSON
         return response()->json($registros->toArray());
     } 
     

     public function buscarCodigo(Request $request)
     {
         $valorBusqueda = $request->input('termino');
     
         // Realizar la búsqueda de registros según el valor proporcionado
         $producto = Producto::where('codigo', '=', $valorBusqueda)->with('marca')->first();
     
         // Verificar si se encontró el producto
         if ($producto) {
             // Obtener los datos del producto
             $datosProducto = [
                 'nombre' => $producto->nombre,
                 'descripcion' => $producto->descripcion,
                 'codigo' => $producto->codigo,
                 'id' => $producto->id,
                 // Añadir cualquier otro dato del producto que desees incluir en la respuesta JSON
             ];
     
             // Verificar si se encontró la marca asociada
             if ($producto->marca) {
                 // Obtener el nombre de la marca
                 $nombreMarca = $producto->marca->nombre;
                 $datosProducto['nombre_marca'] = $nombreMarca;
             }
     
             // Retornar los datos del producto en formato JSON
             return response()->json($datosProducto);
         } else {
            // El producto no fue encontrado, devuelve un mensaje de error
            return response()->json(['error' => 'Producto no encontrado para el código proporcionado']);
        }
     }
     

  
}

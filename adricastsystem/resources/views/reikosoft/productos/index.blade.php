@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')

    <script src="{{ route('recursos.show', ['js/reiko', 'productosreiko.js']) }}"></script>
    <script>
         var SearchUrl = "{{ route('productos.buscar') }}";  
  
    </script>
    <button type="button" id="btnEliminarSeleccionados" style="display: none;" class="btn-eliminar-seleccionados" onclick="eliminarDatos(obtenerProductosSeleccionados())">
        Eliminar seleccionados
    </button>

    <div class="busqueda-box">
        <i class="fas fa-search search-icon"></i>
        <input type="text" name="busqueda" id="busqueda" placeholder="Buscar productos..." class="busqueda-input">
    </div>

  
    <div class="nuevo">
         <!-- onclick="agregarDatos()" --> 
        <a  href="{{ route('productos.create') }}" class="btn-nuevo">
            <img src="{{ route('recursos.show',['img/productos', 'mas.png']) }}" alt="Nuevo" width="25">
            Nuevo Producto
        </a>
    </div>

    <div class="tabla-container">
        <table class="tabla">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Seleccionar</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="contenedorelemento">
                @foreach ($productos as $producto)
                    <tr>
                        <td>
                            <img src="{{ $producto->foto 
                                ? route('recursos.show', ['img/productos', $producto->foto]) 
                                : route('recursos.show', ['img', 'logotype.png']) }}" 
                                alt="Producto" width="80" height="80" style="object-fit: cover;">
                        </td>
                        <td>{{ $producto->nombre }}</td>
                        <td>
                            <input type="checkbox" name="productos_seleccionados[]" value="{{ $producto->id }}" onchange="actualizarVisibilidadBotonEliminar()">
                        </td>
                        <td>
                            <button onclick="eliminarDato('{{ $producto->id }}')" class="btn-accion eliminar">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button onclick="modificarDatos('{{ $producto->id }}')" class="btn-accion editar">
                                <i class="fa fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('reikosoft.productos.edit')


@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        consultaDatos(); // Agrega el evento keyup
    });
</script>
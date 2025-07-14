@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')

    <script src="{{ route('recursos.show', ['js/reiko', 'usuariosreiko.js']) }}"></script>
      <script>
         var SearchUrl = "{{ route('usuarios.buscar') }}";  
  
    </script>
    <button type="button" id="btnEliminarSeleccionados" style="display: none;" class="btn-eliminar-seleccionados" onclick="eliminarDatos(obtenerUsuariosSeleccionados())">
        Eliminar seleccionados
    </button>
   
    <div class="busqueda-box">
        <i class="fas fa-search search-icon"></i>
        <input type="text" name="busqueda" id="busqueda" placeholder="Buscar usuarios..." class="busqueda-input">
    </div>

     <div class="nuevo">
        <a href="{{ route('usuarios.create') }}" class="btn-nuevo">
            <img src="{{ route('recursos.show',['img/perfiles', 'mas.png']) }}" alt="Nuevo" width="25">
            Nuevo Usuario
        </a>
    </div>


    <!-- Tabla de usuarios -->
    <div class="tabla-container">
        <table class="tabla">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Usuario</th>
                    <th>Seleccionar</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="contenedorelemento">
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>
                            <img src="{{ $usuario->foto 
                                ? asset('img/perfiles/' . $usuario->foto) 
                                : route('recursos.show', ['img', 'logotype.png']) }}" 
                                alt="{{ $usuario->username }}" width="80" height="80" style="object-fit: cover;">
                        </td>
                        <td>{{ $usuario->username }}</td>
                        <td>
                            <input type="checkbox" name="usuarios_seleccionados[]" value="{{ $usuario->id }}" onchange="actualizarVisibilidadBotonEliminar()">
                        </td>
                        <td>
                            <button onclick="eliminarDato('{{ $usuario->id }}')" class="btn-accion eliminar">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button onclick="modificarDatos('{{ $usuario->id }}')" class="btn-accion editar">
                                <i class="fa fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="paginacion">
            {{ $usuarios->appends(['termino' => request()->get('termino')])->links() }}
        </div>
    </div>

    @include('reikosoft.usuarios.edit')

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        consultaDatos(); // Agrega el evento keyup
    });
</script>
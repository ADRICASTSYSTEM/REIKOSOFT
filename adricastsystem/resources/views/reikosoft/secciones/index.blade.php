@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')

    <script src="{{ route('recursos.show', ['js/reiko', 'seccionesreiko.js']) }}"></script>
    <script>
         var SearchUrl = "{{ route('secciones.buscar') }}";  
  
    </script>
    <button type="button" id="btnEliminarSeleccionados" style="display: none;" class="btn-eliminar-seleccionados" onclick="eliminarDatos(obtenerSeccionesSeleccionadas())">
        Eliminar seleccionados
    </button>

    <div class="busqueda-box">
        <i class="fas fa-search search-icon"></i>
        <input type="text" name="busqueda" id="busqueda" placeholder="Buscar secciones..." class="busqueda-input">
    </div>

  
    <div class="nuevo">
         <!-- onclick="agregarDatos()" --> 
        <a  href="{{ route('secciones.create') }}" class="btn-nuevo">
            <img src="{{ route('recursos.show',['img/secciones', 'mas.png']) }}" alt="Nuevo" width="25">
            Nueva Seccion
        </a>
    </div>

    <div class="tabla-container">
        <table class="tabla">
            <thead>
                <tr>
                
                    <th>Nombre</th>
                    <th>Seleccionar</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="contenedorelemento">
                @foreach ($secciones as $seccion)
                    <tr>
                       
                        <td>{{ $seccion->nombre }}</td>
                        <td>
                            <input type="checkbox" name="secciones_seleccionadas[]" value="{{ $seccion->id }}" onchange="actualizarVisibilidadBotonEliminar()">
                        </td>
                        <td>
                            <button onclick="eliminarDato('{{ $seccion->id }}')" class="btn-accion eliminar">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button onclick="modificarDatos('{{ $seccion->id }}')" class="btn-accion editar">
                                <i class="fa fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('reikosoft.secciones.edit')


@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        consultaDatos(); // Agrega el evento keyup
    });
</script>
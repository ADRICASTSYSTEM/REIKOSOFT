@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')

    <script src="{{ route('recursos.show', ['js/reiko', 'marcasreiko.js']) }}"></script>
    <script>
         var SearchUrl = "{{ route('marcas.buscar') }}";  
  
    </script>
    <button type="button" id="btnEliminarSeleccionados" style="display: none;" class="btn-eliminar-seleccionados" onclick="eliminarDatos(obtenerMarcasSeleccionadas())">
        Eliminar seleccionados
    </button>

    <div class="busqueda-box">
        <i class="fas fa-search search-icon"></i>
        <input type="text" name="busqueda" id="busqueda" placeholder="Buscar marcas..." class="busqueda-input">
    </div>

    <div class="nuevo">
        <a href="{{ route('marcas.create') }}" class="btn-nuevo">
            <img src="{{ route('recursos.show', ['img/marcas', 'mas.png']) }}" alt="Nueva Marca" width="25">
            Nueva Marca
        </a>
    </div>

    <div class="selector-registros">
        <label for="perPage">Registros por página:</label>
        <select id="perPage" onchange="cambiarRegistrosPorPagina()">
            <option value="5" {{ request()->perPage == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ request()->perPage == 10 ? 'selected' : '' }}>10</option>
            <option value="15" {{ request()->perPage == 15 ? 'selected' : '' }}>15</option>
            <option value="20" {{ request()->perPage == 20 ? 'selected' : '' }}>20</option>
        </select>
    </div>

    <div class="tabla-container">
        <table class="tabla">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Nombre</th>
                    <th>Seleccionar</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="contenedorelemento">
                @foreach ($marcas as $marca)
                    <tr>
                        <td>
                            <img src="{{ $marca->foto 
                                ? asset('img/marcas/' . $marca->foto) 
                                : route('recursos.show', ['img', 'logotype.png']) }}" 
                                alt="{{ $marca->nombre }}" width="80" height="80" style="object-fit: cover;">
                        </td>
                        <td>{{ $marca->nombre }}</td>
                        <td>
                            <input type="checkbox" name="marcas_seleccionadas[]" value="{{ $marca->id }}" onchange="actualizarVisibilidadBotonEliminar()">
                        </td>
                        <td>
                            <button onclick="eliminarDato('{{ $marca->id }}')" class="btn-accion eliminar">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button onclick="modificarDatos('{{ $marca->id }}')" class="btn-accion editar">
                                <i class="fa fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="paginacion">
            {{ $marcas->appends(['perPage' => request()->perPage])->links() }}
        </div>
    </div>

    @include('reikosoft.marcas.edit')

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        consultaDatos(); // Agrega el evento keyup
    });
    function cambiarRegistrosPorPagina() {
        var perPage = document.getElementById('perPage').value;
        window.location.href = '{{ route('marcas.index') }}?perPage=' + perPage;
    }
</script>

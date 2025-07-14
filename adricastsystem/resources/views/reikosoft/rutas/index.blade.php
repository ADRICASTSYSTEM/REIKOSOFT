@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'Gestión de Rutas')
@section('reikosoft-active', 'active')

@section('contenidoreiko')
<script src="{{ route('recursos.show', ['js/reiko', 'rutasreiko.js']) }}"></script>


<section class="containerreiko">
    <div class="contenedorformularios">

        <!-- Selección de módulo -->
        <div style="margin-bottom: 20px;">
            <label for="modulo_id">Seleccione Módulo:</label>
            <select id="modulo_id" name="modulo_id" class="roles-select" onchange="cargarRutasPorModulo(this.value)">
                <option disabled selected>Seleccione...</option>
                @foreach($modulos as $modulo)
                    <option value="{{ $modulo->id }}">{{ $modulo->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Botón para agregar nueva ruta -->
      
        <div class="nuevo">
         <!-- onclick="agregarDatos()" --> 
        <a  href="{{ route('rutas.create') }}" class="btn-nuevo">
            <img src="{{ route('recursos.show',['img/productos', 'mas.png']) }}" alt="Nuevo" width="25">
            Nueva Ruta
        </a>
        </div>

        <!-- Visualización de rutas -->
        <div id="contenedorRutas" class="rutas-container">
            {{-- Se llenará dinámicamente con rutas del módulo seleccionado --}}
        </div>

    </div>
</section>

<!-- Modal pendiente: se implementará después -->

<!-- Script de gestión de rutas -->
  @include('reikosoft.rutas.edit')

@endsection

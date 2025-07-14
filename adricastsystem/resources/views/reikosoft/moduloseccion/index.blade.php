@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'Asociación Sección - Módulo')
@section('reikosoft-active', 'active')

@section('contenidoreiko')

<script>
    var guardarRelacionesUrl = "{{ route('moduloseccion.store') }}";
    var buscarModulosUrl = "{{ route('moduloseccion.buscarModulos') }}";
    var buscarSeccionesUrl = "{{ route('moduloseccion.buscar') }}";
    var relacionesPorSeccionUrl = "/moduloseccion/secrelacionessecciones"; // Ej: /moduloseccion/seccion/1
    var cambiarEstadoUrl = "{{ route('moduloseccion.cambiarestado') }}";
</script>

<div class="restriccion-container">

    {{-- Listado de Secciones --}}
    <div class="restriccion-col">
        <h4>Secciones</h4>
        <div class="busqueda-box">
            <i class="fas fa-search search-icon"></i>
            <input type="text" id="buscar_seccion" placeholder="Buscar sección..." class="busqueda-input">
        </div>
        <div class="tabla-container">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Seleccionar</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="lista-secciones">
                    @foreach($secciones as $seccion)
                        <tr class="seccion-row" data-seccion-id="{{ $seccion->id }}">
                            <td><input type="checkbox" class="checkbox-seccion" value="{{ $seccion->id }}"></td>
                            <td>{{ $seccion->nombre }}</td>
                            <td>
                                <button 
                                    class="btn btn-warning btn-sm" 
                                    onclick="abrirModalRelaciones({{ $seccion->id }})"
                                    title="Gestionar relaciones">
                                    Deshabilitar relación
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Listado de Módulos --}}
    <div class="restriccion-col">
        <h4>Módulos</h4>
        <div class="busqueda-box">
            <i class="fas fa-search search-icon"></i>
            <input type="text" id="buscar_modulo" placeholder="Buscar módulo..." class="busqueda-input">
        </div>
        <div class="tabla-container">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Seleccionar</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody id="lista-modulos">
                    @foreach($modulos as $modulo)
                        <tr class="modulo-row" data-modulo-id="{{ $modulo->id }}">
                            <td><input type="checkbox" class="checkbox-modulo" value="{{ $modulo->id }}"></td>
                            <td>{{ $modulo->nombre }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- Botón Guardar --}}
<div class="text-center mt-3">
    <button class="btn btn-primary" onclick="guardarRelacionesModuloSeccion()">Guardar Relaciones</button>
</div>

{{-- Modal para deshabilitar relación --}}
<div class="reikomodal" id="relacionesModal" style="display:none;">
    <div class="contenidomodal" style="max-width: 500px;">
        <div class="bannertitulo">
            Relaciones Sección - Módulo
        </div>
        <div class="closemodal">
            <button onclick="cerrarModalRelaciones()">
                <span class="fa fa-times"></span>
            </button>
        </div>
        <div class="cuerpomodal">
            <form id="relacionesForm" onsubmit="event.preventDefault(); cambiarEstadoRelacion();">
                @csrf
                <input type="hidden" id="seccion_id" name="seccion_id" value="">

                <label for="relacion_select">Selecciona el módulo a deshabilitar:</label>
                <select id="relacion_select" name="modulo_id" style="width: 100%; padding: 8px; margin-bottom: 15px;">
                    <!-- Opciones cargadas por JS -->
                </select>

                <button type="submit" class="btn btn-danger" id="btn-deshabilitar">Deshabilitar Relación</button>
            </form>
        </div>
    </div>
</div>

{{-- Script JS --}}
<script src="{{ route('recursos.show', ['js/reiko', 'moduloseccionreiko.js']) }}"></script>

@endsection

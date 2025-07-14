@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'Restricción de Rutas')
@section('reikosoft-active', 'active')

@section('contenidoreiko')

<script>
    var buscarRestriccionesUrl = "{{ route('restriccionrutas.buscar') }}";
    var guardarRestriccionesUrl = "{{ route('restriccionrutas.store') }}";
    var buscarRutasUrl = "{{ route('restriccionrutas.buscarrutas') }}";

    var restrelacionesusuario = "restriccionrutas/retrelacionesusuario";
    var restrelacionesruta = "restriccionrutas/retrelacionesruta";
    var cambiarEstadoUrl = "{{ route('restriccionrutas.cambiarestado') }}";
</script>

<div class="restriccion-container">

    {{-- Buscador de usuarios --}}
    <div class="restriccion-col">
        <div class="busqueda-box">
            <i class="fas fa-search search-icon"></i>
            <input type="text" id="buscar_usuario" placeholder="Buscar usuario..." class="busqueda-input">
        </div>

        <div class="tabla-container">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Seleccionar</th>
                        <th>Usuario</th>
                        <th>Acciones</th> {{-- Nueva columna --}}
                    </tr>
                </thead>
                <tbody id="lista-usuarios">
                    @foreach($usuarios as $usuario)
                        <tr class="usuario-row" data-user-id="{{ $usuario->id }}">
                            <td><input type="checkbox" class="checkbox-usuario" value="{{ $usuario->id }}"></td>
                            <td>{{ $usuario->nombres }} {{ $usuario->apellidos }}</td>
                            <td>
                                <button 
                                    class="btn btn-warning btn-sm" 
                                    onclick="abrirModalRelaciones({{ $usuario->id }})"
                                    title="Gestionar relaciones">
                                    Deshabilitar restricción
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Buscador de rutas --}}
    <div class="restriccion-col">
        <div class="busqueda-box">
            <select id="modulo_id" class="form-control mb-2">
                <option value="">-- Módulo --</option>
                @foreach($modulos as $modulo)
                    <option value="{{ $modulo->id }}">{{ $modulo->nombre }}</option>
                @endforeach
            </select>
            <input type="text" id="buscar_ruta" placeholder="Buscar ruta..." class="busqueda-input mt-1">
        </div>

        <div class="tabla-container">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Seleccionar</th>
                        <th>Ruta</th>
                        <th>URL</th>
                    </tr>
                </thead>
                <tbody id="lista-rutas">
                    @foreach($rutas as $ruta)
                        <tr class="ruta-row" data-ruta-id="{{ $ruta->id }}">
                            <td><input type="checkbox" class="checkbox-ruta" value="{{ $ruta->id }}"></td>
                            <td>{{ $ruta->nombre }}</td>
                            <td><small>{{ $ruta->url }}</small></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Botón para guardar relaciones --}}
<div class="text-center mt-3">
    <button class="btn btn-primary" onclick="guardarRestricciones()">Guardar/Actualizar Restricciones</button>
</div>

{{-- Modal para deshabilitar relación --}}
<div class="reikomodal" id="relacionesModal" style="display:none;">
    <div class="contenidomodal" style="max-width: 500px;">
        <div class="bannertitulo">
            Relaciones Usuario - Ruta
        </div>
        <div class="closemodal">
           <button onclick="cerrarModalRelaciones()">
                <span class="fa fa-times"></span>
           </button>
        </div>
        <div class="cuerpomodal">
            <form id="relacionesForm" onsubmit="event.preventDefault(); cambiarEstadoRelacion();">
                @csrf
                <input type="hidden" id="usuario_id" name="usuario_id" value="">
                
                <label for="relacion_select">Selecciona la relación a deshabilitar:</label>
                <select id="relacion_select" name="ruta_id" style="width: 100%; padding: 8px; margin-bottom: 15px;">
                    <!-- Opciones cargadas por JS -->
                </select>

                <button type="submit" class="btn btn-danger">Deshabilitar Relación</button>
            </form>
        </div>
    </div>
</div>

<script src="{{ route('recursos.show', ['js/reiko', 'restriccionrutasreiko.js']) }}"></script>

@endsection

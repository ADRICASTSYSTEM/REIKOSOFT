@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')

    <script src="{{ route('recursos.show', ['js/reiko', 'contactoreiko.js']) }}"></script>

    Busqueda
    <input type="text" name="busqueda" id="busqueda" placeholder="Busqueda de Datos" onkeyup="consultaDatos()" style="width: 200px;">
    <select name="select" id="select" style="width: 150px; padding:5px; border-radius:5px; height:40px;" onchange="consultaDatos()">
        <option value="leido">Leido</option>
        <option value="no_leido">No Leido</option>
        <option value="todos">Todos</option>
    </select>
    <section class="containerreiko2">
        <!-- Modificado el onclick para llamar a la función eliminarDatos -->
        <button type="button" id="btnEliminarSeleccionados" class="btn" style="display: none;" onclick="eliminarDatos(obtenerMensajesSeleccionados())">Eliminar seleccionados</button>

        <div class="contenedormensajeria">
            <div class="contenidomensajeria" id="contenidomensajeria">
                @foreach ($mensajes as $mensaje)
                    @if ($mensaje->status =='leido')
                        <p style="color: green;">Mensaje Leido</p>
                        <div class="mensaje" style="border: 1px solid green;">
                    @elseif ($mensaje->status =='no_leido')
                        <p style="color: blue;">Mensaje no Leido</p>
                        <div class="mensaje" style="border: 1px solid blue;">
                    @endif
                        <div class="elemento">
                            <input type="checkbox" name="mensajes_seleccionados[]" value="{{ $mensaje->id }}">
                            <span class="etiqueta">Nombre:</span>
                            <span class="dato">{{ $mensaje->nombre }}</span>
                        </div>
                        <div class="elemento">
                            <span class="etiqueta">Correo:</span>
                            <span class="dato">{{ $mensaje->correo }}</span>
                        </div>
                        <div class="elemento">
                            <span class="etiqueta">Asunto:</span>
                            <span class="dato">{{ $mensaje->asunto }}</span>
                        </div>
                        <div class="elemento" style="display: flex;">
                            <button type="button" onclick="obtenerDatos('{{ $mensaje->id }}')" class="btnver">Ver</button>
                            <!-- Modificado el onclick para llamar a la función eliminarDato -->
                            <button type="button" onclick="eliminarDato('{{ $mensaje->id }}')" class="btneliminar">Eliminar</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    
    @include('reikosoft.contacto.show') 
@endsection

@section('scripts')
    <!-- Incluye el archivo JavaScript -->
    <script src="{{ route('recursos.show', ['js/reiko', 'contactoreiko.js']) }}"></script>
@endsection


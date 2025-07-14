@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')

    <script src="{{ route('recursos.show', ['js/reiko', 'modulosreiko.js']) }}"></script>
    <button type="button" id="btnEliminarSeleccionados" style="display: none;" class="btn" onclick="eliminarDatos(obtenerModulosSeleccionados())">Eliminar seleccionados</button>

  <section class="containerreiko">
    <div class="contenedormodulos">

        {{-- Nuevo Módulo --}}
        <div class="modulo-contenedor">
            <div class="dropdown" style="visibility: hidden;">
                {{-- Espacio para que no salte el diseño, pero sin dropdown visible --}}
                <button class="menu-button" disabled>⋮</button>
            </div>
            <div class="target">
                <a href="{{ route('cmodulos.create') }}">
                    <img src="{{ route('recursos.show',['img/modulos', 'mas.png']) }}" alt="Nuevo Módulo">
                    <p>Nuevo Módulo</p>
                </a>
            </div>
            <div class="checkbox-container">
                {{-- Aquí no tiene checkbox porque no tiene sentido --}}
            </div>
        </div>

        {{-- HOME --}}
        <div class="modulo-contenedor">
            <div class="dropdown" style="visibility: hidden;">
                <button class="menu-button" disabled>⋮</button>
            </div>
            <div class="target">
                <a href="{{ route('posts.index') }}">
                    <img src="{{ route('recursos.show',['img/modulos', 'home.png']) }}" alt="Home">
                    <p>HOME</p>
                </a>
            </div>
            <div class="checkbox-container"></div>
        </div>

  
     

        {{-- Los módulos dinámicos --}}
        @foreach ($modulos as $modulo)
        <div class="modulo-contenedor">
            <div class="dropdown">
                <button class="menu-button" onclick="toggleDropdown(event)">⋮</button>
                <div class="dropdown-content">
                    <button onclick="modificarDatos('{{ $modulo->id }}')">Editar</button>
                    <button onclick="eliminarDatos('{{ $modulo->id }}')">Eliminar</button>
                </div>
            </div>

            <div class="target">
                <a href="{{ Route::has($modulo->ruta.'.index') ? route($modulo->ruta.'.index') : '#' }}" ondblclick="redirigir('{{ $modulo->ruta }}')">
                    <img src="{{ asset('img/modulos/' . $modulo->icono) }}" alt="{{ $modulo->icono }}">
                    <p>{{ $modulo->nombre }}</p>
                </a>
            </div>

            <div class="checkbox-container">
                <input type="checkbox" name="modulos_seleccionados[]" value="{{ $modulo->id }}" onchange="actualizarVisibilidadBotonEliminar()">
            </div>
        </div>
        @endforeach
    </div>
</section>

    
    @include('reikosoft.modulos.edit') 

@endsection

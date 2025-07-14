@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')

    <script src="{{ route('recursos.show', ['js/reiko', 'categoriasreiko.js']) }}"></script>
    <button type="button" id="btnEliminarSeleccionados" style="display: none;" class="btn" onclick="eliminarDatos(obtenerCategoriasSeleccionadas())">Eliminar seleccionados</button>

  <section class="containerreiko">
    <div class="contenedormodulos">

        {{-- Nueva Categoria --}}
        <div class="modulo-contenedor">
            <div class="dropdown" style="visibility: hidden;">
                {{-- Espacio para diseño consistente pero sin dropdown visible --}}
                <button class="menu-button" disabled>⋮</button>
            </div>
            <div class="target">
                <a href="{{ route('categorias.create') }}">
                    <img src="{{ route('recursos.show',['img/categorias', 'mas.png']) }}" alt="Nueva Categoria">
                    <p>Nueva Categoria</p>
                </a>
            </div>
            <div class="checkbox-container">
                {{-- Sin checkbox aquí --}}
            </div>
        </div>

        {{-- Categorias dinámicas --}}
        @foreach ($categorias as $categoria)
        <div class="modulo-contenedor">
            <div class="dropdown">
                <button class="menu-button" onclick="toggleDropdown(event)">⋮</button>
                <div class="dropdown-content">
                    <button onclick="modificarDatos('{{ $categoria->id }}')">Editar</button>
                    <button onclick="eliminarDato('{{ $categoria->id }}')">Eliminar</button>
                </div>
            </div>

            <div class="target">
                <a href="#">
                    @if ($categoria->foto)
                    <img src="{{ asset('img/categorias/' . $categoria->foto) }}" alt="{{ $categoria->nombre }}">
                    @else
                    <img src="{{ route('recursos.show', ['img', 'logotype.png']) }}" alt="Sin imagen" height="150px" width="150px">
                    @endif
                    <p>{{ $categoria->nombre }}</p>
                </a>
            </div>

            <div class="checkbox-container">
                <input type="checkbox" name="categorias_seleccionadas[]" value="{{ $categoria->id }}" onchange="actualizarVisibilidadBotonEliminar()">
            </div>
        </div>
        @endforeach

    </div>
  </section>

  @include('reikosoft.categorias.edit') 

@endsection

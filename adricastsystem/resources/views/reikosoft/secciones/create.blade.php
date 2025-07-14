@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')
    <script src="{{ route('recursos.show', ['js/reiko', 'seccionesReiko.js']) }}"></script>
    <script>
        var StoreUrl = "{{ route('secciones.store') }}";   
    </script>

    <section class="containerreiko">
        <div class="contenedorformularios">
            <form action="{{ route('secciones.store') }}" id="miFormulario" method="post" enctype="multipart/form-data" novalidate>
                @csrf

                <input type="text" placeholder="Ingrese Nombre" name="nombre" id="nombre" value="" required>
                <input type="text" placeholder="Ingrese Descripción" name="descripcion" id="descripcion" value="" required>
                <input type="text" placeholder="Clase de ícono (ej. fas fa-cog)" name="icono" id="icono" value="" required>

                <div style="display:flex; margin-top: 10px;">
                    <button style="margin-right: 10px;" class="btn" type="submit" onclick="event.preventDefault(); guardarDatos();">Guardar</button>
                    <button style="margin-right: 10px;" class="btn" onclick="event.preventDefault(); principal();">Cancelar</button>
                </div>
            </form>
        </div>
    </section>
@endsection

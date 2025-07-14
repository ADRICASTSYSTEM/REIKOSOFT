@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')
    <script src="{{ route('recursos.show', ['js/reiko', 'modulosreiko.js']) }}"></script>
    <script>
        var StoreUrl = "{{ route('cmodulos.store') }}";   
    </script>
    <section class="containerreiko">
        
        <div class="contenedorformularios">
            <form action="{{route('cmodulos.store')}}" id="miFormulario" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                <img src="" alt="" id="imagen-preview" style="max-width: 100%; display: none;">
                <input type="file" name="imagenmodulo" id="file-input" onchange="cargarImagen()">
                <button class="btn" type="button" id="quitarImagen" style="display: none;" onclick="quitarImg()">Quitar Imagen</button>
  
                <input type="text" name="nombre" id="nombre" placeholder="Nombre del Modulo">
                <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion del Modulo">
                <input type="text" name="ruta" id="ruta" placeholder="Ruta del Modulo">
                <div style="display:flex;">
                <button style="margin-right: 10px;" class="btn" type="submit" onclick="event.preventDefault(); guardarDatos();">Guardar</button>
                <button style="margin-right: 10px;" class="btn" onclick="event.preventDefault(); principal();">Cancelar</button>
                </div>
            </form>
      
         
        </div>
    
    </section>
@endsection
   
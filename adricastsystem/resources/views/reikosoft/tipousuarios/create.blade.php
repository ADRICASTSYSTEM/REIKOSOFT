@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')
    <script src="{{ route('recursos.show', ['js/reiko', 'tipousuariosreiko.js']) }}"></script>
    <script>
        var StoreUrl = "{{ route('tipousuarios.store') }}";   
    </script>
    <section class="containerreiko">
        
        <div class="contenedorformularios">
            <form action="{{route('tipousuarios.store')}}" id="miFormulario" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                <img src="" alt="" id="imagen-preview" style="max-width: 100%; display: none;">
               
                <input type="text" name="descripcion" id="descripcion" placeholder="Nuevo Tipo de Usuario">
                 <div style="display:flex;">
                <button style="margin-right: 10px;" type="submit" onclick="event.preventDefault(); guardarDatos();">Guardar</button>
                <button style="margin-right: 10px;" onclick="event.preventDefault(); principal();">Cancelar</button>
                </div>
            </form>
      
         
        </div>
    
    </section>
@endsection
   
@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')

    <script src="{{ route('recursos.show', ['js/reiko', 'tipousuariosreiko.js']) }}"></script>
    <button type="button" id="btnEliminarSeleccionados" style="display: none;" class="btn" onclick="eliminarDatos(obtenerTipoUsuariosSeleccionados())">Eliminar seleccionados</button>
 
    Busqueda
    <input type="text" name="busqueda" id="busqueda" placeholder="Busqueda de Datos" onkeyup="consultaDatos()" style="width: 200px;">
   
    <section class="containerreiko">
       
        <div class="contenedormodulos" id="contenedorelemento">
            <a href="{{ route('tipousuarios.create') }}">
                <div class="target">
                        
                        <img src="{{ route('recursos.show',['img/tipousuarios', 'mas.png']) }}" alt="Ventas">
                        <p>Nuevo Tipo Usuario </p>
                </div>
            </a>
            
            @foreach ($tipousuarios as $tipousuario)
                <a>
                    <div class="target">
                   
                        <img src="{{ route('recursos.show', ['img/tipousuarios', 'tipousuarios.png']) }}" alt=""  height="150px" width="150px">
                 
                      <p>{{ $tipousuario->descripcion }}</p>
                        <div class="botones">
                            {{-- Checkbox --}}
                            <input type="checkbox" name="tipousuarios_seleccionados[]" value="{{ $tipousuario->id }}" onchange="actualizarVisibilidadBotonEliminar()">
                            
                            {{-- Botón Eliminar --}}
                            <button onclick="eliminarDatos('{{ $tipousuario->id }}')">
                                <i class="fas fa-trash"></i> 
                            </button>

                            {{-- Botón Modificar --}}
                            <button class="btneditar" onclick="modificarDatos('{{ $tipousuario->id }}')">
                                <span class="fa fa-edit"></span>
                            </button>
                            
                        </div>
                    </div>
                </a>
                @endforeach

           
        </div>
     
    </section>
    
    @include('reikosoft.tipousuarios.edit') 

@endsection
   
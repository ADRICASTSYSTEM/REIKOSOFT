<div class="reikomodal" id="editmodal">
    <div class="contenidomodal">
        <div class="bannertitulo">
            Tipo Usuarios
        </div>
        <div class="closemodal">
           <button onclick="cerrarModal()">
                <span class="fa fa-times"></span>
           </button>
        </div>
        <div class="cuerpomodal">
            <form action="{{route('tipousuarios.update', '__ID__')}}" id="miFormulario" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')
                 <input type="text" name="descripcion" id="descripcion" placeholder="Tipo Usuarios">
                
                <button type="submit" id="modificarbtn" onclick="event.preventDefault(); actualizarDatos();">Modificar</button>
              
            </form>
        </div>

    </div>
</div>
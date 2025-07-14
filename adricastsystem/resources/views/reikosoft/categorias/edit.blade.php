<div class="reikomodal" id="editmodal">
    <div class="contenidomodal">
        <div class="bannertitulo">
            Categorias
        </div>
        <div class="closemodal">
           <button onclick="cerrarModal()">
                <span class="fa fa-times"></span>
           </button>
        </div>
        <div class="cuerpomodal">
            <form action="{{route('categorias.update', '__ID__')}}" id="miFormulario" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')
                <img src="" alt="" id="imagen-preview" style="max-width: 100%; display: none;">
                <input type="file" name="imagencategoria" id="file-input" onchange="cargarImagen()">
                <button class="btn" type="button" id="quitarImagen" style="display: none;" onclick="quitarImg()">Quitar Imagen</button>
  
                <input type="text" name="nombre" id="nombre" placeholder="Nombre de Categoria">
                <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion de Categoria">
                
                <button type="submit" id="modificarbtn" onclick="event.preventDefault(); actualizarDatos();">Modificar</button>
              
            </form>
        </div>

    </div>
</div>
<div class="reikomodal" id="editmodal">
    <div class="contenidomodal">
        <div class="bannertitulo">
            Usuarios
        </div>
        <div class="closemodal">
           <button onclick="cerrarModal()">
                <span class="fa fa-times"></span>
           </button>
        </div>
        <div class="cuerpomodal">
            <form action="{{route('usuarios.update', '__ID__')}}" id="miFormulario" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')
                <img src="" alt="" id="imagen-preview" style="max-width: 100%; display: none;">
              
                <input type="file" name="imagenmodulo" id="file-input" onchange="cargarImagen()">
                <button class="btn" type="button" id="quitarImagen" style="display: none;" onclick="quitarImg()">Quitar Imagen</button>
                <input type="text" placeholder="Ingrese Nombres"  name="nombres" id="nombres" value="" required>
                <input type="text" placeholder="Ingrese Apellidos"  name="apellidos" id="apellidos" value="" required>                  
                <input type="user" placeholder="Ingrese Direccion"  name="direccion" id="direccion" value="" required>  
                <input type="phone" placeholder="Ingrese Telefono"  name="telefono" id="telefono" value="" required>
                <input type="email" placeholder="Ingrese Correo" name="email" id="email" required>
                <button type="submit" id="modificarbtn" onclick="event.preventDefault(); actualizarDatos();">Modificar</button>
             
            </form>
        </div>

    </div>
</div>
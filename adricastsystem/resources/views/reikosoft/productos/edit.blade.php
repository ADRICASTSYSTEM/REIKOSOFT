<div class="reikomodal" id="editmodal">
    <div class="contenidomodal">
        <div class="bannertitulo">
            Productos
        </div>
        <div class="closemodal">
           <button onclick="cerrarModaledit()">
                <span class="fa fa-times"></span>
           </button>
        </div>
        <div class="cuerpomodal">
            <form action="{{route('productos.update', '__ID__')}}" id="miFormulario" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')
                
                <img src="" alt="" id="imagen-preview" style="max-width: 100%; display: none;">

                <input type="file" name="imagenmodulo" id="file-input" onchange="cargarImagen()">
                <button class="btn" type="button" id="quitarImagen" style="display: none;" onclick="quitarImg()">Quitar Imagen</button>
                <select name="tipo_producto_id" id="id_tipo_producto">
                    @foreach($tipoProductos as $tipoproducto)
                        <option value="{{ $tipoproducto->id }}" selected>{{ $tipoproducto->nombre }}</option>
                    @endforeach
                </select>
                <select name="categoria_id" id="id_categoria">
                    @foreach($categorias as $categoria)
                       
                            <option value="{{ $categoria->id }}" selected>{{ $categoria->nombre }}</option>
                
                    @endforeach
                </select>
                <input type="text" placeholder="Ingrese Nombre"  name="nombre" id="nombre" value="" required>
                <input type="text" placeholder="Ingrese Descripcion"  name="descripcion" id="descripcion" value="" required>
                <input type="number" placeholder="Ingrese Precio"  name="precio" id="precio" value="" required>
                <div style="display: flex; height:30px; width:auto;">
                    <label for="en_stock" style="width: 90%;">Stock </label>
                    
                    <input type="checkbox" style="height: 30px;" name="en_stock" id="en_stock" value="1">

                </div>
                <input type="text" placeholder="Ingrese Stock"  name="stock" id="stock" value="" required>
                <input type="text" placeholder="Ingrese Codigo"  name="codigo" id="codigo" value="" required>
                <select name="marca_id" id="id_marca">
                    @foreach($marcas as $marca)
                       
                            <option value="{{ $marca->id }}" selected>{{ $marca->nombre }}</option>
                
                    @endforeach
                </select>
                <div style="display: flex; height:30px; width:auto;">
                    <label for="en_oferta" style="width: 90%;">Oferta </label>
                    
                    <input type="checkbox" style="height: 30px;" name="en_oferta" id="en_oferta" value="1">

                </div>  
                <input type="number" placeholder="Ingrese Precio"  name="precio_oferta" id="precio_oferta" value="" required>
                <div style="display: flex; height:30px; width:auto;">
                    <label for="publicar_web" style="width: 90%;">Publicar </label>
                    
                    <input type="checkbox" style="height: 30px;" name="publicar_web" id="publicar_web" value="1">

                </div>
                <input type="text" placeholder="Ingrese Link de Compra"  name="linkcompra" id="linkcompra" value="" required>
  
               <button type="submit" id="modificarbtn" onclick="event.preventDefault(); actualizarDatos();">Modificar</button>
              
            </form>
        </div>

    </div>
</div>
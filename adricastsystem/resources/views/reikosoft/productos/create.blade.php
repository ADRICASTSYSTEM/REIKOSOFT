@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')
    <script src="{{ route('recursos.show', ['js/reiko', 'productosReiko.js']) }}"></script>
    <script>
        var StoreUrl = "{{ route('productos.store') }}";   
    </script>
    <section class="containerreiko">
        
        <div class="contenedorformularios">
            <form action="{{route('productos.store')}}" id="miFormulario" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                    <img src="{{ route('recursos.show', ['img', 'logotype.png']) }}" alt="" id="imagen-preview" height="150px" width="150px">
        
                    <input type="file" placeholder="Ingrese Foto"  name="imagenproducto" id="file-input" onchange="cargarImagen()" value="" required>
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
                    <input type="text" name="linkcompra" id="linkcompra" placeholder="link compra individual">
                <div style="display:flex;">
                <button style="margin-right: 10px;" type="submit" onclick="event.preventDefault(); guardarDatos();">Guardar</button>
                <button style="margin-right: 10px;" onclick="event.preventDefault(); principal();">Cancelar</button>
                </div>
                
            </form>
      
            <script>
                
            </script>
   
        </div>
    
    </section>

@endsection
   
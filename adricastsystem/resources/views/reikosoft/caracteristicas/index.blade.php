@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')

    <script src="{{ route('recursos.show', ['js/reiko', 'caracteristicasreiko.js']) }}"></script>
    <script src="{{ route('recursos.show', ['js/reiko', 'subcaracteristicasreiko.js']) }}"></script>
 
    <div class="contenedorbusqueda">
        Busqueda
        <input type="text" name="busqueda" id="busqueda" placeholder="Ingrese el Codigo del Producto"  style="width: 200px;">
        <input type="button" value="buscar"  onclick="consultaProductoCodigo()">
    </div>
   
    <section class="containerreiko2">
        <div class="containerelemento">
            <div class="elemento1">
                <label for="codigo">Codigo</label>
                <input type="text" name="codigo" id="codigo" readonly>
            </div>
            <div class="elemento2">
                <label for="nombre">Producto</label>
                <input type="text" name="nombre" id="nombre" readonly>
            </div>
            <div class="elemento3">
                <label for="descripcion">Descripcion</label>
                <input type="text" name="descripcion" id="descripcion" readonly>
            </div>
            <div class="elemento4">
                <label for="marca">Marca</label>
                <input type="text" name="marca" id="marca" readonly>
            </div>
        </div>
        <div class="contenedorcaracteristicas" id="contenedorcaracteristicas">
            <!-- Aquí se generará dinámicamente el contenido de las características -->
        </div>
              
        
       
        
       
    </section>
    
   

@endsection
   
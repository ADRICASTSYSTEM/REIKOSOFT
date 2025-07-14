@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')
    <script src="{{ route('recursos.show', ['js/reiko', 'usuariosreiko.js']) }}"></script>
    <script>
        var StoreUrl = "{{ route('usuarios.store') }}";   
    </script>
    <section class="containerreiko">
        
        <div class="contenedorformularios">
            <form action="{{route('usuarios.store')}}" id="miFormulario" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                    <input type="text" placeholder="Ingrese Nombres"  name="nombres" id="nombres" value="" required>
                   
                    <input type="text" placeholder="Ingrese Apellidos"  name="apellidos" id="apellidos" value="" required>
                                 
                    <input type="text" placeholder="Ingrese Direccion"  name="direccion" id="direccion" value="" required>
                   
                    <input type="tel" placeholder="Ingrese Telefono"  name="telefono" id="telefono" value="" required>
                  
                    <input type="email" placeholder="Ingrese Correo" name="email" id="email" required>
                    
                    <input type="text" placeholder="Ingrese Usuario" name="usuario" id="usuario"  required>
                 
                    

                    <select name="tipousuario_id" id="typeuser_id">
                        @foreach($tipousuario as $typeuser)
                           
                                <option value="{{ $typeuser->id }}" selected>{{ $typeuser->descripcion }}</option>
                    
                        @endforeach
                    </select>
                <div style="display:flex;">
                <button style="margin-right: 10px;" type="submit" onsubmit="event.preventDefault(); guardarDatos();">Guardar</button>
                <button style="margin-right: 10px;" onclick="event.preventDefault(); principal();">Cancelar</button>
                </div>
                
            </form>
      
         
        </div>
    
    </section>
    <script>
                    // Verificar si el elemento 'nombres' existe antes de agregar el evento
                if (document.getElementById('nombres')) {
                    document.getElementById('nombres').addEventListener('input', function () {
                        const apellidos = document.getElementById('apellidos').value;
                        const nombreUsuario = generarNombreUsuario(this.value, apellidos);
                        console.log(nombreUsuario);
                    });
                }

                // Verificar si el elemento 'apellidos' existe antes de agregar el evento
                if (document.getElementById('apellidos')) {
                    document.getElementById('apellidos').addEventListener('input', function () {
                    const nombres = document.getElementById('nombres').value;
                    const nombreUsuario = generarNombreUsuario(nombres, this.value);
                    console.log(nombreUsuario);
                });
                }
                generarNombreUsuario() 
     </script>
@endsection
   
@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')

    <script src="{{ route('recursos.show', ['js/reiko', 'perfilesreiko.js']) }}"></script>
  
    <section class="containerreiko">
       
       <div class="contenedorformularios">
            <form action="{{route('perfiles.update')}}" id="miFormulario" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')
                @if ($user->foto)
                            <img src="{{ route('recursos.show', ['img/perfiles', $user->foto]) }}"  alt="" id="imagen-preview" height="150px" width="150px">
                @else
                            <img src="{{ route('recursos.show', ['img', 'logotype.png']) }}" alt="" id="imagen-preview" height="150px" width="150px">
                @endif
                <label for="archivo" class="custom-file-upload">Imagen</label>
                <input id="archivo"  type="file" name="imagenmodulo" id="file-input" style="display: none;"  onchange="cargarImagen()">
                
                <button class="btn" type="button" id="quitarImagen" style="display: none;" onclick="quitarImg()">Quitar Imagen</button>
                
                @if(isset($user))
                    <p>{{ $user->nombres . " " . $user->apellidos }} </p>
                    @if(isset($user->typeUser))
                        <p>{{ $user->username . " - " . $user->typeUser->descripcion }}</p>
                    @endif
                @endif
                <input class="input-text" type="text" name="email" id="email" value="{{ $user->email }} " placeholder="ingresa su email">
                <input class="input-text" type="text" name="telefono" id="telefono" value="{{ $user->telefono }} " placeholder="ingresa su telefono">
                <input class="input-text" type="text" name="direccion" id="direccion" value="{{ $user->direccion }} " placeholder="ingresa su direccion">
                <input type="password" name="nuevacontrasena" id="nuevacontrasena"  placeholder="Escribir nueva contraseña (Opcional)">
                <p>Valida Datos con tu contraseña actual</p>
                <div class="password-container">
                    <input type="contraseña" id="contrasena" name="contrasena" placeholder="Ingresa tu contraseña" />
                    <span class="toggle-password" onclick="togglePassword()">👁️</span>
                </div>
                <button type="submit" class="btn" id="modificarbtn" onclick="event.preventDefault(); actualizarDatos();">Modificar</button>
              
            
            </form>
       </div>
           
        
    
    </section>
 

@endsection
   
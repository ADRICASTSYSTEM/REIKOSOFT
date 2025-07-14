@extends('estructura.cabecera')

@section('titulo', 'registrousuario')
@section('registeruser-active', 'active')

@section('contenido')


<main class="main">
        <div class="slider-container">
            <img class="slider-image active" src="{{ route('recursos.show', ['img', 'portadaweb2.gif']) }}" alt="Imagen 1">
            <img class="slider-image" src="{{ route('recursos.show', ['img', 'portadaweb3.gif']) }}" alt="Imagen 2">
            <img class="slider-image" src="{{ route('recursos.show', ['img', 'portadaweb4.gif']) }}" alt="Imagen 3">
            <img class="slider-image" src="{{ route('recursos.show', ['img', 'portadaweb5.gif']) }}" alt="Imagen 4">
            <img class="slider-image" src="{{ route('recursos.show', ['img', 'portadaweb.gif']) }}" alt="Imagen 4">
            <div class="slider-overlay"></div>
        </div>
   
        <div class="contenido">
            <div class="imagen">
                <img src="{{ route('recursos.show', ['img', 'logotype.png']) }}" alt="">
            </div>
            <div class="titulo">
                <h1>Ingreso al Sistema</h1>
            </div>
            <div class="seccion">
                
                <h2><i class="fa fa-user" aria-hidden="true"></i></h2>
                <form action="{{ route('register') }}" method="post" id="formularioRegistro">
                @csrf
                    <input type="text" placeholder="Ingrese Nombres" class="@error('nombres') border-red-500 @enderror" name="nombres" value="" required>
                    @error('nombres')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>   
                    @enderror
                    <input type="text" placeholder="Ingrese Apellidos" class="@error('apellidos') border-red-500 @enderror" name="apellidos" value="" required>
                    @error('apellidos')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>   
                    @enderror                  
                    <input type="user" placeholder="Ingrese Direccion" class="@error('direccion') border-red-500 @enderror" name="direccion" value="" required>
                    @error('direccion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>   
                    @enderror 
                    
                    <input type="phone" placeholder="Ingrese Telefono" class="@error('telefono') border-red-500 @enderror" name="telefono" value="" required>
                    @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>   
                    @enderror 
                    <input type="email" placeholder="Ingrese Correo" name="email" class="@error('correo') border-red-500 @enderror" required>
                    @error('correo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                    @enderror
                    
                    <input type="text" placeholder="Ingrese Usuario" name="usuario" class="@error('name') border-red-500 @enderror" required>
                    @error('usuario')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    <input type="password" placeholder="Ingrese Contraseña" class="@error('password') border-red-500 @enderror" name="password" value="" required>
                    @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                    @enderror
                    <input type="password" placeholder="Confirme Contraseña" class="@error('password-confirmation') border-red-500 @enderror" name="password_confirmation" value="" required>
                    @error('password-confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span> 
                    @enderror
                    

                    <select name="tipousuario_id" id="typeuser_id">
                        @foreach($tipousuario as $typeuser)
                           
                                <option value="{{ $typeuser->id }}" selected>{{ $typeuser->descripcion }}</option>
                        
                           
                        @endforeach
                    </select>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <input type="submit" value="Registrar">
                </form>
               
            </div>
        </div>
        <script src="{{ route('recursos.show', ['js', 'formularioregistro.js']) }}"></script>
        <script> 
           
           var slideIndex = 0;
          
           funcionslider();
         
       </script>
</main>


@include('contenidos.pie')
@endsection
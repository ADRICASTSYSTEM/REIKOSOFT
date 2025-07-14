
@extends('estructura.cabecera')

@section('titulo', 'registrousuario')
@section('registeruser-active', 'active')

@section('contenido')
<main class="login-form">
    <div class="form-container">
        <div class="form-title">
            <h1>Ingreso al Sistema</h1>
        </div>
        <div class="form-section">
            <h2><img src="{{ route('recursos.show', ['img', 'logoreikosoft.png']) }}" alt="Logo" class="logotype"></h2>
            <form action="{{route('login')}}" method="post" novalidate>
                @csrf
                <input type="text" placeholder="Usuario" id="usuario" name="name" class="@error('name') border-red-500 @enderror" value="" required>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <input type="password" placeholder="Contraseña" id="password" name="password" class="@error('password') border-red-500 @enderror" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <div class="remember-me">
                    <input type="checkbox" name="remember" id="remembercheck">
                    <label for="remembercheck">Recordar</label>
                </div>
                @if (session('mensaje'))
                    <div class="alert alert-success" role="alert">
                        {{session('mensaje')}}
                    </div>
                @endif
                <input type="submit" value="Ingresar">
            </form>
        </div>
    </div>
</main>

@endsection

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> ADRICAST SYSTEM - @yield('titulo')</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="{{ route('recursos.show', ['fontawesome/js', 'all.js']) }}"></script>
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ route('recursos.show', ['img', 'min.png']) }}">
   
    <script src="{{ route('recursos.show', ['js', 'funciones.js']) }}"></script>
    <script src="{{ route('recursos.show', ['js/reiko/', 'funcionesreiko.js']) }}"></script>
    <script src="{{ route('recursos.show', ['js', 'script.js']) }}" defer></script>
    <link href="{{ asset('css/estilo_estructura.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilo_contenedores.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilo_pagina.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilo_reiko.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.css">

</head>
<body>
   <!--
    <header class="cabecera">
        <div class="jumbotron jumbotron-fluid custom-banner">
            <div class="container">
              
            </div>
        </div>
    </header>
-->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary" id="menu">
        
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link item-menu " href="{{route('paginas.inicio')}}" > <span class="fa fa-home span"></span> INICIO <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link item-menu" href="{{route('paginas.nosotros')}}"> <span class="fa fa-users span"></span>NOSOTROS</a>
            <a class="nav-item nav-link item-menu" href="{{route('paginas.contactanos')}}"><span class="fa fa-envelope span"></span>CONTACTANOS</a>
            <a class="nav-item nav-link item-menu" href="{{route('paginas.servicios')}}"><span class="fa fa-box span"></span>SERVICIOS</a>
           <!-- <a class="nav-item nav-link item-menu" href="{{ route('posts.index') }}"><span class="fa fa-shopping-bag span"></span>REIKOSOFT</a>
            -->
            </div>
        </div>
    </nav>
    <main id="cuerpo">
        @yield('contenido')
    </main> 
  
</body>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> ADRICAST SYSTEM - @yield('titulo')</title>
   <script src="{{ route('recursos.show', ['fontawesome/js', 'all.js']) }}"></script>
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ route('recursos.show', ['img', 'min.png']) }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
    <script src="{{ route('recursos.show', ['js', 'funciones.js']) }}"></script>
    <script src="{{ route('recursos.show', ['js/reiko/', 'funcionesreiko.js']) }}"></script>
    <script src="{{ route('recursos.show', ['js', 'script.js']) }}" defer></script>
    <link href="{{ asset('css/estilo_estructura.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilo_contenedores.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilo_pagina.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilo_principal.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilo_reiko.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    

</head>
<body>
<header class="cabecera">
    <div class="logo">
        <img  id="imagen-previewlogo" src="{{ route('recursos.show', ['img', 'min.png']) }}" alt="Logo">
    </div>
    <nav class="menu">
    <ul>
        <li class="{{ request()->is('paginas/inicio') ? 'active' : '' }}">
            <a href="{{ route('paginas.inicio') }}">INICIO</a>
        </li>
        <li class="{{ request()->is('paginas/nosotros') ? 'active' : '' }}">
            <a href="{{ route('paginas.nosotros') }}">NOSOTROS</a>
        </li>
        <li class="{{ isset($contactanos_active) ? 'active' : '' }}">
            <a href="{{ route('paginas.contactanos') }}">CONTACTANOS</a>
        </li>
        <li class="{{ request()->is('paginas/servicios') ? 'active' : '' }}">
            <a href="{{ route('paginas.servicios') }}">SERVICIOS</a>
        </li>
        <li class="{{ request()->is('paginas/tecnologia') ? 'active' : '' }}">
            <a href="{{ route('paginas.tecnologias') }}">TECNOLOGIAS</a>
        </li>

    </ul>
</nav>
<div class="menu-mobile-icon">
    <i class="fas fa-bars"></i> <!-- Icono de menú móvil -->
</div>
<nav class="menu-mobile">
    <ul>
        <li>
            <a href="{{ route('paginas.inicio') }}">INICIO</a>
        </li>
        <li>
            <a href="{{ route('paginas.nosotros') }}">NOSOTROS</a>
        </li>
        <li>
            <a href="{{ route('paginas.contactanos') }}">CONTACTANOS</a>
        </li>
        <li>
            <a href="{{ route('paginas.servicios') }}">SERVICIOS</a>
        </li>
        <li>
            <a href="{{ route('posts.index') }}">REIKOSOFT</a>
        </li>
    </ul>
</nav>

    <script>
        // obtén el icono de menú móvil
        var menuMobileIcon = document.querySelector('.menu-mobile-icon');

        // agrega un event listener al icono de menú móvil para alternar la visibilidad del menú móvil
        menuMobileIcon.addEventListener('click', toggleMenuMobile);
        window.onload = hideMenuOnLargeScreen;

            // ejecutar hideMenuOnLargeScreen() cuando se cambie el tamaño de la ventana
            window.addEventListener('resize', hideMenuOnLargeScreen);
    </script>
</header>
<main class="cuerpo">
        @yield('contenido')
</main> 
  
</body>

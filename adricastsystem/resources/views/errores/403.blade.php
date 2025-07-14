@extends('reikosoft.contenedor.contenedor')

@section('title', 'Acceso no autorizado')

@section('contenidoreiko')
    <div class="container mt-5">
        <h1>403 - Acceso no autorizado</h1>
        <p>No tienes permiso para acceder a esta página.</p>
        <a href="{{ route('posts.index') }}">Volver al inicio</a>
    </div>
@endsection

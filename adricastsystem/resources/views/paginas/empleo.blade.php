@extends('estructura.cabecera')

@section('titulo', 'Trabaja con nosotros')
@section('empleo-active', 'active')

@section('contenido')
    
    @include('contenidos.introempleo')
    @include('contenidos.formaempleo')
    @include('contenidos.pie')
@endsection
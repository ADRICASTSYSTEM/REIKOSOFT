@extends('estructura.cabecera')

@section('titulo', 'Nosotros')
@section('servicios-active', 'active')

@section('contenido') 
    @include('contenidos.introservicio')
    
    @include('contenidos.solucionestecnologicas')
   
    @include('contenidos.pie')
@endsection

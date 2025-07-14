@extends('estructura.cabecera')

@section('titulo', 'Inicio')
@section('inicio-active', 'active')

@section('contenido')
      @include('contenidos.slider')
      @include('contenidos.infoservicio')
      
        
      @include('contenidos.procesosdeservicio')  
      @include('contenidos.introtecnologias') 
       
   
  

    @include('contenidos.pie')
@endsection

@extends('estructura.cabecera')

@section('titulo', 'Contactanos')
@section('contactanos-active', 'active')

@section('contenido')
    @include('contenidos.contacto')
    @include('contenidos.pie')
@endsection
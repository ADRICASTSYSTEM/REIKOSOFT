@extends('estructura.cabecera')

@section('titulo', 'Nosotros')
@section('nosotros-active', 'active')

@section('contenido')
    @include('contenidos.introempresa')
    @include('contenidos.informaciondeempresa')
    @include('contenidos.pie')
@endsection

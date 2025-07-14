@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')
    <section class="containerreiko">
        
        <img class ="imgpresentacion" src="{{ route('recursos.show', ['img', 'logoreikosoft.png']) }}" alt="">
    </section>
   
@endsection
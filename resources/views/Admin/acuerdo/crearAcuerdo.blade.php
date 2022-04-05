@extends('layouts.plantilla')
@section('title', 'Acuerdos')
@section('content')

{{-- Fomulario para crear un nuevo acuerdo --}}
<h1>Crear Acuerdo</h1>
<div class="formularioContenedorNew">
    <form class="FnuevoAcuerdo" id="FnuevoAcuerdo" name="FnuevoAcuerdo" action="{{route('Acuerdo.store')}}"
        method="post">
        @csrf
        @livewire('acuerdo.crear-acuerdo')
        <label class="form-label" for="FechaCumplimiento">Fecha cumplimiento</label>
        <input class="form-input" type="date" name="FechaCumplimiento" id="FechaCumplimiento">
        {{-- Inicio Validaciones para el input de la fecha de cumplimiento --}}
        <p class="alert alert-danger" id="DiaCumplimiento1" style="display: none">¡¡¡Es un campo necesario!!</p>
        <p class="alert alert-danger" id="DiaCumplimiento2" style="display: none">¡¡¡La fecha debe ser mayor a la
            actual!!</p><br>
        {{-- Fin Validaciones para el input de la fecha de cumplimiento --}}
        <label class="form-label" for="Observaciones">Observaciones</label>
        <input class="form-input" type="text" name="Observaciones" id="">
        <input type="hidden" name="created_at" value="{{$now->format('Y-m-d').' '.$now->format('H:i')}}">
        <input type="hidden" name="updated_at" value="{{$now->format('Y-m-d').' '.$now->format('H:i')}}">
        <a class="btn btn-danger botones" href="{{route('Acuerdo.index')}}">Cancelar</a>
        <button onclick="ValidarNuevoAcuerdo()" class="btn btn-success botones" type="button" name="enviar"
            value="enviar">Registrar Acuerdo</button>
    </form>



</div>
@endsection
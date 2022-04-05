@extends('layouts.plantilla')
@section('title','Ver Acuerdo')
@section('content')
{{-- Formulario del reporte de acuerdo llenado de manera automatica donde no se puede modificar ningun campo
    esta vista se muestra automaticamente despues de haber creado un acuerdo --}}
<h1>Reporte del acuerdo {{$acuerdo->NumeroAcuerdo}}</h1>
<div class="contenedorDatosAcuerdo">
    <label class="datos-label" for="">Número de Acuerdo</label><br>
    <input class="datos-input" type="text" value="{{$acuerdo->NumeroAcuerdo}}" disabled><br>
    <label class="datos-label" for=""></label>Auditoría<br>
    <input class="datos-input" type="text" value="{{$acuerdo->Auditoria}}" disabled><br>
    <label class="datos-label" for=""></label>Responsable<br>
    <input class="datos-input" type="text" value="{{$acuerdo->Responsable}}" disabled><br>
    <label class="datos-label" for=""></label>Comite<br>
    <input class="datos-input" type="text" value="{{$acuerdo->Comite}}" disabled><br>
    <label class="datos-label" for="">Fecha de Creación</label><br>
    <input class="datos-input" type="text" value="{{$acuerdo->created_at}}" disabled><br>
    <label class="datos-label" for="">Fecha de Cumplimiento</label><br>
    <input class="datos-input" type="text" value="{{$acuerdo->FechaCumplimiento}}" disabled><br>
    <label class="datos-label" for="">Reunion</label><br>
    <input class="datos-input" type="text" value="{{$acuerdo->reunione->NombreReunion}}" disabled><br>
    <br>
    <label class="datos-label" for="">Dias transcurridos</label><br>
    <input class="datos-input" type="text" value="{{$diasTranscurridos}}" disabled><br>
    <br>
    <label class="datos-label" for="">Días faltantes para el cumplimiento del Acuerdo</label><br>
    <input class="datos-input" type="text" value="{{$diasFaltantes}}" disabled><br>
    <br>

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="container">

                </div>
            </div>
        </div>
    </div>
    {{-- Botón para crear un pdf con los datos del reporte de acuerdo --}}
    <a href="{{route('Acuerdo.pdf',$acuerdo)}}" class="btn btn-primary btn-sm">{{__('PDF')}} </a>
    <a href="{{route('Acuerdo.index')}}" class="btn btn-primary btn-sm">Volver página principal de acuerdos </a>
</div>
@endsection
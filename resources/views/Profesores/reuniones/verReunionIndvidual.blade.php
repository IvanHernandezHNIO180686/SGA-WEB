{{-- Importación de layout --}}
@extends('layouts.app')
{{-- Contenido --}}
@section('content')
<h1>Reuniones</h1>
{{-- Si existen datos se muestra en la tabla --}}
@if($resultados->count())
<table class="table">
    <thead>
        <tr>
            <th>Nombre Reunión</th>
            <th>Fecha de la Reunion</th>
            <th>Siglas de la Auditoria</th>
            <th>Nombre Comite</th>
            <th>Estatus</th>
            <th>Tipo de Sesión</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($resultados as $resultado)
        <tr>
            <td scope="row">{{$resultado->NombreReunion}}</td>
            <td>{{$resultado->FechaReunion}}</td>
            <td>{{$resultado->SiglasAuditoria}}</td>
            <td>{{$resultado->NombreComite}}</td>
            <td>{{$resultado->NombreEstatus}}</td>
            <td>{{$resultado->NombreSesion}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
{{-- Si no existen datos es neserario mostrar el mensaje de vacío --}}
<h4>Aun no hay reuniones para usted</h4>
@endif



@endsection

{{-- Importación de layout --}}
@extends('layouts.app')
{{-- Contenido --}}
@section('content')
<h1>Auditorías</h1>
{{-- Si existen datos se muestra en la tabla --}}
@if($comites->count())
<table class="table">
    <thead>
        <tr>
            <th>Siglas Auditoria</th>
            <th>Organizacion</th>
            <th>Fecha de la Auditoria</th>
            <th>Tipo de Auditoria</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($comites as $comite)
            @foreach ($auditorias as $auditoria)
                @if ($comite->auditoria_id == $auditoria->id)
                    <tr>
                        <td scope="row">{{$auditoria->SiglasAuditoria}}</td>
                        <td>{{$auditoria->Organismo}}</td>
                        <td>{{$auditoria->FechaAuditoria}}</td>
                        <td>{{$auditoria->tipoAuditoria->NombreTipo}}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
    </tbody>
</table>
@else
{{-- Si no existen datos es neserario mostrar el mensaje de vacío --}}
<h4>Aun no hay reuniones para usted</h4>
@endif
@endsection

@extends('layouts.plantilla')
@section('title','Acuerdo de Reunion')
@section('content')
<h1>Crear Acuerdo de Reunion</h1>

{{-- Formulario que permite crear un acuerdo desde el apartado de reuniones desde una reunión en específico
dentro de este formulario los campos de auditoría, Comité, Reunión y Número de acuerdo serán llenado
automaticamente y no podrán ser modificados por ello cuentan con la etiqueta "readonly" --}}

<div class="formularioContenedorNew">
    {{-- Formulario de Creación de acuerdo en una reunión --}}
    <form class="FnuevoAcuerdo" name="FnuevoAcuerdo" id="FnuevoAcuerdo" action="{{route('Reunion.addAcuerdo')}}"
        method="post">
        @csrf
        <input type="hidden" name="reunione_id" id="reunione_id" value="{{$reunion->id}}">
        <label class="form-label" for="NombreReunion">Reunión:</label>
        <input class="form-input" type="text" name="NombreReunion" id="" value="{{$reunion->NombreReunion}}" readonly>
        <label class="form-label" for="NumeroAcuerdo">Número de Acuerdo:</label>
        <input class="form-input" type="text" name="NumeroAcuerdo" id="NumeroAcuerdo" value="{{$numeroAcuerdo}}"
            readonly>
        <label class="form-label" for="Auditoria">Auditoría:</label>
        <input class="form-input" type="text" name="Auditoria" id="Auditoria"
            value="{{$comite->auditoria->SiglasAuditoria}}" readonly>
        <label class="form-label" for="Responsable">Responsable:</label>
        <select class="form-input" name="Responsable" id="Responsable">
            {{-- Lista desplegable que nos permite visualizar a los integrantes del comité que participara
            en la reunión para asi elejir un responsable --}}
            <option value="0">---Selecciona el Responsable del acuerdo---</option>
            @foreach ($usuarios as $user)
            <option value="{{$user->SiglasUsuario}}">{{$user->Nombres.' '.$user->ApellidoPaterno.'
                '.$user->ApellidoMaterno}}</option>
            @endforeach
        </select>
        {{-- Validación para el campo de Responsable (INICIO) --}}
        <p class="alert alert-danger" id="Representante" style="display: none">¡¡¡Es un campo necesario!!</p>
        {{-- Validación para el campo de Responsable (FIN) --}}

        <label class="form-label" for="Comite">Comité:</label>
        <input class="form-input" type="text" name="Comite" id="" value="{{$comite->NombreComite}}" readonly>

        <label class="form-label" for="FechaCumplimiento">Fecha de Cumplimiento</label>
        <input class="form-input" name="FechaCumplimiento" id="FechaCumplimiento" type="date">
        {{-- Validación para el campo de Fecha de Cumplimiento (INICIO) --}}
        <p class="alert alert-danger" id="DiaCumplimiento1" style="display: none">¡¡¡Es un campo necesario!!</p>
        <p class="alert alert-danger" id="DiaCumplimiento2" style="display: none">¡¡¡La fecha debe ser mayor a la
            actual!!</p><br>
        {{-- Validación para el campo de Fecha de Cumplimiento (FIN) --}}

        <label class="form-label" for="Observaciones">Observaciones</label>
        <textarea class="form-textarea" name="Observaciones" id="" cols="30" rows="10"></textarea>
        <input type="hidden" name="created_at" value="{{$now->format('Y-m-d').' '.$now->format('H:i')}}">
        <input type="hidden" name="updated_at" value="{{$now->format('Y-m-d').' '.$now->format('H:i')}}">
        <a class="btn btn-danger botones" href="{{route('Reunion.index')}}">Cancelar</a>
        <button onclick="ValidarNuevoAcuerdoReunion()" class="btn btn-success botones" type="button">Registrar
            Acuerdo</button>
    </form>

</div>
@endsection
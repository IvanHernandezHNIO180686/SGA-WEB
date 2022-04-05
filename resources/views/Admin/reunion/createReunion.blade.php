@extends('layouts.plantilla')
@section('title','Crear Reunion')
@section('content')
<h1>Crear Reunion</h1>
<div class="formularioContenedorNew">
    {{-- Formulario que ayuda a crear una reunión nueva --}}
    <form class="FnuevaReunion" id="FnuevaReunion" name="FnuevaReunion" action="{{route('Reunion.store')}}"
        method="post">
        @csrf
        <label class="form-label" for="NombreReunion">Nombre de la Reunión:</label>
        <input class="form-input" type="text" name="NombreReunion" id="NombreReunion"
            onchange="FnuevaReunion.NombreReunion.value=FnuevaReunion.NombreReunion.value.toUpperCase();">
        {{--Inicio Validación del campo NombreReunión --}}
        <p class="alert alert-danger" id="NombreJunta1" style="display: none">¡¡¡Es un campo necesario!!</p>
        <p class="alert alert-danger" id="NombreJunta2" style="display: none">¡¡¡El nombre de la reunión no acepta
            numeros!!</p>
        {{--Fin Validación del campo NombreReunión --}}
        <br>

        <label class="form-label" for="auditoria_id">AuditorÍa:</label>
        <select class="form-input" name="auditoria_id" id="idAuditoria">
            {{-- Lista desplegable que permite elegir a que auditoría pertenece esta reunión --}}
            <option value="0">---Auditoría por la que se reuniran---</option>
            @foreach ($Auditorias as $auditoria)
            <option value="{{$auditoria->id}}">{{$auditoria->SiglasAuditoria}}</option>
            @endforeach
        </select>
        {{--Inicio Validación del campo auditoria_id --}}
        <p class="alert alert-danger" id="IDauditoria" style="display: none">¡¡¡Es un campo necesario!!</p><br>
        {{--Fin Validación del campo auditoria_id --}}

        <label class="form-label" for="FechaReunion"> Fecha de la Reunión:</label>
        <input class="form-input" type="date" name="FechaReunion" id="FechaReunion">
        {{--Inicio Validación del campo FechaReunion --}}
        <p class="alert alert-danger" id="DiaReunion1" style="display: none">¡¡¡Es un campo necesario!!</p>
        <p class="alert alert-danger" id="DiaReunion2" style="display: none">¡¡¡La fecha debe ser mayor a la actual!!
        </p><br>
        {{--Fin Validación del campo FechaReunion --}}

        <label class="form-label" for="Observaciones">Observaciones:</label>
        <textarea class="form-input" name="Observaciones" id="Observaciones" cols="30" rows="10"></textarea>

        <label class="form-label" for="tipo_sesione_id">Tipo de Sesion</label>
        {{-- Lista desplegable que nos permite definir el tipo de sesión que será esta reunión Ordinaria o
        Extraorniraria --}}
        <select class="form-input" name="tipo_sesione_id" id="TipoSesion">
            <option value="0">---Selecciona el tipo de Sesion---</option>
            @foreach ($TipoSesiones as $tiposesion)
            <option value="{{$tiposesion->id}}">{{$tiposesion->NombreSesion}}</option>
            @endforeach
        </select>
        {{--Inicio Validación del campo tipo_sesione_id --}}
        <p class="alert alert-danger" id="Sesion" style="display: none">¡¡¡Es un campo necesario!!</p>
        {{--Fin Validación del campo tipo_sesione_id --}}
        <input type="hidden" name="estatu_id" value="1">
        <a class="btn btn-danger botones" href="{{route('Reunion.index')}}">Cancelar</a>
        <button class="btn btn-success botones" onclick="ValidarNuevaReunion()" type="button" name="enviar"
            value="enviar">Crear Reunión</button>
    </form>
</div>
@endsection

{{-- Sección de codigo java scrip donde se ven las notificaciones utilizando sweet alert --}}
@section('js')
    {{-- Mensaje de error que se muestra si el comité a cargo de la reunión no tiene integrantes --}}
    @if (session('errorSinIntegrantes')=='ok')
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Comite Asignado...',
                text: '¡El comite asignado a esta auditoria no cuenta con integrantes!',
            })
        </script>
    @endif

    {{-- Mensaje de error que se muestra si el nombre ya existe --}}
    @if (session('errorDupNombre')=='ok')
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Nombre Ocupado...',
                text: '¡Ya existe una reunión con este nombre!',
            })
        </script>
    @endif
@endsection

@extends('layouts.plantilla')
@section('title','Crear Comite')
@section('content')
<h1>Registrar nuevo comite</h1>
{{-- Formulario para crear un nuevo comité --}}
<div class="formularioContenedorNew">
    <form class="FnuevoComite" id="FnuevoComite" name="FnuevoComite" action="{{route('Comite.store')}}" method="post">
        @csrf
        <label class="form-label" for="SiglasComite"> Siglas del Comité:</label>
        <input class="form-input" type="text" name="SiglasComite" id="SiglasComite"
            onchange="FnuevoComite.SiglasComite.value=FnuevoComite.SiglasComite.value.toUpperCase();"><br>
        {{-- Inicio de los mensajes de validación para el campo de siglas del comité --}}
        <p class="alert alert-danger" id="SiglasCom1" style="display: none" ;>¡¡¡Es un campo necesario!!</p>
        <p class="alert alert-danger" id="SiglasCom2" style="display: none" ;>¡¡¡Las siglas solo pueden tener menos de 5
            letras!!</p>
        {{-- Fin de los mensajes de validación para el campo de siglas del comité --}}

        <label class="form-label" for="NombreComite">Nombre del Comité:</label>
        <input class="form-input" type="text" name="NombreComite" id="NombreComite"
            onchange="FnuevoComite.NombreComite.value=FnuevoComite.NombreComite.value.toUpperCase();"><br>
        {{-- Inicio de los mensajes de validación para el campo de nombre del comité --}}
        <p class="alert alert-danger" id="NombreCom1" style="display: none" ;>¡¡¡Es un campo necesario!!</p>
        <p class="alert alert-danger" id="NombreCom2" style="display: none" ;>¡¡¡El nombre del Comite debe de tener mas
            de 5 caracteres!!</p>
        {{-- Fin de los mensajes de validación para el campo de nombre del comité --}}

        <input class="form-input" type="hidden" name="SesionesOrdinarias" value="0">
        <input class="form-input" type="hidden" name="SesionesExtraordinarias" value="0">
        <label class="form-label" for="auditoria_id">Asignar una Auditoria:</label>
        <select class="form-input" name="auditoria_id" id="idAuditoria">
            {{-- Lista desplegable que muestra las auditorías que pueden ser asignadas al comité --}}
            <option value="0">--Elija una Auditoria--</option>
            @foreach ($auditorias as $auditoria)
            <option value="{{$auditoria->id}}">{{$auditoria->SiglasAuditoria}}</option>
            @endforeach
        </select>
        {{-- Inicio de los mensajes de validación para el campo de Auditoría asignada --}}
        <p class="alert alert-danger" id="idAud" style="display: none" ;>¡¡¡Es necesario escoger una auditoria!!</p>
        {{-- Fin de los mensajes de validación para el campo de Auditoría asignada --}}

        <input type="hidden" name="created_at" value="{{$now->format('Y-m-d').' '.$now->format('H:i')}}">
        <input type="hidden" name="updated_at" value="{{$now->format('Y-m-d').' '.$now->format('H:i')}}">
        <a class="btn btn-danger botones"" href=" {{route('Comite.index')}}">Cancelar</a>
        <button onclick="ValidarNuevoComite()" class="btn btn-success botones" type="button" name="enviar"
            value="enviar">Registrar Comite</button>

    </form>

</div>
@endsection

{{-- Sección de codigo java scrip donde se ven las notificaciones utilizando sweet alert --}}
@section('js')

{{-- Mensaje de error que se muestra si la auditoría ya esta asignada --}}
@if (session('errorAudAsignada')=='ok')
<script>
    Swal.fire({
        icon: 'error',
        title: 'Auditoría Ocupada....',
        text: '¡Ya existe un comite asignado a esta auditoría!',
    })
</script>
@endif

{{-- Mensaje de error que se muestra si las siglas ya existen --}}
@if (session('errorSiglasDup')=='ok')
<script>
    Swal.fire({
        icon: 'error',
        title: 'Siglas Ocupadas....',
        text: '¡Ya existe un comite registrado con esas siglas!',
    })
</script>
@endif

{{-- Mensaje de error que se muestra si el nombre ya existe --}}
@if (session('errorNombreDup')=='ok')
<script>
    Swal.fire({
        icon: 'error',
        title: 'Nombre Ocupado....',
        text: '¡Ya existe un comite registrado con ese nombre!',
    })
</script>
@endif
@endsection
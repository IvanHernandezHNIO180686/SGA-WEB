@extends('layouts.plantilla')
@section('title','Crear Auditorias')
@section('content')
{{-- Formulario para crear una nueva auditoría --}}
<h1>Bienvenido a la creacioó de auditorías</h1>
<div class="formularioContenedorNew">
    <form class="FnuevaAuditoria" id="FnuevaAuditoria" name="FnuevaAuditoria" action="{{route('Auditoria.store')}}"
        method="POST">
        @csrf

        <label class="form-label" for="SiglasAuditoria">Siglas de la Auditoría:</label>
        <input class="form-input" type="text" name="SiglasAuditoria" id="SiglasAuditoria"
            onchange="FnuevaAuditoria.SiglasAuditoria.value=FnuevaAuditoria.SiglasAuditoria.value.toUpperCase();">
        {{-- Inicio de los mensajes de validación para el campo de siglas de la auditoría --}}
        <p class="alert alert-danger" id="SiglasAud1" style="display: none" ;>¡¡¡El maximo de siglas es de 5!!</p>
        <p class="alert alert-danger" id="SiglasAud2" style="display: none" ;>¡¡¡Es un campo necesario!!</p>
        {{-- Fin de los mensajes de validación para el campo de siglas de la auditoría --}}

        <label class="form-label" for="Organismo">Organismo que realizara la auditoría:</label>
        <input class="form-input" type="text" name="Organismo" id="Organismo"
            onchange="FnuevaAuditoria.Organismo.value=FnuevaAuditoria.Organismo.value.toUpperCase();">
        {{-- Inicio de los mensajes de validación para el organismo --}}
        <p class="alert alert-danger" id="Organizacion" style="display: none" ;>¡¡¡Es un campo necesario!!</p>
        {{-- Fin de los mensajes de validación para el organismo --}}

        <label class="form-label" for="FechaAuditoria">Fecha de la auditorií:</label>
        <input class="form-input" type="date" name="FechaAuditoria" id="FechaAuditoria">
        {{-- Inicio de los mensajes de validación para la fecha de la auditoría --}}
        <p class="alert alert-danger" id="fechaAud1" style="display: none" ;>¡¡¡Es un campo necesario!!</p>
        <p class="alert alert-danger" id="fechaAud2" style="display: none" ;>¡¡¡La fecha debe de ser mayor a la del dia
            de hoy!!</p>
        {{-- Fin de los mensajes de validación para la fecha de la auditoría --}}

        <label class="form-label" for="Comentarios">Comentarios:</label>
        <textarea class="form-textarea" name="Comentarios" id="Comentarios" rows="5"></textarea>

        <label class="form-label" for="TipoAuditoria">Tipo de Auditoria:</label>
        {{-- Lista desplegable para visualizar las auditorías registradas en el sistema --}}
        <select class="form-input" name="Tipo_Auditoria_id" id="Tipo_Auditoria_id">
            <option value="0">-- Escoja el tipo de Auditoria --</option>
            @foreach ($tipoAuditoria as $tipo)
            <option value="{{$tipo->id}}">{{$tipo->NombreTipo}}</option>
            @endforeach
        </select>
        {{-- Inicio de los mensajes de validación para la auditoría --}}
        <p class="alert alert-danger" id="tipoAud" style="display: none" ;>¡¡¡Seleccione el tipo de auditoria!!</p>
        {{-- Fin de los mensajes de validación para la auditoría --}}
        <a class="btn btn-danger botones" type="button" href="{{route('Auditoria.index')}}">Cancelar</a>
        <button onclick="ValidarNuevaAuditoria()" class="btn btn-success botones" type="button" name="enviar"
            value="enviar">Registrar Auditoria</button>
    </form>
</div>

@endsection

{{-- Sección de codigo java scrip donde se ven las notificaciones utilizando sweet alert --}}
@section('js')
{{-- Mensaje de error que se muestra si las siglas de la auditoría ya esta asignada --}}
@if (session('error')=='ok')
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '¡Ya existe una auditoría con esas siglas!',
    })
</script>
@endif
@endsection
@extends('layouts.plantilla')
@section('title','Editar Auditorias')
@section('content')
<h1>Bienvenido a la edición de auditorías</h1>
{{-- Formulario para editar una auditoría --}}
<div class="formularioContenedorEdit">
    <form class="Formu-editAuditoria" id="Formu-editAuditoria" name="Formu-editAuditoria"
        action="{{route('Auditoria.update',$auditoria)}}" method="POST">
        @csrf
        @method('put')
        <label class="form-label" for="SiglasAuditoria">Siglas de la Auditoría</label>
        <input class="form-input" type="text" name="SiglasAuditoria" id="SiglasAuditoria"
            value="{{$auditoria->SiglasAuditoria}}">
        {{-- Validación para el campo de Siglas --}}
        @error('SiglasAuditoria')
        <div class="alert alert-danger "><small>{{$message}}</small></div>
        @enderror

        <label class="form-label" for="Organismo">Organismo que realizara la auditoría</label>
        <input class="form-input" type="text" name="Organismo" id="Organismo" value="{{$auditoria->Organismo}}">
        {{-- Validación para el campo del Organismo --}}
        @error('Organismo')
        <div class="alert alert-danger "><small>{{$message}}</small></div>
        @enderror

        <label class="form-label" for="FechaAuditoria">Fecha de la auditoría</label>
        <input class="form-input" type="date" name="FechaAuditoria" id="FechaAuditoria"
            value="{{$auditoria->FechaAuditoria}}">
        {{-- Validación para el campo de la fecha de la auditoría --}}
        @error('FechaAuditoria')
        <div class="alert alert-danger "><small>{{$message}}</small></div>
        @enderror

        <label class="form-label" for="Comentarios">Comentarios</label>
        <textarea class="form-textarea" name="Comentarios" id="Comentarios"
            rows="5">{{$auditoria->Comentarios}}</textarea>
        <label class="form-label" for="TipoAuditoria">Tipo de Auditoria</label>
        <select class="form-input" name="Tipo_Auditoria_id" id="TipoAuditoria">
            {{-- Lista desplegable que nos permitirá cambiar el tipo de la auditoría --}}
            @foreach ($tipoAuditoria as $tipo)
                @if ($tipo->id == $auditoria->tipo_auditoria_id)
                    <option value="{{$tipo->id}}" selected>{{$tipo->NombreTipo}}</option>
                @else
                    <option value="{{$tipo->id}}">{{$tipo->NombreTipo}}</option>
                @endif
            @endforeach
        </select>
        <a class="btn btn-danger botones" href="{{route('Auditoria.index')}}">Cancelar</a>
        <input class="btn btn-success botones" type="submit" value="Enviar">
    </form>

</div>
@endsection

{{-- Sección de codigo java scrip donde se ven las notificaciones utilizando sweet alert --}}
@section('js')
{{-- Cuadro de dialogo para confirmar la edición de la auditoría --}}
<script>
    $('.Formu-editAuditoria').submit(function(e){
        e.preventDefault();
        Swal.fire({
            title: '¿Seguro que desea guardar los cambios?',
            text: "¡Una vez guardados los cambios no habra vuelta atras!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, deseo guardar los cambios!',
            cancelButtonText: '¡Cancelar!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    });
</script>

@endsection
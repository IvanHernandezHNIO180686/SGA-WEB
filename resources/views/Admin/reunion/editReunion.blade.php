@extends('layouts.plantilla')
@section('title','Crear Reunion')
@section('content')
    <h1>Editar Reunión</h1>
    <div class="formularioContenedorEdit">
        {{-- Formilario para editar una reunión --}}
    <form class="Formu-editarReunion" action="{{route('Reunion.update',$reunion)}}" method="post">
        @csrf
        @method('put')
        <label class="formu-label" for="NombreReunion">Nombre de la Reunión:</label>
        <input class="formu-input" type="text" name="NombreReunion" value="{{$reunion->NombreReunion}}">
        {{-- Validación del campo NombreReunion --}}
        @error('NombreReunion')
            <div  class="alert alert-danger "><small>{{$message}}</small></div>
        @enderror

        <label class="formu-label" for="auditoria_id">Auditoría:</label>
        {{-- Lista desplegable que permite modificar a que auditoría pertenece esta reunión --}}
        <select class="formu-input" name="auditoria_id" id="">
            @foreach ($Auditorias as $auditoria)
                @if ($auditoria->id == $reunion->auditoria_id)
                    <option value="{{$auditoria->id}}" selected>{{$auditoria->SiglasAuditoria}}</option>
                @else
                    <option value="{{$auditoria->id}}">{{$auditoria->SiglasAuditoria}}</option>
                @endif
            @endforeach
        </select>
        <label class="formu-label" for="FechaReunion"> Fecha de la Reunión:</label>
        <input class="formu-input" type="date" name="FechaReunion" value="{{$reunion->FechaReunion}}">
        {{-- Validación del campo FechaReunion --}}
        @error('FechaReunion')
            <div  class="alert alert-danger "><small>{{$message}}</small></div>
        @enderror

        <label class="formu-label" for=Observaciones"">Observaciones:</label>
        <textarea class="formu-input" name="Observaciones" id="" cols="30" rows="10">{{$reunion->Observaciones}}</textarea>
        
        <label class="formu-label" for="tipo_sesione_id">Tipo de Sesión</label>
        {{-- Lista desplegable que nos permite modificar el tipo de sesión que será esta reunión Ordinaria o
        Extraorniraria --}}
        <select class="formu-input" name="tipo_sesione_id" id="">
            @foreach ($TipoSesiones as $tiposesion)
                @if ($tiposesion->id == $reunion->tipo_sesione_id)
                    <option value="{{$tiposesion->id}}" selected>{{$tiposesion->NombreSesion}}</option>
                @else
                    <option value="{{$tiposesion->id}}">{{$tiposesion->NombreSesion}}</option>
                @endif
            @endforeach
        </select>
        <a class="btn btn-danger botones" href="{{route('Reunion.index')}}">Cancelar</a>
        <input class="btn btn-success botones" type="submit" value="Guardar Cambios">
    </form>
</div>
@endsection

{{-- Sección de codigo java scrip donde se ven las notificaciones utilizando sweet alert --}}
@section('js')
{{-- Cuadro de díalogo para confirmar la edición de la auditoría --}}
<script>
    $('.Formu-editarReunion').submit(function(e){
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

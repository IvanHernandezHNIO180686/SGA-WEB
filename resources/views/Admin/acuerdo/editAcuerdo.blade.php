@extends('layouts.plantilla')
@section('title', 'Acuerdos')
@section('content')
{{-- Formulario para editar un acuerdo donde los campos de número de acuerdo y el nombre de la reunión no pueden
    ser modificados --}}
<h1>Editar Acuerdo</h1>
<div class="formularioContenedorEdit">
    <form class="Formu-editarAcuerdo" action="{{route('Acuerdo.update',$acuerdo)}}" method="post">
        @csrf
        @method('put')
        <label class="form-label" for="NumeroAcuerdo">Numero de acuerdo:</label>
        <input class="form-input" type="text" name="NumeroAcuerdo" id="" value="{{$acuerdo->NumeroAcuerdo}}" readonly>
        <label class="form-label" for="reunione_id">Nombre Reunion:</label>
        <input class="form-input" type="text" name="" id="" value="{{$acuerdo->Reunione->NombreReunion}}" readonly>
        <input type="hidden" name="reunione_id" id="" value="{{$acuerdo->reunione_id}}">
        <label class="form-label" for="Responsable">Reponsable:</label>
        <select class="form-select" name="Responsable" id="">
            {{-- Visualización de los usuarios dentro comité a cargo de la reunión a la que pertenece el acuerdo
                para asi asignar un responsable del acuerdo --}}
            @foreach ($users as $user)
                @if ($user->SiglasUsuario == $acuerdo->Responsable)
                    <option value="{{$user->SiglasUsuario}}" selected>{{$user->Nombres.' '.$user->ApellidoPaterno.'
                    '.$user->ApellidoMaterno}}</option>
                @else
                    <option value="{{$user->SiglasUsuario}}">{{$user->Nombres.' '.$user->ApellidoPaterno.'
                    '.$user->ApellidoMaterno}}</option>
                @endif
            @endforeach
        </select>
        <label class="form-label" for="FechaCumplimiento">Fecha cumplimiento:</label>
        <input class="form-date" type="date" name="FechaCumplimiento" id="" value="{{$acuerdo->FechaCumplimiento}}">
        {{-- Validación para el input de Fecha de cumplimiento --}}
        @error('FechaCumplimiento')
            <div class="alert alert-danger "><small>{{$message}}</small></div>
        @enderror
        <label class="form-label" for="Observaciones">Observaciones:</label>
        <textarea class="form-input" type="text" name="Observaciones" id="" value="{{$acuerdo->Observaciones}}"
            cols="30" rows="10"></textarea>
        <input type="hidden" name="updated_at" value="{{$now->format('Y-m-d').' '.$now->format('H:i')}}">
        <a class="btn btn-danger botones" href="{{route('Acuerdo.index')}}">Cancelar</a>
        <input class="btn btn-success botones" type="submit" value="Guardar Cambios">
    </form>

</div>
@endsection
@section('js')
{{-- Notificación de cambios guardados --}}
@if (session('editar') == 'ok')
    <script>
        Swal.fire(
            '¡Cambios guardados!',
            'El acuerdo fue editado de manera exitosa.',
            'success'
        )
    </script>
@endif

{{-- Cuadro de dialogo para confirmar la edición de acuerdo --}}
<script>
    $('.Formu-editarAcuerdo').submit(function(e){
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
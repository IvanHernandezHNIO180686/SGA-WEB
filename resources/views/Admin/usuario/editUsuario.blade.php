{{-- Importación del loyout --}}
@extends('layouts.plantilla')
{{-- Titulo de la página --}}
@section('title','Editar Usuarios')
@section('content')
    <h1>Editar los datos de {{ $user->Nombres.' '.$user->ApellidoPaterno }}</h1>
    <div class="formularioContenedorEdit">
        {{-- Formulario para editar Usuario --}}
    <form class="Formu-editarUsuario" action="{{route('User.update',$user)}}" method="post">
        @csrf
        @method('put')
        <label class="form-label" for="Nombres">Nombre(s) del Profesor:</label>
        <input class="form-input" type="text" name="Nombres" value="{{$user->Nombres}}">
        {{-- Error --}}
        @error('Nombres')
            <div  class="alert alert-danger "><small>{{$message}}</small></div>
        @enderror

        <label class="form-label" for="ApellidoPaterno">Apellido Paterno del Profesor:</label>
        <input class="form-input" type="text" name="ApellidoPaterno" value="{{$user->ApellidoPaterno}}">
        {{-- Error --}}
        @error('ApellidoPaterno')
            <div  class="alert alert-danger "><small>{{$message}}</small></div>
        @enderror

        <label class="form-label" for="ApellidoMaterno">Apellido Materno del Profesor:</label>
        <input class="form-input" type="text" name="ApellidoMaterno" value="{{$user->ApellidoMaterno}}" onkeypress="return soloLetras(event)" >
        
        <label class="form-label" for="Puesto">Puesto del profesor:</label>
        <input class="form-input" type="text" name="Puesto" value="{{$user->Puesto}}">
        {{-- Error --}}
        @error('Puesto')
            <div  class="alert alert-danger "><small>{{$message}}</small></div>
        @enderror

        <label class="form-label" for="email">Correo Institucional:</label>
        <input class="form-input" type="email" name="email" value="{{$user->email}}">
        {{-- Error --}}
        @error('email')
            <div  class="alert alert-danger "><small>{{$message}}</small></div>
        @enderror
        <input type="hidden" name="created_at" value="{{$user->created_at}}">

        <a class="btn btn-danger botones" href="{{route('User.index')}}"> Cancelar </a>
        {{-- Botón para guardar cambios --}}
        <input class="btn btn-success botones" type="submit" value="Guardar Cambios">
    </form>

</div>
@endsection

{{-- Sección java script --}}
@section('js')
{{-- Dialogo de confirmación para editar --}}
<script>
    $('.Formu-editarUsuario').submit(function(e){
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

{{-- Imporatación del layout --}}
@extends('layouts.app')
{{-- Titulo de la página --}}
@section('title','Editar Perfil Profesor')
{{-- Contenido --}}
@section('content')
    <h1>Editar mi perfil</h1>
    {{-- Formulario para editar perfil --}}
    <form action="{{route('Profesores.updatePerfil',$user)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        {{-- Foto de perfil --}}
        <div class="FotoPerfilAmarillo">
                @if ($user->Foto == '')
                <img class="forma-perfilAmarillo" src="{{ asset('storage/images/usuario.png') }}" alt="" width="200">
            @else
                <img class="forma-perfilAmarillo" src="{{ asset('storage').'/'.$user->Foto }}" alt="" width="200">
            @endif
        </div>

        <div class="datosPerfilAmarillo">
        <label class="datos-label" for="Foto">Foto de Perfil: </label>
        <input class="datos-input" type="file" id="Foto" name="Foto">

        <label class="datos-label" for="Nombres">Nombre(s): </label>
        <input class="datos-input" type="text" name="Nombres" value="{{$user->Nombres}}">
        {{-- Error --}}
        @error('Nombres')
            <div  class="alert alert-danger "><small>{{$message}}</small></div>
        @enderror

        <label class="datos-label" for="ApellidoPaterno">Apellido Paterno: </label>
        <input class="datos-input" type="text" name="ApellidoPaterno" value="{{$user->ApellidoPaterno}}">
        {{-- Error --}}
        @error('ApellidoPaterno')
            <div  class="alert alert-danger "><small>{{$message}}</small></div>
        @enderror

        <label class="datos-label" for="ApellidoMaterno">Apellido Materno: </label>
        <input class="datos-input" type="text" name="ApellidoMaterno" value="{{$user->ApellidoMaterno}}" onkeypress="return soloLetras(event)" >
        <label class="datos-label" for="Puesto">Puesto: </label>
        <input class="datos-input" type="text" name="Puesto" value="{{$user->Puesto}}">
        {{-- Error --}}
        @error('Puesto')
            <div  class="alert alert-danger "><small>{{$message}}</small></div>
        @enderror

        <label class="datos-label" for="email">Correo Institucional: </label>
        <input class="datos-input" type="email" name="email" value="{{$user->email}}">
        {{-- Error --}}
        @error('email')
            <div  class="alert alert-danger "><small>{{$message}}</small></div>
        @enderror
        
        <input type="hidden" name="created_at" value="{{$user->created_at}}">
        <div class="d-grid gap-2">
            <br>
            <input class="btn btn-success" type="submit" value="Guardar Cambios">
            <a class="btn btn-danger" href="{{route('Profesores.MiPerfil')}}"> Cancelar </a>
        </div>
    </form>

</div>
@endsection

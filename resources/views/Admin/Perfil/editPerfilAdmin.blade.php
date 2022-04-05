@extends('layouts.plantilla')
@section('title','Editar Perfil')
@section('content')
{{-- Formulario para editar el perfil del administrador --}}
<h1>Editar mi perfil</h1>
<form action="{{route('Admin.updatePerfil',$user)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    {{-- Apartado para la foto de perfil --}}
    <div class="FotoPerfilMorado">
        @if ($user->Foto == '')
        {{-- Si el usuario no cuenta con una foto de perfil se mostrará una por defecto --}}
        <img class="forma-perfilMorado" src="{{ public_path('storage/images/usuario.png') }}" alt="" width="200">
        @else
        {{-- Si el usuario cuenta con una foto de perfil se mostrará --}}
        <img class="forma-perfilMorado" src="{{ asset('storage').'/'.$user->Foto }}" alt="" width="200">
        @endif
    </div>
    {{-- Datos del usuario --}}
    <div class="datosPerfilMorado">
        <label class="datos-label" for="Foto">Foto de perfil: </label>
        <input class="datos-input" type="file" id="Foto" name="Foto">
        <label class="datos-label" for="Nombres">Nombre(s): </label>
        <input class="datos-input" type="text" name="Nombres" value="{{$user->Nombres}}">
        {{-- Validación para el campo de Nombres --}}
        @error('Nombres')
        <div class="alert alert-danger "><small>{{$message}}</small></div>
        @enderror

        <label class="datos-label" for="ApellidoPaterno">Apellido Paterno: </label>
        <input class="datos-input" type="text" name="ApellidoPaterno" value="{{$user->ApellidoPaterno}}">
        {{-- Validación para el campo de Apellido paterno --}}
        @error('ApellidoPaterno')
        <div class="alert alert-danger "><small>{{$message}}</small></div>
        @enderror

        {{-- El apellido materno puede ser nulo por ello no cuenta con validación --}}
        <label class="datos-label" for="ApellidoMaterno">Apellido Materno: </label>
        <input class="datos-input" type="text" name="ApellidoMaterno" value="{{$user->ApellidoMaterno}}"
            onkeypress="return soloLetras(event)">

        <label class="datos-label" for="Puesto">Puesto: </label>
        <input class="datos-input" type="text" name="Puesto" value="{{$user->Puesto}}">
        {{-- Validación para el campo de Puesto --}}
        @error('Puesto')
        <div class="alert alert-danger "><small>{{$message}}</small></div>
        @enderror

        <label class="datos-label" for="email">Correo Institucional: </label>
        <input class="datos-input" type="email" name="email" value="{{$user->email}}">
        {{-- Validación para el campo de Correo Institucional --}}
        @error('email')
        <div class="alert alert-danger "><small>{{$message}}</small></div>
        @enderror

        <input type="hidden" name="created_at" value="{{$user->created_at}}">
        <div class="d-grid gap-2">
            <br>
            <input class="btn btn-success" type="submit" value="Guardar Cambios">
            <a class="btn btn-danger" href="{{route('Admin.MiPerfil')}}"> Cancelar </a>
        </div>
</form>
</div>
@endsection
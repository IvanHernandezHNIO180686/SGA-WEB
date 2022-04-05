@extends('layouts.plantilla')
@section('title','Mi perfil - SGAWEB')
@section('content')
<h1> Mi perfil </h1>
{{-- Visualización de los datos del administrador --}}
{{-- Apartado de la foto de perfil --}}
<div class="FotoPerfilAmarillo">
    <img class="forma-perfilAmarillo" src="{{ asset('storage').'/'.$usuario->Foto }}" alt="" width="200">
</div>
{{-- Apartado de los datos del administrador que no pueden ser modificados en esta pestaña --}}
<div class="datosPerfilAmarillo">
    <label class="datos-label">Siglas:</label>
    <input class="datos-input" type="text" value="{{$usuario->SiglasUsuario}}" readonly>
    <label class="datos-label">Nombres:</label>
    <input class="datos-input" value="{{$usuario->Nombres}}" readonly>
    <label class="datos-label">Apellido Paterno:</label>
    <input class="datos-input" value="{{$usuario->ApellidoPaterno}}" readonly>
    <label class="datos-label">Apellido Materno:</label>
    <input class="datos-input" value="{{$usuario->ApellidoMaterno}}" readonly>
    <label class="datos-label">Puesto:</label>
    <input class="datos-input" value="{{$usuario->Puesto}}" readonly>
    <label class="datos-label">Correo Institucional:</label>
    <input class="datos-input" value="{{$usuario->email}}" readonly><br><br>

    <div class="d-grid gap-2">
        <a class="btn btn-primary" href="{{route('Admin.editPerfil',$usuario)}}">Modificar</a>
        <a href="{{ route('home') }}" class="btn btn-danger">Volver a la Página de Inicio</a>
    </div>

</div>
@endsection
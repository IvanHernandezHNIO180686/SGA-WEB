@extends('layouts.app')
@section('title','HomeAdmin')
@section('content')
    <h1> Mi perfil </h1>
    {{-- Visualización de los datos del profesor --}}
{{-- Apartado de la foto de perfil --}}
    <div class="FotoPerfilMorado">
        @if ($usuario->Foto == '')
            <img class="forma-perfilMorado" src="{{ asset('storage/images/usuario.png') }}" alt="" width="200">
        @else
            <img class="forma-perfilMorado" src="{{ asset('storage').'/'.$usuario->Foto }}" alt="" width="200">
        @endif
    </div>
    {{-- Apartado de los datos del profesor que no pueden ser modificados en esta pestaña --}}
    <div class="datosPerfilMorado">
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
        <input class="datos-input" value="{{$usuario->email}}" readonly>
        <br><br>
        <div class="d-grid gap-2">
            <a class="btn btn-warning" href="{{route('Profesores.editPerfil',$usuario)}}">Modificar</a>
            <a href="{{ route('home') }}" class="btn btn-danger">Volver a la Página de Inicio</a>
        </div>
    </div>
@endsection

{{-- Área de Scripts --}}
@section('js')
{{-- Notificación de cambio exitoso --}}
@if (session('cambio') == 'ok')
    <script>
        Swal.fire(
            '¡Cambio Realizado!',
            'Su perfil fue cambiado de manera exitosa.',
            'success'
        )
    </script>
@endif
@endsection

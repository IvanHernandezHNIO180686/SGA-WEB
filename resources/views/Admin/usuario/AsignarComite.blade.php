{{-- Importación del loyout --}}
@extends('layouts.plantilla')
{{-- Titulo de la página --}}
@section('title','Asignar Comite')
@section('content')
    <h1>ASIGNAR USUARIO A UN COMITÉ</h1>
    {{-- Formulario para asignar el usuario al comité --}}
    <div class="formularioContenedorAsignar">
        <form class="Formu-asignarUser" action="{{route('User.insertarAcomite')}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$user->id}}">
            <label class="form-label">Siglas del Usuario:</label>
            <input class="form-input" type="text" value="{{$user->SiglasUsuario}}" disabled>
            <label class="form-label">Nombre del usuario:</label>
            <input class="form-input" type="text" value="{{$user->Nombres.' '.$user->ApellidoPaterno.' '.$user->ApellidoMaterno}}" disabled>
            <label class="form-label">Correo Institucional:</label>
            <input class="form-input" type="text" value="{{$user->email}}" disabled>
            <label class="form-label">Comité al que se desea asignar:</label>
            {{-- Selección del comité --}}
            <select class="form-select" name="comite_id" id="">
                <option value="">--Seleccione el comité--</option>
                @foreach ($comites as $comite)
                    <option value="{{$comite->id}}">{{$comite->SiglasComite}}</option>
                @endforeach
            </select>
            {{-- Botón para asignar --}}
            <a class="botones btn btn-danger" href="{{route('User.index')}}">Cancelar</a>
            <input class="botones btn btn-success" type="submit" value="Agregar usuario al Comité">
        </form>
    </div>
@endsection

{{-- Sección de java script --}}
@section('js')
{{-- Notificacion de error --}}
    @if (session('error')=='ok')
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Integrante Registrado...',
                text: '¡Ya se encuentra registrado en el comite!',
            })
        </script>
    @endif
@endsection

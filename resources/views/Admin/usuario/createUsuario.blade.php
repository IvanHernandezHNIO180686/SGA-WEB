{{-- Importación del loyout --}}
@extends('layouts.plantilla')
{{-- Titulo de la página --}}
@section('title','Crear Usuarios')
@section('content')
    <h1>Creacion de usuarios</h1>
    {{-- Formulario para registrar usuario --}}
    <div class="formularioContenedorNew">
        <form class="FnuevoUsuario" id="FnuevoUsuario" name="FnuevoUsuario" action="{{route('User.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <label class="form-label" for="Nombres">Nombre(s) del Profesor</label>
            <input class="form-input" type="text" name="Nombres" id="Nombres" onchange="FnuevoUsuario.Nombres.value=FnuevoUsuario.Nombres.value.toUpperCase();">
            {{-- Errores Nombres --}}
            <p class="alert alert-danger" id="NombresUser1" style="display: none";>¡¡¡Es un campo necesario!!</p>
            <p class="alert alert-danger" id="NombresUser2" style="display: none";>¡¡¡Este campo no puede contener numeros!!</p>
            
            <label class="form-label" for="ApellidoPaterno">Apellido Paterno del Profesor</label>
            <input class="form-input" type="text" name="ApellidoPaterno" id="ApellidoPaterno" onchange="FnuevoUsuario.ApellidoPaterno.value=FnuevoUsuario.ApellidoPaterno.value.toUpperCase();">
            {{-- Errores Apellido Paterno --}}
            <p class="alert alert-danger" id="ApellidoP1" style="display: none">¡¡¡Es un campo necesario!!</p>
            <p class="alert alert-danger" id="ApellidoP2" style="display: none";>¡¡¡Este campo no puede contener numeros!!</p>
            
            <label class="form-label" for="ApellidoMaterno">Apellido Materno del Profesor</label>
            <input class="form-input" type="text" name="ApellidoMaterno" id="ApellidoMaterno" onchange="FnuevoUsuario.ApellidoMaterno.value=FnuevoUsuario.ApellidoMaterno.value.toUpperCase();"
            onkeypress="return soloLetras(event)" >
            <label class="form-label" for="Puesto">Puesto del profesor</label>
            <input class="form-input" type="text" name="Puesto" id="Puesto" onchange="FnuevoUsuario.Puesto.value=FnuevoUsuario.Puesto.value.toUpperCase();">
            {{-- Error Puesto --}}
            <p class="alert alert-danger" id="PuestoUser" style="display: none">¡¡¡Es un campo necesario!!</p>
            
            <label class="form-label" for="email">Correo Institucional</label>
            <input class="form-input" type="email" name="email" id="email" placeholder="example@upemor.edu.mx">
            {{-- Error email --}}
            <p class="alert alert-danger" id="Correo" style="display: none">¡¡¡Es un campo necesario!!</p>
            
            <label class="form-label" for="password">Contraseña</label>
            <input class="form-input" type="password" name="password" id="password">
            {{-- Errores Contraseña --}}
            <p class="alert alert-danger" id="Contra1" style="display: none">¡¡¡Es un campo necesario!!</p>
            <p class="alert alert-danger" id="Contra2" style="display: none">¡¡¡La contraseña debe tener un minimo de 8 caracteres!!</p>
            <input type="hidden" name="email_verified_at" value="{{$now->format('Y-m-d').' '.$now->format('H:i')}}">
            <input type="hidden" name="created_at" value="{{$now->format('Y-m-d').' '.$now->format('H:i')}}">
            <input type="hidden" name="updated_at" value="{{$now->format('Y-m-d').' '.$now->format('H:i')}}">

            {{-- Foto de perfil --}}
            <label class="form-label" for="Nombres">Foto de Perfil:</label>
            <input class="form-input" type="file" id="Foto" name="Foto">


            <a class="btn btn-danger botones" href="{{route('User.index')}}"> Cancelar </a>
            <button onclick="ValidarNuevoUsuario()" class="btn btn-success botones" type="button" name="enviar" value="enviar">Registrar Usuario</button>
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
                title: 'Duplicación de Usuario...',
                text: '¡Ya existe un usuario con esas Siglas o con el correo institucional ingresado!',
            })
        </script>
    @endif
@endsection

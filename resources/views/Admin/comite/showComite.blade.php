@extends('layouts.plantilla')
@section('title','Ver registro')
@section('content')
    <h1>COMITÉ {{ $comite->NombreComite }}</h1>
    <div class="contenedorComite-datos">
        <div class="contenedorInto d-flex justify-content-between">
            <div class="datosComite">
                {{-- Apartado que muestra los datos del comite, unicamente para su visualización 
                    por lo que no pueden ser editados--}}
                <label>Siglas del Comite:</label>
                <input type="text" value="{{$comite->SiglasComite}}" disabled>
                <label>Nombre del Comite:</label>
                <input type="text" value="{{$comite->NombreComite}}" disabled>
                <label>Sesiones Ordinarias del comite:</label>
                <input type="text" value="{{$comite->SesionesOrdinarias}}" disabled>
                <label>Sesiones Extraordinarias del comite:</label>
                <input type="text" value="{{$comite->SesionesExtraordinarias}}" disabled>
                <label>Auditoria que tiene asignada:</label>
                <input type="text" value="{{$comite->auditoria->SiglasAuditoria}}" disabled>
            </div>
            <div class="listaIntegrantes">
                {{-- Apartado que muestra los integrantes pertenecientes al comité --}}
                <h1>INTEGRANTES</h1>
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Puesto</th>
                            <th>correo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comite->users as $user)
                            <tr>
                                <td scope="row">{{$user->Nombres.' '.$user->ApellidoPaterno.' '.$user->ApellidoMaterno}}</td>
                                <td>{{$user->Puesto}}</td>
                                <td>{{$user->email}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="contenedorBotones d-flex justify-content-evenly">
            <a class="btn btn-danger" href="{{route('Comite.index')}}">Volver a la página principal del comité</a>
            <a class="btn btn-primary" href="{{route('Comite.asignar',$comite)}}">Ingresar nuevo integrante al comité</a>
            <a class="btn btn-warning" href="{{route('Comite.edit',$comite)}}">Editar datos del comité</a>
        </div>
    </div>
@endsection

{{-- Sección de codigo java scrip donde se ven las notificaciones utilizando sweet alert --}}
@section('js')
{{-- Notificación de edición exitosa --}}
@if (session('editar') == 'ok')
<script>
    Swal.fire(
        '¡Cambios guardados!',
        'El comite fue editado de manera exitosa.',
        'success'
    )
</script>
@endif

@endsection

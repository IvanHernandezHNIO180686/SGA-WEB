{{-- Importación del layout --}}
@extends('layouts.app')
{{-- Contenido --}}
@section('content')

<h1 class="titulosProfesor">Bienvenido Profesor {{ Auth::user()->Nombres.' '.Auth::user()->ApellidoPaterno}}</h1>

{{-- Tabla donde se muestran las reuniones iniciadas --}}
<h1 class="titulosProfesor">Reuniones iniciadas</h1>
<div class="contenedorTabla">
    @if($asistencias->count())
    @if($empezadas->count())
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>Nombre Reunión</th>
                <th>Fecha de la Reunion</th>
                <th>Siglas de la Auditoria</th>
                <th>Nombre Comite</th>
                <th>Estatus</th>
                <th>Tipo de Sesión</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empezadas as $empezada)

            <td scope="row">{{$empezada->NombreReunion}}</td>
            <td>{{$empezada->FechaReunion}}</td>
            <td>{{$empezada->SiglasAuditoria}}</td>
            <td>{{$empezada->NombreComite}}</td>
            <td>{{$empezada->NombreEstatus}}</td>
            <td>{{$empezada->NombreSesion}}</td>
            <td>
                {{-- Función que permite al profesor tomar asistencia en caso de haber confirmado su asistencia
                    a esta reunión --}}
                @foreach($asistencias as $asistencia)
                @if($asistencia->reunione->NombreReunion == $empezada->NombreReunion)
                <form action="{{ route('Asistencia.update', $asistencia) }}" method="post">
                    @csrf
                    @method('put')
                    <input class="btn btn-success" type="submit" value="Asistir">
                </form>
                @endif
                @endforeach



            </td>
            </tr>


            @endforeach
        </tbody>
    </table>
    @else
    {{-- Mensaje de vació --}}
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>

    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
            <use xlink:href="#exclamation-triangle-fill" />
        </svg>
        <div>
            Aun no hay reuniones iniciadas.
        </div>
    </div>
    @endif
    @else
    {{-- Mensaje de vació --}}
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>

    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
            <use xlink:href="#exclamation-triangle-fill" />
        </svg>
        <div>
            No hay reuniones iniciadas con su disponibilidad de horario.
        </div>
    </div>
    @endif
</div>

{{-- Tabla donde se muestran las reuniones pendientes --}}
<h1 class="titulosProfesor">Reuniones pendientes</h1>
<div class="contenedorTabla">
    @if($resultados->count())
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>Nombre Reunión</th>
                <th>Fecha de la Reunion</th>
                <th>Siglas de la Auditoria</th>
                <th>Nombre Comite</th>
                <th>Estatus</th>
                <th>Tipo de Sesión</th>
                <th>¿Podrá Asistir?</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($resultados as $resultado)
            <tr>
                <td scope="row">{{$resultado->NombreReunion}}</td>
                <td>{{$resultado->FechaReunion}}</td>
                <td>{{$resultado->SiglasAuditoria}}</td>
                <td>{{$resultado->NombreComite}}</td>
                <td>{{$resultado->NombreEstatus}}</td>
                <td>{{$resultado->NombreSesion}}</td>
                <td>
                    {{-- Apatado que permite al profesor confirmar o negar su asistencia a esta reunión --}}
                    @foreach($reuniones as $reunion)
                    @if($reunion->NombreReunion == $resultado->NombreReunion)

                    <form action="{{ route('Reunion.Asistencia',$reunion)}}" method="post">
                        @csrf
                        <input type="hidden" name="usuario" value="{{ $reunion->id }}">
                        <input type="hidden" name="respuesta" value="1">
                        <input class="btn btn-success" type="submit" value="Asistiré">
                    </form>
                    <form action="{{ route('Reunion.Asistencia',$reunion)}}" method="post">
                        @csrf
                        <input type="hidden" name="usuario" value="{{ $reunion->id }}">
                        <input type="hidden" name="respuesta" id="respuesta" value="2">
                        <input class="btn btn-danger" type="submit" value="No Asistiré">
                    </form>
                    @endif
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    {{-- Mensaje de vació --}}
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>

    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
            <use xlink:href="#exclamation-triangle-fill" />
        </svg>
        <div>
            No tiene reuniones pendientes.
        </div>
    </div>
    @endif
</div>

{{-- Tabla donde se muestran los comités a los que pertenece el profesor --}}
<h1 class="titulosProfesor">Comités a los que pertenece</h1>
<div class="contenedorTabla">
    @if($comites->count())
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>Siglas del Comité</th>
                <th>Nombre del Comité</th>
                <th>Cantidad Sesiones Ordinarias</th>
                <th>Cantidad Sesiones Extraordinarias</th>
                <th>Auditoria</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comites as $comite)
            <tr>
                <td scope="row">{{$comite->SiglasComite}}</td>
                <td>{{$comite->NombreComite}}</td>
                <td>{{$comite->SesionesOrdinarias}}</td>
                <td>{{$comite->SesionesExtraordinarias}}</td>
                <td>{{$comite->auditoria->SiglasAuditoria}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    {{-- Mensaje de vació --}}
    <div class="alertaReuniones">
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path
                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </symbol>
        </svg>

        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            <div>
                Aun no ha sido asignado a ningun Comité
            </div>
        </div>
    </div>
    @endif
</div>


@endsection

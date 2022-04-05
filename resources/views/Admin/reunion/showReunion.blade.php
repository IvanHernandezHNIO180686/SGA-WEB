@extends('layouts.plantilla')
@section('title', 'Ver registro')
@section('content')
<h1>Reunión {{ $reunion->NombreReunion }}</h1>
<div class="DatosReunion">
    {{-- Datos de la reunión que se selecciono de los cuales los input que cuentan con la indicación "disable"
    no pueden ser editados y solo se utilizan para la vizualización --}}
    <label class="datos-label" for="NombreReunion">Nombre de la Reunión:</label>
    <input class="datos-input" type="text" name="NombreReunion" value="{{ $reunion->NombreReunion }}" disabled>
    <label class="datos-label" for="auditoria_id">Auditoría:</label>
    <input class="datos-input" type="text" name="auditoria_id" value="{{ $reunion->Auditoria->SiglasAuditoria }}"
        disabled>
    <label class="datos-label" for="FechaReunion"> Fecha de la Reunión:</label>
    <input class="datos-input" type="date" name="FechaReunion" value="{{ $reunion->FechaReunion }}" disabled>
    <label class="datos-label" for=Observaciones"">Observaciones:</label>
    <textarea class="datos-input" name="Observaciones" id="" cols="30" rows="10"
        disabled>{{ $reunion->Observaciones }}</textarea>
    <label class="datos-label" for="tipo_sesione_id">Tipo de Sesión:</label>
    <input class="datos-input" type="text" name="tipo_sesion_id" value="{{ $reunion->TipoSesione->NombreSesion }}"
        disabled>
    <label class="datos-label" for="tipo_sesione_id">Estatus de la reunión:</label>
    <input class="datos-input" type="text" name="estatu_id" value="{{ $reunion->Estatu->NombreEstatus }}" disabled>

    <br>

    @if ($participantesSI->count() || $participantesNO->count())
    <br>
    {{-- Tabla que se muestra cuendo hay participantes que confirmaron su asistencía --}}
    <h1 class="tituloSreunion">Profesores que podrán asistir</h1>
    <table class="table table-dark">
        <thead>
            <tr>
                <th>Nombre del Profesor</th>
                <th>Correo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participantesSI as $iteratorSI)
            @foreach ($usuarios as $usuario)
            @if ($usuario->id == $iteratorSI->Profesor)
            <tr>
                <td>{{ $usuario->Nombres." ".$usuario->ApellidoPaterno." ".$usuario->ApellidoMaterno }}</td>
                <td>{{ $usuario->email }}</td>
            </tr>
            @endif
            @endforeach
            @endforeach

        </tbody>
    </table>

    {{-- Tabla que se muestra cuendo hay participantes que no podrán asistir a la reunión --}}
    <h1 class="tituloSreunion">Profesores que no podrán asistir</h1>
    <table class="table table-dark">
        <thead>
            <tr>
                <th>Nombre del Profesor</th>
                <th>Correo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participantesNO as $iteratorNO)
            @foreach ($usuarios as $usuario)
            @if ($usuario->id == $iteratorNO->Profesor)
            <tr>
                <td>{{ $usuario->Nombres." ".$usuario->ApellidoPaterno." ".$usuario->ApellidoMaterno }}</td>
                <td>{{ $usuario->email }}</td>
            </tr>
            @endif
            @endforeach
            @endforeach
        </tbody>
    </table>
    @else
    {{-- En caso de que ninguno de los integrantes del comité solicitado para la reunión haya confirmado o
    negado su asistencia, se mostrara una alerta donde se le avisara al administrador de lo sucedido --}}
    <br>
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
            Ningun participante ha dado confirmado o ha negado su participación en la reunión.
        </div>
    </div>
    @endif

    <br>
    @if ($estado == 1)
    {{-- Si el estado de la reunión se encuentra en espera, esta solo podra iniciarse cuando la fecha sea
    la pactada a la hora de su creación y solo se visualizara el botón para cancelar la reunión --}}
    @if ($reunion->FechaReunion < $fechaActual) <form action="{{ route('Reunion.estatus', $reunion) }}" method="POST">
        @csrf
        @method('put')
        <input type="hidden" name="estatu_id" value="4">
        <input class="btn btn-danger btnCancelar-Reunion" type="submit" value="Cancelar Reunion">
        </form>
        @else
        {{-- Si fecha actual es es la fecha en la que se debe de llevar a cabo la reunión esta podra ser cancelada o
        iniciada --}}
        <div class="botonesEstatus">
            {{-- Botón para cancelar reunión --}}
            <form action="{{ route('Reunion.estatus', $reunion) }}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" name="estatu_id" value="4">
                <input class="btn btn-warning btn-block botones" type="submit" value="Cancelar Reunion">
            </form>

            {{-- Botón para iniciar reunión --}}
            @if($reunion->FechaReunion == $fechaActual)
            <form action="{{ route('Reunion.estatus', $reunion) }}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" name="estatu_id" value="2">
                <input class="btn btn-success btn-block botones" type="submit" value="Iniciar la Reunion">
            </form>
            @else
            {{-- Notificación de que la reunión solo puede ser iniciada el dia establecido --}}
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
                    La reunión solo puede ser iniciada el día establecido en su creación.
                </div>
            </div>
            @endif

        </div>


        @endif
        @elseif($estado == 2)
        {{-- Si el estado de la reunión se encuentra iniciada, esta podra ser cancelada o finalizada --}}
        <BR>
        {{-- Botón para cancelar reunión --}}
        <form action="{{ route('Reunion.estatus', $reunion) }}" method="POST">
            @csrf
            @method('put')
            <input type="hidden" name="estatu_id" value="4">
            <input class="btn btn-warning btn-block botones" type="submit" value="Cancelar Reunion">
        </form>
        <BR>
        {{-- Botón para terminar reunión --}}
        <form action="{{ route('Reunion.estatus', $reunion) }}" method="POST">
            @csrf
            @method('put')
            <input type="hidden" name="estatu_id" value="3">
            <input class="btn btn-danger btn-block botones" type="submit" value="Finalizar la Reunion">
        </form>
        @endif
        <BR><a class="btn btn-light btn-block botones" href="{{ route('Reunion.index') }}">Regresar</a>
</div>

@endsection
{{-- Importación de la plantilla --}}
@extends('layouts.plantilla')
{{-- Nombre de la pestaña --}}
@section('title','HomeAdmin')
{{-- Contenido --}}
@section('content')
    <h1> {{ Auth::user()->Nombres.' '.Auth::user()->ApellidoPaterno}}</h1>
    <h1>SEA USTED BIENVENIDO A LA PÁGINA PRINCIPAL DEL ADMINISTRADOR</h1>

    <p class="parrafo">
        Esta es la pagina principal para el perfil del administrador, dentro de este apartado, podrá visualizar
        las auditorías que se llevarán a cabo en fechas proximas, además de poder ver las reuniones que estan
        programandas.
        Además este apartado ofrece la oportunidad de vizualizar los usuarios que desean ser ingresados en el
        sistema.
    </p><br><br>

    <h1>Solicitudes de Registro</h1>
<p class="parrafo">
    Es bien sabido que cada vez que un usuario se registra de manera individual, este necesita esperar
    la autorizacion de usted en su papel de administrador, es por ello que la siguiente tabla permite ver
    aquellas solicitudes de usuarios pendientes donde podrá autorizar o denegar la solicitud de registro.
</p><br>
    <div class="contenedorTabla">
    @livewire('solicitud.buscar-solicitud')
    </div><br><br>

    <h1>Auditorias Proximas</h1>
    <div class="contenedorTabla">
    <table class="table table-dark table-hover">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Siglas de la Auditoria</th>
            <th scope="col">Organismo</th>
            <th scope="col">Fecha de la Auditoria</th>
            <th scope="col">Comentarios</th>
            <th scope="col">Tipo de Auditoria</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Auditorias as $Auditoria)
            <tr>
                <th>{{$Auditoria->id}}</th>
                <th>{{$Auditoria->SiglasAuditoria}}</th>
                <td>{{$Auditoria->Organismo}}</td>
                <td>{{$Auditoria->FechaAuditoria}}</td>
                <td>{{$Auditoria->Comentarios}}</td>
                <td>{{$Auditoria->tipoAuditoria->NombreTipo}}</td>
            </tr>
        @endforeach
    </tbody>
    </table>
</div>
{{$Auditorias->links()}}
<br><br>

<h1>Reuniones Proximas</h1>
<div class="contenedorTabla">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre de la reunion</th>
                <th>Siglas Auditoria</th>
                <th>Tipo Reunion</th>
                <th>Fecha</th>
                <th>Estatus</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($Reuniones as $reunion)
            <tr>
                <td scope="row">{{$reunion->id}}</td></td>
                <td>{{$reunion->NombreReunion}}</td>
                <td>{{$reunion->Auditoria->SiglasAuditoria}}</td>
                <td>{{$reunion->TipoSesione->NombreSesion}}</td>
                <td>{{$reunion->FechaReunion}}</td>
                <td>{{$reunion->Estatu->NombreEstatus}}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
    {{$Reuniones->links()}}

    <br><br>





@endsection

{{-- Área de JAVA SCRIPT --}}
@section('js')
{{-- Notificación de eliminar --}}
@if(session('eliminar') == 'ok')
<script>
    Swal.fire(
        '¡Solicitud Eliminada!',
        'La Solicitud ha sido eliminada exitosamente.',
        'success'
    )
</script>
@endif

{{-- Notificación de aceptación --}}
@if(session('aceptar') == 'ok')
<script>
    Swal.fire(
        '¡Solicitud Aceptada!',
        'El usuario fue registrado exitosamente.',
        'success'
    )
</script>
@endif

@endsection

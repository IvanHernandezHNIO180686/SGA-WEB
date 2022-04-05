{{-- Importación de layout --}}
@extends('layouts.app')
{{-- Contenido --}}
@section('content')
<h1>Notificaciones</h1>
<div class="contenedorTabla">
{{-- Si existen datos se muestra en la tabla --}}
@if($notificacionesU->count())
<table class="table table-light table-hover">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Accion</th>
            <th>Acciones</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($notificacionesU as $notificacion)
                    <tr>
                        <td scope="row">{{$notificacion->NombreNotificacion}}</td>
                        <td>{{$notificacion->Accion}}</td>
                        <td>
                            @if ($notificacion->Estado  === 'Leido')
                                <form method="post" action="{{route('Notificacion.destroy',$notificacion)}}">
                                    @csrf
                                    @method('delete')
                                    <input class="btn btn-danger" type="submit" value="Eliminar Notificacion">
                                </form>
                            @elseif($notificacion->Estado === 'Sin leer' || $notificacion->Estado === 'SIN LEER' || $notificacion->Estado === 'sin leer')
                            <form method="post" action="{{route('Notificacion.update',$notificacion)}}">
                                @csrf
                                @method('put')
                                <input class="btn btn-primary" type="submit" value="Marcar como leida">
                            </form>
                            <form method="post" action="{{route('Notificacion.destroy',$notificacion)}}">
                                @csrf
                                @method('delete')
                                <input class="btn btn-danger" type="submit" value="Eliminar Notificacion">
                            </form>
                            @endif
                        </td>

                    </tr>

        @endforeach
    </tbody>
</table>
@else
{{-- Si no existen datos es neserario mostrar el mensaje de vacío --}}
    <h4>No hay notificaciones</h4>
@endif
</div>


@endsection

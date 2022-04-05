@extends('layouts.plantilla')
@section('title','Reuniones del Comité')
@section('content')
<div class="contenedorTabla">
    <h1>Reuniones que ha tenido el Comité {{ $comite->NombreComite }}</h1>
    @if (isset($reuniones))
    {{-- Tabla que muestra las reuniones que ha tenido el comité desde su creación --}}
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>Nombre de la reunión</th>
                <th>Fecha de la Reunión</th>
                <th>Estatus de la Reunión</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reuniones as $reunion)
            <tr>
                <td scope="row">{{ $reunion->NombreReunion }}</td>
                <td>{{ $reunion->FechaReunion }}</td>
                <td>{{ $reunion->estatu->NombreEstatus }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a class="btn btn-danger" href="{{ route('Comite.index') }}">Volver a la página principal de comités</a>
</div>
@else
{{-- Mensaje que aparece si el comité no ha tenido reuniones aun --}}
<div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Lo sentimos!</h4>
    <p>El comité llamado {{ $comite->NombreComite }} no ha tenido alguna reunión</p>
    <hr>
    <p class="mb-0">Si desea agendar una reunión a este comite <a href="{{ route('Reunion.create') }}">de clic aqui</a>
    </p>
</div>
<a class="btn btn-danger" href="{{ route('Comite.index') }}">Volver a la página principal de comités</a>
@endif
@endsection
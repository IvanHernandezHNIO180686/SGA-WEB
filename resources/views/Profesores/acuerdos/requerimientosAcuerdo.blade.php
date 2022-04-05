{{-- Importación de layout --}}
@extends('layouts.app')
{{-- Contenido --}}
@section('content')
{{-- Tabla de requerimientos --}}
<h1>Mis Requerimientos</h1>
<table class="table">
    <thead>
        <tr>
            <th>Folio</th>
            <th>Acuerdo</th>
            <th>Nombre Requerimiento</th>
            <th>Descripción</th>
            <th>Estado del Requerimiento</th>
            <th>Acciones</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($archivos as $archivo)
        @if($archivo->acuerdo_id == $acuerdo->id)
        <tr>
            <td scope="row">{{$archivo->Folio}}</td>
            <td>{{$archivo->acuerdo->NumeroAcuerdo}}</td>
            <td>{{$archivo->NombreRequerimiento}}</td>
            <td>{{$archivo->Descripcion}}</td>
            @if($archivo->Ruta == '')
            <td>No se ha cumplido este requerimiento</td>
            <td>
                <a class="" href="{{route('Archivo.subirArchivo',$archivo)}}">Subir Archivo</a>
            </td>
            @else
            <td>Ya se ha cumplido este requerimiento</td>
            <td>
                <a href="{{route('Archivo.download',$archivo->uuid)}}">Descargar Archivo</a>
            </td>
            @endif

        </tr>
        @endif
        @endforeach
    </tbody>
</table>



@endsection

{{-- Importación del layout --}}
@extends('layouts.app')
{{-- Inicio del Contenido --}}
@section('content')
<h1>Subir Archivo</h1>
{{-- Formulario para subir archivo al requerimiento --}}
<form action="{{route('Archivo.update',$archivo)}}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Folio</label>
    <input type="text" name="Folio" id="Folio" value="{{$archivo->Folio}}" disabled>
    <label>Nombre del Requerimiento</label>
    <input type="text" name="NombreArchivo" id="NombreArchivo" value="{{$archivo->NombreArchivo}}" disabled>
    <label>Descripción</label>
    <input type="text" name="Descripcion" id="Descripcion" value="{{$archivo->Descripcion}}" disabled>
    {{-- Input para subir un archivo --}}
    <label>Archivo</label>
    <input type="file" name="archivo_requerimiento">
    <input type="submit" value="Agregar">

</form>

@endsection

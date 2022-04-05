{{-- Importación del layout --}}
@extends('layouts.app')

{{-- Contenido de la interfaz --}}
@section('content')
{{-- Tabla de los acuerdos pertenecientes al profesor --}}
<h1>Mis Acuerdos</h1>
<table class="table">
    <thead>
        <tr>
            <th>id</th>
            <th>Numero de Acuerdo</th>
            <th>Responsable</th>
            <th>Fecha de Cumplimiento</th>
            <th>Observaciones</th>
            <th>Nombre de la Reunion</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($acuerdos as $acuerdo)
        @if($acuerdo->Responsable == $usuario->SiglasUsuario)
        <tr>
            <td scope="row">{{$acuerdo->id}}</td>
            <td>{{$acuerdo->NumeroAcuerdo}}</td>
            <td>{{$acuerdo->Responsable}}</td>
            <td>{{$acuerdo->FechaCumplimiento}}</td>
            <td>{{$acuerdo->Observaciones}}</td>
            <td>{{$acuerdo->Reunione->NombreReunion}}</td>
            <td>

                <form action="{{route('Archivo.requerimientos', $acuerdo)}}" method="POST">
                    @csrf
                    <button type="submit"> Requerimientos </button>
                </form>

            </td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>
{{$acuerdos->links()}}



@endsection

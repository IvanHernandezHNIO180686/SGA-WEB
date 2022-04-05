{{-- Importación del layout --}}
@extends('layouts.app')
{{-- Contenido del la interfaz --}}
@section('content')

<h1>MIS COMITÉS</h1>
{{-- Si existen datos se muestra en la tabla --}}
<div class="contenedorTabla">
    @if ($comites->count())
    <table class="table">
        <thead>
            <tr>
                <th>Nombre del Comité</th>
                <th>Auditoria a cargo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comites as $comite)
            <tr>
                <td scope="row">{{ $comite->NombreComite }}</td>
                <td>{{ $comite->auditoria->SiglasAuditoria }}</td>
            </tr>
            @endforeach


        </tbody>
    </table>
    @else
    {{-- Si no existen datos es neserario mostrar el mensaje de vacío --}}
    <h4>Aun no hay comités para usted</h4>
    @endif
</div>
@endsection

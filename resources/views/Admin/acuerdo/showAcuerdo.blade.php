@extends('layouts.plantilla')
@section('title','Ver Acuerdo')
@section('content')

<h1>Reporte del acuerdo {{$acuerdo->NumeroAcuerdo}}</h1>
{{-- Visualización del reporte de un acuerdo --}}
<div class="DatosAcuerdo">
    <label class="datos-label">Número de Acuerdo:</label>
    <input class="datos-input" type="text" value="{{$acuerdo->NumeroAcuerdo}}" disabled>
    <label class="datos-label">Auditoría:</label>
    <input class="datos-input" type="text" value="{{$acuerdo->Auditoria}}" disabled>
    <label class="datos-label">Responsable:</label>
    <input class="datos-input" type="text" value="{{$acuerdo->Responsable}}" disabled>
    <label class="datos-label">Comité:</label>
    <input class="datos-input" type="text" value="{{$acuerdo->Comite}}" disabled>
    <label class="datos-label">Fecha de Cumplimiento:</label>
    <input class="datos-input" type="text" value="{{$acuerdo->FechaCumplimiento}}" disabled>
    <label class="datos-label">Reunión:</label>
    <input class="datos-input" type="text" value="{{$acuerdo->reunione->NombreReunion}}" disabled>
    <br><br>

    {{-- Tabla que se muestra si hay requerimientos asignados al acuerdo --}}
    <h1 class="title-Req">Requerimientos</h1>
    @if($archivos->count())

    <table class="table table-dark">
        <thead>
            <tr>
                <th>Folio</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($archivos as $archivo)
            @if ($archivo->acuerdo_id == $acuerdo->id)
            <tr>
                <td>{{$archivo->Folio}}</td>
                <td>{{$archivo->Descripcion}}</td>
                <td>
                    {{-- Botón para eliminar el requerimiento --}}
                    <form class="formu_eliminar" action="{{route('Archivo.destroy', $archivo)}}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" type="submit"> Eliminar Requerimiento </button>
                    </form>
                    {{-- Botón para descargar el archivo perteneciente a el requerimiento en caso de haber un archivo --}}
                    @if($archivo->Ruta != '')
                        <a class="btn btn-success" href="{{route('Archivo.download',$archivo->uuid)}}">Descargar Archivo</a>
                    @endif
                </td>
            </tr>
            @endif

            @endforeach
        </tbody>
    </table>

    {{-- Botón que nos permite abrir el modal para crear un nuevo requerimiento --}}
    <div class="d-flex justify-content-around">
        <a class="btn btn-primary modal-trigger" href="#modal1">Agregar requerimientos</a>
        <a class="btn btn-danger" href="{{route('Acuerdo.pdf',$acuerdo)}}" class="btn btn-primary btn-sm">{{__('Crear
            PDF')}} </a>
        <a class="btn btn-light" href="{{route('Acuerdo.index')}}">Regresar</a>
    </div>

    @else
    {{-- Notificación que se muestra en caso de no haber requerimientos --}}
    <div class="alert alert-danger" role="alert">
        <div class="card">
            <div class="card-header">
                Sin Resultados
            </div>
            <div class="card-body">
                <h5 class="card-title">Sin Requerimientos</h5>
                <p class="card-text">No existen requerimientos para este acuerdo.</p>
            </div>
        </div>
    </div>

    {{-- Modal que se muestra para poder agregar un nuevo requerimiento para el acuerdo --}}
    <div class="d-flex justify-content-around">
        <a class="btn btn-primary modal-trigger" href="#modal1">Agregar requerimientos</a>
        <a class="btn btn-danger" href="{{route('Acuerdo.pdf',$acuerdo)}}" class="btn btn-primary btn-sm">{{__('Crear
            PDF')}} </a>
        <a class="btn btn-light" href="{{route('Acuerdo.index')}}">Regresar</a>
    </div>
    @endif
</div>

<!-- Estructura del modal -->
<div id="modal1" class="modal ">
    <div class="modal-dialog">
        <div class="modal-content modal-Requerimientos">
            <div class="modal-header">
                <h5 class="modal-title">AGREGAR REQUERIMIENTO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>DATOS DEL REQUERIMIENTO</p>
                {{-- Formulario para registro del requisito --}}
                <form action="{{route('Archivo.store',$acuerdo)}}" method="POST">
                    @csrf
                    <label class="form-label">Nombre del Requerimiento:</label>
                    <input class="form-input" type="text" name="NombreRequerimiento" id="NombreRequerimiento">
                    <label class="form-label" for="">Descripción:</label>
                    <input class="form-input" type="text" name="Descripcion" id="Descripcion">
                    <div class="modal-footer">
                        <a href="#!" class="modal-close btn btn-danger">Cancelar</a>
                        <input class="btn btn-success" type="submit" value="Agregar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- Sección de codigo java scrip donde se ven las notificaciones utilizando sweet alert --}}
@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems);
    });
</script>

{{-- Notificación de eliminación exitosa de un requerimiento --}}
@if(session('eliminar') == 'ok')
<script>
    Swal.fire(
    '¡Borrado!',
    'El requerimiento ha sido eliminado exitosamente.',
    'success'
    )
</script>
@endif

{{-- Cuadro de dialogo para confirmar la eliminación de un requerimiento --}}
<script>
    $('.formu_eliminar').submit(function(e){
        e.preventDefault();
        Swal.fire({
            title: '¿Estas seguro?',
            text: "¡Una vez eliminado el requerimiento no se podrá recuperar la información!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, deseo eliminarlo!',
            cancelButtonText: '¡Cancelar!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    });
</script>
@endsection
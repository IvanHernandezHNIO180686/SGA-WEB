<div>
    {{-- input que permite renderizar las busquedas --}}
    <div class="d-flex flex-row-reverse ">
        <input class="form-control me-2 search" type="search" placeholder="Ingrese las siglas de la Auditoría" wire:model="search">
    </div>
    {{-- Si existen datos se muestran dentro de una table --}}
    @if ($Auditorias->count())
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Siglas de la Auditoria</th>
                <th scope="col">Organismo</th>
                <th scope="col">Fecha de la Auditoria</th>
                <th scope="col">Comentarios</th>
                <th scope="col">Tipo de Auditoria</th>
                <th scope="col"> Acciones</th>
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
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a class="btn btn-warning editar" href="{{route('Auditoria.edit',$Auditoria)}}">Editar</a>
                            <form class="formu_eliminar" action="{{route('Auditoria.destroy', $Auditoria)}}" method="POST">
                                @csrf
                                @method('delete')
                                <input class="btn btn-danger eliminar" type="submit" value="Eliminar">
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </table>
    <div class="d-flex justify-content-between">
        <div class="botonAgregar">
            <a href="{{ route('Auditoria.create') }}" class="btn btn-primary">Crear Auditoria</a>
        </div>
        <div class="paginacion">
            {{$Auditorias->links()}}
        </div>
    </div>
    @else
    {{-- Mensaje de vacío --}}
        <div class="alert alert-danger" role="alert">
            <div class="card">
                <div class="card-header">
                    Sin Resultados
                </div>
                <div class="card-body">
                    <h5 class="card-title">Resultado de la Busqueda</h5>
                    <p class="card-text">No existen auditorías que coincidan con la busqueda realizada.</p>
                    <a href="{{ route('Auditoria.create') }}" class="btn btn-primary">Crear Auditoria</a>
                </div>
            </div>
        </div>
    @endif
</div>

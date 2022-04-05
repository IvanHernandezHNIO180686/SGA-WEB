<div>
    {{-- input que permite renderizar las busquedas --}}
    <div class="d-flex flex-row-reverse ">
        <input class="form-control me-2 search" placeholder="Buscar reunión" type="text" wire:model="search">
    </div>
    {{-- Si existen datos se muestran dentro de una table --}}
    @if ($Reuniones->count())
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre de la reunion</th>
                    <th>Siglas Auditoria</th>
                    <th>Tipo Reunion</th>
                    <th>Fecha</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
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
                        <th>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a class="btn btn-success" href="{{route('Reunion.acuerdo',$reunion)}}">Crear Acuerdo</a>
                                <a class="btn btn-warning" href="{{route('Reunion.edit', $reunion)}}">Editar</a>
                                <form class="formu_eliminar" action="{{route('Reunion.destroy', $reunion)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input class="btn btn-danger btnEliminar-Reunion" type="submit" value="Eliminar">
                                </form>
                                <a class="btn btn-info " href="{{route('Reunion.show', $reunion)}}">Ver</a>
                            </div>

                        </th>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <a href="{{route('Reunion.create')}}" class="btn btn-primary btn-crear">Crear Reunion</a>
            {{$Reuniones->links()}}
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
                    <p class="card-text">No existen reuniones que coincidan con la busqueda realizada.</p>
                    <a href="{{route('Reunion.create')}}" class="btn btn-primary">Crear Reunion</a>
                </div>
            </div>
        </div>
    @endif
</div>

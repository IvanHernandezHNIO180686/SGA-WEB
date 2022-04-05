<div>
    {{-- input que permite renderizar las busquedas --}}
    <div class="d-flex flex-row-reverse ">
        <input class="form-control me-2 search" type="text" placeholder="Ingrese las siglas del Comité" wire:model="search">
    </div>
    {{-- Si existen datos se muestran dentro de una table --}}
    @if ($Comites->count())
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Siglas Comite</th>
                <th>Nombre</th>
                <th>Sesiones<br> Ordinarias</th>
                <th>Sesiones<br> Extraordinarias</th>
                <th>Auditoria a Cargo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Comites as $comite)
                <tr>
                    <td scope="row">{{$comite->id}}</td>
                    <td>{{$comite->SiglasComite}}</td>
                    <td>{{$comite->NombreComite}}</td>
                    <th>{{$comite->SesionesOrdinarias}}</th>
                    <th>{{$comite->SesionesExtraordinarias}}</th>
                    <th>{{$comite->auditoria->SiglasAuditoria}}</th>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <a class="btn btn-success editar" href="{{route('Comite.show',$comite)}}">Ver</a>
                            <a class="btn btn-info" href="{{route('Comite.reuniones',$comite)}}">Reuniones</a>
                            <form class="formu_eliminar" action="{{route('Comite.destroy', $comite)}}" method="POST">
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

    <a class="btn btn-primary" href="{{route('Comite.create')}}">Agregar un nuevo Comite</a>
    {{$Comites->links()}}
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
                    <a class="btn btn-primary" href="{{route('Comite.create')}}">Agregar un nuevo Comite</a>
                </div>
            </div>
        </div>
    @endif
</div>

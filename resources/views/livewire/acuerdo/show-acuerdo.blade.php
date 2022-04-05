<div>
    <h1>Binvenido a la página principal de los Acuerdos</h1>
    {{-- Campo para buscar un acuerdo especifico --}}
    <div class="d-flex flex-row-reverse ">
        <input class="form-control me-2 search" type="search" placeholder="Buscar comite" wire:model="search">
    </div>

    {{-- Si el acuerdo existe se muestra la tabla llena y si no se muestra un mensaje. --}}
    @if ($Acuerdos->count())
    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>Numero de Acuerdo</th>
                <th>Responsable</th>
                <th>Fecha de Cumplimiento</th>
                <th>Observaciones</th>
                <th>Nombre de la Reunion</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Acuerdos as $acuerdo)
            <tr>
                <td scope="row">{{$acuerdo->id}}</td>
                <td>{{$acuerdo->NumeroAcuerdo}}</td>
                <td>{{$acuerdo->Responsable}}</td>
                <td>{{$acuerdo->FechaCumplimiento}}</td>
                <td>{{$acuerdo->Observaciones}}</td>
                <td>{{$acuerdo->Reunione->NombreReunion}}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a class="btn btn-info" href="{{route('Acuerdo.show',$acuerdo)}}">Reporte</a>
                        <a class="btn btn-warning" href="{{route('Acuerdo.edit',$acuerdo)}}">Editar</a>

                        <form class="formu_eliminar" name="formu_eliminar"
                            action="{{route('Acuerdo.destroy', $acuerdo)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btnEliminar-Acuerdo" type="submit"> Eliminar </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-between">
        <div class="botonAgregar">
            <a href="{{ route('Acuerdo.create') }}" class="btn btn-primary">Crear Acuerdo</a>
        </div>
        <div class="paginacion">
            {{$Acuerdos->links()}}
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
                <p class="card-text">No existen acuerdos que coincidan con la busqueda realizada.</p>
                <a href="{{ route('Acuerdo.create') }}" class="btn btn-primary">Crear Acuerdo</a>
            </div>
        </div>
    </div>
    @endif

</div>

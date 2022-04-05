<div>
    {{-- input que permite renderizar las busquedas --}}
    <div class="d-flex flex-row-reverse ">
        <input class="form-control me-2 search" type="text" placeholder="Buscar usuario" wire:model="search">
    </div>
    {{-- Si existen datos se muestran dentro de una table --}}
    @if ($Usuarios->count())
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Siglas</th>
                <th>Nombre</th>
                <th>Puesto</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Usuarios as $user)
                <tr>
                    <td scope="row">{{$user->id}}</td>
                    <td>{{$user->SiglasUsuario}}</td>
                    <td>{{$user->Nombres.' '.$user->ApellidoPaterno.' '.$user->ApellidoMaterno}}</td>
                    <th>{{$user->Puesto}}</th>
                    <th>{{$user->email}}</th>
                    <td>
                        <form action="{{route('Comite.agregarUsuario',$comite)}}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" id="" value="{{$user->id}}">
                        <input type="submit" class="btn btn-success" value="Agregar al comite">
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-between">
        <div class="cancelar">
            <a class="btn btn-danger" href="{{route('Comite.show',$comite)}}">Terminar Proceso de Asignación</a>
        </div>
        <div class="paginacion">
            {{$Usuarios->links()}}
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
                    <p class="card-text">No existen usuarios que coincidan con la busqueda realizada.</p>
                </div>
            </div>
        </div>
    @endif
</div>

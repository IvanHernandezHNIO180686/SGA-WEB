<div>
    {{-- input que permite renderizar las busquedas --}}
    <div class="d-flex flex-row-reverse ">
        <input class="form-control me-2 search" type="search" placeholder="Ingrese las Siglas del Usuario" wire:model="search">
    </div>
    {{-- Si existen datos se muestran dentro de una table --}}
    @if ($Users->count())
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
            @foreach ($Users as $user)
                <tr>
                    <td scope="row">{{$user->id}}</td>
                    <td>{{$user->SiglasUsuario}}</td>
                    <td>{{$user->Nombres.' '.$user->ApellidoPaterno.' '.$user->ApellidoMaterno}}</td>
                    <th>{{$user->Puesto}}</th>
                    <th>{{$user->email}}</th>
                    <td>
                        <div class="btn-group" role="group">
                            <a class="btn btn-info" href="{{route('User.asignar',$user)}}">Asignar Comite</a>
                            <a class="btn btn-warning" href="{{route('User.edit',$user)}}">Editar</a>
                            @if ($user->role_id != 1)
                            <form class="formu_eliminar" name="formu_eliminar" id="formu_eliminar" action="{{route('User.destroy', $user)}}" method="POST">
                                @csrf
                                @method('delete')
                                <input class="btn btn-danger btn-eliminar-User" type="submit" value="Eliminar">
                            </form>
                            @endif

                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-between">
        <div class="botonCancelar">
            <a class="btn btn-primary" href="{{route('User.create')}}">Agregar Nuevo Profesor</a>
        </div>
        <div class="paginacion">
            {{$Users->links()}}
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
                <a href="{{ route('User.create') }}" class="btn btn-primary">Agregar Nuevo Profesor</a>
            </div>
        </div>
    </div>
    @endif
</div>

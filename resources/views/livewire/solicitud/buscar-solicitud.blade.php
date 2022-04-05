<div>
    {{-- input que permite renderizar las busquedas --}}
    <div class="d-flex flex-row-reverse ">
        <input class="form-control me-2 search" type="search" placeholder="Search" wire:model="search">
    </div>
    {{-- Si existen datos se muestran dentro de una table --}}
    @if ($Users->count())
    <table class="table">
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
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <form action="{{route('User.aceptar', $user)}}" method="POST">
                                @csrf
                                @method('put')
                                <input class="aceptar btn btn-success" type="submit" value="Aceptar">
                            </form>
                            <form action="{{route('User.denegar', $user)}}" method="POST">
                                @csrf
                                @method('delete')
                                <input class="denegar btn btn-danger" type="submit" value="Denegar">
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$Users->links()}}
    @else
{{-- Mensaje de vacío --}}
    <div class="alert alert-danger" role="alert"><div class="card">
        <div class="card-header">
          Sin Solicitudes
        </div>
        <div class="card-body">
          <h5 class="card-title">Solicitudes</h5>
          <p class="card-text">No existen solicitudes por revisar en este momento.</p>
        </div>
      </div></div>

    @endif
</div>

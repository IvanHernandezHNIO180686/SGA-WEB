@extends('layouts.plantilla')
@section('title','Editar Auditorias')
@section('content')
<h1>Editar Datos del Comité</h1>
{{-- Formulario para editar un comité en específico --}}
    <div class="formularioEditCom-Cont">
        <form class="Formu-editarComite" action="{{route('Comite.update',$comite)}}" method="POST">
            @csrf
            @method('put')
            <div class="editComite">
                <div class="d-flex justify-content-between">
                    <div class="datosComite">
                        <label class="form-label" for="SiglasComite">Siglas del Comité</label>
                        <input class="form-input" type="text" name="SiglasComite"  value="{{$comite->SiglasComite}}">
                        {{-- Validación para las siglas del comité --}}
                        @error('SiglasComite')
                            <div  class="alert alert-danger ">
                                <small>
                                    {{$message}}
                                </small>
                            </div>
                        @enderror
                        <label class="form-label" for="NombreComite">Nombre del Comite</label>
                        <input class="form-input" type="text" name="NombreComite" id="NombreComite" value="{{$comite->NombreComite}}">
                        {{-- Validación para el nombre del comité --}}
                        @error('NombreComite')
                            <div  class="alert alert-danger ">
                                <small>
                                    {{$message}}
                                </small>
                            </div>
                        @enderror
                        <input type="hidden" name="created_at" id="created_at" value="{{$comite->created_at}}">
                        <label class="form-label" for="auditoria_id">Auditoria Asignada</label>
                        <select class="form-input" name="auditoria_id" id="">
                            {{-- Lista desplegable para modificar la auditoría que tiene asignada el comite --}}
                            @foreach ($Auditorias as $auditoria)
                                @if ($auditoria->id == $comite->auditoria_id)
                                    <option value="{{$auditoria->id}}" selected>{{$auditoria->SiglasAuditoria}}</option>
                                @else
                                    <option value="{{$auditoria->id}}">{{$auditoria->SiglasAuditoria}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    {{-- Tabla donde se muestran los integrantes del comité --}}
                    <div class="listaIntegrantes">
                        <h2>INTEGRANTES</h2>
                        <p>Marque la casilla del integrante que desee eliminar del comité</p>
                        <table class="table table-hover tablaIntegrantes">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Puesto</th>
                                    <th>Correo Institucional</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comite->users as $user)
                                    <tr>
                                        <td scope="row">{{$user->Nombres.' '.$user->ApellidoPaterno.' '.$user->ApellidoMaterno}}</td>
                                        <td>{{$user->Puesto}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            {{-- Casilla para seleccionar si se desea eliminar el integrante --}}
                                            <input class="form-check-input check" type="checkbox" name="integrantes[]" id="" value="{{ $user->id }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-evenly">
                    <a class="btn btn-danger botones" href="{{route('Comite.show',$comite)}}">Cancelar</a>
                    <input  class="btn btn-success botones" type="submit" value="Guardar Cambios">
                </div>
            </div>
        </form>
    </div>
@endsection

{{-- Sección de codigo java scrip donde se ven las notificaciones utilizando sweet alert --}}
@section('js')
{{-- Cuadro de dialogo para confirmar la edición del comité --}}
    <script>
        $('.Formu-editarComite').submit(function(e){
            e.preventDefault();
            Swal.fire({
                    title: '¿Seguro que desea guardar los cambios?',
                    text: "¡Una vez guardados los cambios no habra vuelta atras!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Si, deseo guardar los cambios!',
                    cancelButtonText: '¡Cancelar!'
                }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    </script>
@endsection

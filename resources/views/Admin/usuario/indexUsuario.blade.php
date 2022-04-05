{{-- Importación del loyout --}}
@extends('layouts.plantilla')
{{-- Titulo de la página --}}
@section('title','Inicio Usuarios')
{{-- Sección del Contenido --}}
@section('content')
<h1>Bienvenido a la vista de Profesores</h1>
{{-- Tabla general de los usuarios por medio de liveware --}}
<div class="contenedorTabla">
    @livewire('usuario.buscar-usuario')
</div>
@endsection

{{-- Sección de java script --}}
@section('js')

{{-- Notificación editar--}}
@if(session('editar') == 'ok')
<script>
    Swal.fire(
        '¡Cambios Guardados!',
        'Los datos del usuario han sido guardados exitosamente.',
        'success'
    )
</script>
@endif

{{-- Notificación asignar--}}
@if(session('asignacion') == 'ok')
<script>
    Swal.fire(
        '¡Asignación a Comité!',
        'El usuario fue asignado exitosamente.',
        'success'
    )
</script>
@endif

{{-- Notificación eliminar--}}
@if(session('eliminar') == 'ok')
<script>
    Swal.fire(
        '¡Usuario Eliminado!',
        'El Usuario ha sido eliminado exitosamente.',
        'success'
    )
</script>
@endif

{{-- Notificación registro--}}
@if(session('guardado') == 'ok')
<script>
    Swal.fire(
                '¡Usuario Registrado!',
                'El usuario ha sido registrado exitosamente.',
                'success'
            )
</script>
@endif

{{-- Dialogo de confirmación para eliminar --}}
<script>
    $('.formu_eliminar').submit(function(e){
        e.preventDefault();
        Swal.fire({
            title: '¿Estas seguro?',
            text: "¡Al realizar esta accion el usuario ya no podrá ingresar al sistema!",
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
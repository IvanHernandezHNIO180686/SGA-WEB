@extends('layouts.plantilla')
@section('title','Reuniones')
@section('content')
    <h1>Binvenido a la página principal de las Reuniones</h1>
    {{-- Tabla donde se visualizan las reuniones en general utilizando la libreria de liveware para la
        renderización de las busquedas y que estas sean instantaneas --}}
    <div class="contenedorTabla">
        @livewire('reunion.buscar-reunion')
    </div>
@endsection

{{-- Sección de codigo java scrip donde se ven las notificaciones utilizando sweet alert --}}
@section('js')
    {{-- Notificación de cambios guardados --}}
    @if(session('editar') == 'ok')
        <script>
            Swal.fire(
                '¡Cambios Guardados!',
                'Los datos de la reunión han sido editados exitosamente.',
                'success'
            )
        </script>
    @endif

    {{-- Notificación de eliminación exitosa --}}
    @if(session('eliminar') == 'ok')
        <script>
            Swal.fire(
                '¡Reunión Eliminada!',
                'La reunión ha sido eliminada exitosamente.',
                'success'
            )
        </script>
    @endif

    {{-- Notificación de registro exitoso --}}
    @if(session('guardado') == 'ok')
        <script>
            Swal.fire(
                '¡Reunión Creada!',
                'La reunión ha sido creada exitosamente.',
                'success'
            )
        </script>
    @endif

    {{-- Cuadro de dialogo para confirmar la eliminación de la reunión --}}
    <script>
        $('.formu_eliminar').submit(function(e){
            e.preventDefault();
            Swal.fire({
                title: '¿Estas seguro?',
                text: "¡Una vez eliminada la reunión no se podrá recuperar la información!",
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

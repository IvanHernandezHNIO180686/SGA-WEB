@extends('layouts.plantilla')
@section('title','Inicio Comites')
@section('content')
    <h1>Bienvenido a la vista de Comités</h1>
    {{-- Tabla donde se visualizan los comités en general utilizando la libreria de liveware para la renderización
    de las busquedas y que estas sean instantaneas --}}
    <div class="contenedorTabla">
        @livewire('comite.buscar-comite')
    </div>
@endsection

{{-- Sección de codigo java scrip donde se ven las notificaciones utilizando sweet alert --}}
@section('js')
{{-- Notificación de eliminación exitosa --}}
@if(session('eliminar') == 'ok')
<script>
    Swal.fire(
        '¡Comité Eliminado!',
        'El comité ha sido eliminado exitosamente.',
        'success'
    )
</script>
@endif
{{-- Cuadro de dialogo para confirmar la eliminación del comite --}}
<script>
    $('.formu_eliminar').submit(function(e){
        e.preventDefault();
        Swal.fire({
            title: '¿Estas seguro?',
            text: "¡Una vez eliminado el registro no se podrá recuperar la información!",
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

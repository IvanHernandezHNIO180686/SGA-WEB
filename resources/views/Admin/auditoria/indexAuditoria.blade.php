@extends('layouts.plantilla')
@section('title', 'Inicio Auditorias')
@section('content')

<h1>Bienvenido a la pagina principal de auditorias</h1>
{{-- Tabla donde se visualizan las auditorias en general utilizando la libreria de liveware para la renderización
    de las busquedas y que estas sean instantaneas --}}
<div class="contenedorTabla">
    @livewire('auditoria.buscar-auditoria')
</div>
@endsection

{{-- Sección de codigo java scrip donde se ven las notificaciones utilizando sweet alert --}}
@section('js')
{{-- Notificación de cambios guardados --}}
@if (session('editar') == 'ok')
<script>
    Swal.fire(
        '¡Cambios guardados!',
        'La Auditoría fue editada de manera exitosa.',
        'success'
    )
</script>
@endif
{{-- Notificación de registro exitoso --}}
@if (session('crear') == 'ok')
<script>
    Swal.fire(
        '¡Datos guardados!',
        'La Auditoría fue creada de manera exitosa.',
        'success'
    )
</script>
@endif
{{-- Notificación de eliminación exitosa --}}
@if(session('eliminar') == 'ok')
<script>
    Swal.fire(
        '¡Eliminado!',
        'La Auditoría fue eliminada.',
        'success'
    )
</script>
@endif
{{-- Cuadro de dialogo para confirmar la eliminación de la auditoría --}}
<script>
    $('.formu_eliminar').submit(function(e){
        e.preventDefault();
        Swal.fire({
            title: '¿Seguro que desea eliminar la auditoría?',
            text: "¡Una vez eliminada no se podrá recuperar la información!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: '¡Cancelar!',
            confirmButtonText: '¡Si, deseo eliminar el registro!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    });
</script>
@endsection
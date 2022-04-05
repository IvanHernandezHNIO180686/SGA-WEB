@extends('layouts.plantilla')
@section('title','Acuerdos')
@section('content')
{{-- Fomulario para visualizar los acuerdos en general --}}
<div class="contenedorTabla">
    @livewire('acuerdo.show-acuerdo')
</div>

@endsection

{{-- Sección de codigo java scrip donde se ven las notificaciones utilizando sweet alert --}}
@section('js')
{{-- Notificación de cambios guardados --}}
@if (session('editar') == 'ok')
<script>
    Swal.fire(
            '¡Cambios guardados!',
            'El acuerdo fue editado de manera exitosa.',
            'success'
        )
</script>
@endif
{{-- Notificación de eliminación exitosa --}}
@if(session('eliminar') == 'ok')
<script>
    Swal.fire(
            '¡Borrado!',
            'El registro ha sido eliminado exitosamente.',
            'success'
        )
</script>
@endif
{{-- Cuadro de dialogo para confirmar la eliminación de acuerdo --}}
<script>
    $('.formu_eliminar').submit(function(e){
        e.preventDefault();
        Swal.fire({
                title: '¿Estas seguro?',
                text: "¡Una vez eliminado el comité no se podrá recuperar la información!",
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
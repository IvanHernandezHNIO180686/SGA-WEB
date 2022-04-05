@extends('layouts.plantilla')
@section('title','Asignar Usuario')
@section('content')
<h1>Asignar Usuarios al comité {{$comite->NombreComite}}</h1>
{{-- Tabla que contiene a los usuarios registrados dentro del sistema y que pueden ser asignados al comité --}}
<div class="contenedorTabla">
    @livewire('comite.agregar-usuario',['comite'=>$comite])
</div>
@endsection

{{-- Sección de codigo java scrip donde se ven las notificaciones utilizando sweet alert --}}
@section('js')
{{-- Notificación de error de asignación --}}
@if (session('error')=='ok')
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '¡El usuario ya se encuentra integrado a este comite!',
    })
</script>
@endif

{{-- Notificación de registro exitoso del comité --}}
@if (session('crear') == 'ok')
<script>
    Swal.fire(
        '¡Datos guardados!',
        'El comite fue creado de manera exitosa, por favor seleccione los integrantes',
        'success'
    )
</script>
@endif

{{-- Notificación de asignación exitosa --}}
@if (session('asignar') == 'ok')
<script>
    Swal.fire(
        '¡Ingresado!',
        'El usuario fue ingresado en el comite de manera exitosa',
        'success'
    )
</script>
@endif
@endsection
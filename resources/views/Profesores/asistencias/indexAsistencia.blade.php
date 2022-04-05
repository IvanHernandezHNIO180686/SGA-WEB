{{-- Imporatación del layout --}}
@extends('layouts.app')
{{-- Contenido --}}
@section('content')
<h1>Asistencias</h1>
<div class="contenedorTabla">
{{-- Tabla de asistencia  --}}
@if($asistencias->count())
<table class="table table-dark table-hover">
    <thead>
        <tr>
            <th>Profesor</th>
            <th>Nombre de la Reunion</th>
            <th>Auditoria</th>
            <th>Fecha de la reunion</th>
            <th>Hora de Inicio</th>
            <th>Hora de Termino</th>
            <th>Pase de Lista</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($asistencias as $asistencia)
        <tr>
            <td>{{$usuario->Nombres.' '.$usuario->ApellidoPaterno}}</td>
            <td scope="row">{{$asistencia->reunione->NombreReunion}}</td>
            <td>
                @foreach ($auditorias as $auditoria)
                    @if ($auditoria->id == $asistencia->reunione->auditoria_id)
                        {{$auditoria->SiglasAuditoria}}
                    @endif
                @endforeach

            </td>
            <td>{{$asistencia->reunione->FechaReunion}}</td>
            <td>{{$asistencia->reunione->HoraInicio}}</td>
            <td>{{$asistencia->reunione->HoraTermino}}</td>
            <td>{{$asistencia->Estatus}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
{{-- Mensaje de vacío --}}
    <h4>Usted no ha asistido a ninguna reunión aún</h4>
@endif
{{-- Grafíca de las reuniones --}}
<div class="row col-6 grafica">

    <figure class="highcharts-figure">
        <div id="container"></div>
        <p class="highcharts-description">
            Como profesor usted tiene varias auditorías por ello, esta grafica ayuda a saber
            que auditoría a tenido mas reuniones, muestra las siglas de la misma y el porcentaje
            de reuniones que ha tenido.
        </p>
    </figure>

</div>

</div>

@endsection

{{-- Sección de Java Script --}}
@section('js')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

{{-- Función que permité crear la grafíca --}}
<script>
Highcharts.chart('container', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Porcentaje de reuniones por auditoría'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
      }
    }
  },
  series: [{
    name: 'Brands',
    colorByPoint: true,
    data: <?= $data ?>

  }]
});

</script>

// Notificación de error
@if (session('error')=='ok')
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '¡Ya ingreso su disponibilidad de tiempo!',
        })
    </script>
@endif

// Notificación de toma de asistencia
@if (session('asistencia') == 'ok')
    <script>
        Swal.fire(
            '¡Asistencia Tomada!',
            'Tu asistencia a esta reunión fue tomada correctamente.',
            'success'
        )
    </script>
@endif

// Notificación de confirmación de asistencia
@if (session('confirmacion') == 'ok')
    <script>
        Swal.fire(
            '¡Confirmación de asistencia!',
            'Su disponibilidad de horario fue ingresada correctamente',
            'success'
        )
    </script>
@endif
@endsection

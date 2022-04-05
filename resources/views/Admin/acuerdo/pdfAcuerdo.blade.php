<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Estilos css del reporte de acuerdo --}}
    <style>
        h1 {
            font-family: adobe caslon pro;
            text-align: center;
        }

        .contenedorDatos {
            width: 70%;
            margin: auto;
            padding: 5px 35px;
            padding-top: 1rem;
            margin-top: 30px;
            padding-bottom: 30px;
            border-radius: 3px;
            border: solid black;
        }

        .contenedorDatos .datos-label {
            display: block;
            color: rgb(79, 31, 145);
            font-size: 16px;
            position: relative;
            margin-top: 20px;
        }

        .contenedorDatos .datos-input {
            display: block;
            background-color: rgb(251, 176, 52);
            border: none;
            outline: none;
            border-bottom: 2px solid rgb(79, 31, 145);
            width: 90%;
            padding: 12px;
            border-radius: 2px;
            font-size: 14px;
        }
    </style>
    <title>Reporte PDF de Acuerdo</title>
</head>

<body>
    {{-- Logo --}}
    <img src="{{ public_path($logo->ruta) }}" width="200px">
{{-- Formulario del reporte de acuerdo llenado de manera automatica donde no se puede modificar ningun campo --}}
    <h1>Reporte del acuerdo {{$acuerdo->NumeroAcuerdo}}</h1>
    <div class="contenedorDatos">
        <label class="datos-label">Número de Acuerdo:</label>
        <input class="datos-input" type="text" value="{{$acuerdo->NumeroAcuerdo}}" disabled>
        <label class="datos-label">Auditoría:</label>
        <input class="datos-input" type="text" value="{{$acuerdo->Auditoria}}" disabled>
        <label class="datos-label">Responsable:</label>
        <input class="datos-input" type="text" value="{{$acuerdo->Responsable}}" disabled>
        <label class="datos-label">Comité:</label>
        <input class="datos-input" type="text" value="{{$acuerdo->Comite}}" disabled>
        <label class="datos-label">Fecha de Creación:</label>
        <input class="datos-input" type="text" value="{{$acuerdo->created_at}}" disabled>
        <label class="datos-label">Fecha de Cumplimiento:</label>
        <input class="datos-input" type="text" value="{{$acuerdo->FechaCumplimiento}}" disabled>
        <label class="datos-label">Reunión:</label>
        <input class="datos-input" type="text" value="{{$acuerdo->reunione->NombreReunion}}" disabled>


    </div>
</body>

</html>
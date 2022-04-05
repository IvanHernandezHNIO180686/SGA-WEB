<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}" />

    <!-- Estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

</head>

<body>
    <div class="bodyProfesores">
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light " style="background-color: #fbb034;">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset(" storage/images/UPE_Firma_horiz_roja-01.png") }}" width="125px">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Parte izquierda del nav-->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Parte derecha del nav -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Autenticación de los links -->
                            @guest
                            @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                            </li>
                            @endif

                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                            </li>
                            @endif
                            @else
                            {{-- Menú del Profesor --}}
                            <li class="nav-item">
                                <a style="color: rgb(79, 31, 145);" class="nav-link"
                                    href="{{ route('Asistencia.index') }}">Asistencias</a>
                            </li>
                            <li class="nav-item">
                                <a style="color: rgb(79, 31, 145);" class="nav-link"
                                    href="{{ route('Comite.misComites') }}">Mis Comités</a>
                            </li>
                            <li class="nav-item">
                                <a style="color: rgb(79, 31, 145);" class="nav-link"
                                    href="{{ route('Auditoria.misAuditorias') }}">Mis Auditorias</a>
                            </li>
                            <li class="nav-item">
                                <a style="color: rgb(79, 31, 145);" class="nav-link"
                                    href="{{ route('Notificacion.misNotificaciones') }}">Mis Notificaciones</a>
                            </li>
                            <li class="nav-item">
                                <a style="color: rgb(79, 31, 145);" class="nav-link"
                                    href="{{ route('Reunion.reunionesIndividuales') }}">Mis Reuniones</a>
                            </li>
                            <li class="nav-item">
                                <a style="color: rgb(79, 31, 145);" class="nav-link"
                                    href="{{ route('Acuerdo.misAcuerdos') }}">Mis Acuerdos</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a style="color: rgb(79, 31, 145);" id="navbarDropdown" class="nav-link dropdown-toggle"
                                    href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" v-pre>
                                    {{ Auth::user()->Nombres.' '.Auth::user()->ApellidoPaterno }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <div>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                            {{ __('Salir') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                    <div> <a class="dropdown-item" href="{{route('Profesores.MiPerfil')}}">
                                            Mi perfil
                                        </a>
                                    </div>
                            </li>

                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>
        </div>

        <div class="py-4">
            {{-- Script generales --}}
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
            {{-- Scripts particulares --}}
            @yield('js')
        </div>
    </div>
</body>

</html>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>


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



    @livewireStyles
</head>

<body>
    <div class="bodyAdmin">
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light" style="background-color: #4f1f91;">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset(" storage/images/UPE_Firma_horiz_amarilla-01.png") }}" width="125px">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Parte izquierda del nav -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Parte derecha del nav -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Autentificación de links -->

                            {{-- Menú del profesor --}}
                            <li class="nav-item">
                                <a class="nav-link active" style="color: #fbb034;" aria-current="page"
                                    href="{{route('Auditoria.index')}}">Auditorías</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: #fbb034;" href="{{route('Comite.index')}}">Comites</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: #fbb034;"
                                    href="{{route('User.index')}}">Profesores</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: #fbb034;"
                                    href="{{route('Reunion.index')}}">Reuniones</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: #fbb034;"
                                    href="{{route('Acuerdo.index')}}">Acuerdos</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" style="color: #fbb034;" href="#"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    {{ Auth::user()->Nombres }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <div>
                                        {{-- Boton para cerrar sesión --}}
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                            {{ __('Salir') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                    <div> <a class="dropdown-item" href="{{route('Admin.MiPerfil')}}">
                                            Mi perfil
                                        </a>
                                    </div>
                                </div>

                            </li>

                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>
        </div>

        <div class="py-4">
            {{-- Scripts generales --}}
            @livewireScripts
            <script src="{{ asset('js/ValidacionesCrear.js') }}"></script>
            <script src="{{ asset('js/MetodosEntradas.js') }}"></script>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
            {{-- Scripts particulares --}}
            @yield('js')
        </div>


    </div>
</body>

</html>

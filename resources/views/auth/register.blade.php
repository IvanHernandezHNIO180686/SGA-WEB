{{-- Importación de layout --}}
@extends('layouts.app')
{{-- Área del contenido --}}
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registrp') }}</div>

                    <div class="card-body">
                        <form name="FnuevoUsuario" method="POST" action="{{ route('register') }}">
                            @csrf
                            {{-- Nombres --}}
                            <div class="form-group row">
                                <label for="Nombres"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nombres:') }}</label>

                                <div class="col-md-6">
                                    <input id="Nombres" type="text"
                                        class="form-control @error('Nombres') is-invalid @enderror" name="Nombres"
                                        value="{{ old('Nombres') }}" required autocomplete="Nombres" autofocus
                                        onchange="FnuevoUsuario.Nombres.value=FnuevoUsuario.Nombres.value.toUpperCase();">
                                    {{-- Error --}}
                                    @error('Nombres')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Apellido Paterno --}}
                            <div class="form-group row">
                                <label for="ApellidoPaterno"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Apellido Paterno:') }}</label>

                                <div class="col-md-6">
                                    <input id="ApellidoPaterno" type="text"
                                        class="form-control @error('ApellidoPaterno') is-invalid @enderror" name="ApellidoPaterno"
                                        value="{{ old('ApellidoPaterno') }}" required autocompletApellidoPaterno" autofocus
                                        onchange="FnuevoUsuario.ApellidoPaterno.value=FnuevoUsuario.ApellidoPaterno.value.toUpperCase();">
                                    {{-- Error --}}
                                    @error('ApellidoPaterno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Apellido Materno --}}
                            <div class="form-group row">
                                <label for="ApellidoMaterno"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Apellido Materno:') }}</label>

                                <div class="col-md-6">
                                    <input id="ApellidoMaterno" type="text" onkeypress="return soloLetras(event)"
                                        class="form-control @error('ApellidoMaterno') is-invalid @enderror" name="ApellidoMaterno"
                                        value="{{ old('ApellidoMaterno') }}" autocompletApellidoMaterno" autofocus
                                        onchange="FnuevoUsuario.ApellidoMaterno.value=FnuevoUsuario.ApellidoMaterno.value.toUpperCase();">
                                    {{-- Error --}}
                                    @error('ApellidoMaterno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Puesto --}}
                            <div class="form-group row">
                                <label for="Puesto"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Puesto:') }}</label>

                                <div class="col-md-6">
                                    <input id="Puesto" type="text"
                                        class="form-control @error('Puesto') is-invalid @enderror" name="Puesto"
                                        value="{{ old('Puesto') }}" required autocompletPuesto" autofocus
                                        onchange="FnuevoUsuario.Puesto.value=FnuevoUsuario.Puesto.value.toUpperCase();">
                                    {{-- Error --}}
                                    @error('Puesto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Correo --}}
                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Correo Institucional:') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">
                                    {{-- Error --}}
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Contraseña --}}
                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Contraseña:') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">
                                    {{-- Error --}}
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Confirmacion de Contraseña --}}
                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña:') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrarme') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- Área de java script --}}
@section('js')

    <script src="{{ asset('js/MetodosEntradas.js') }}"></script>

@endsection

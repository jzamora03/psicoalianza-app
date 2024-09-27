@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sección izquierda con imagen y texto -->
        <div class="col-md-6 d-none d-md-block left-section">
            <div class="overlay text-white d-flex flex-column justify-content-center align-items-start h-100">
            <h1 class="title">
                    Bienvenido a la mejor plataforma <br> <span style="font-weight: 700;">organizacional online</span>
                </h1>
                <p class="subtitle">Gestión efectiva del talento humano</p>
            </div>
        </div>

        <!-- Sección derecha con formulario -->
        <div class="col-md-6 d-flex justify-content-center align-items-center right-section">
            <div class="login-form w-75">
                <div class="text-center mb-4">
                    <img src="/images/logo-color-psicoalianza-pruebas-psicotecnicas.webp" alt="Psico Alianza" width="150">
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="email">{{ __('Usuario') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">{{ __('Contraseña') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3 d-flex justify-content-center">
                        <div>
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">{{ __('Recordar cuenta') }}</label>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary w-100">{{ __('Iniciar sesión') }}</button>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                        <a href="#">¿Olvidaste tu usuario?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

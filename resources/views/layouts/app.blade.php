<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Import de los iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- IMport css login -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- IMport css login -->
    {{-- <link rel="stylesheet" href="{{ asset('css/menu-lateral.css') }}"> --}} 

    <!-- Import css dashboard -->
    {{-- <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet"> --}}

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap JS (necesario para que funcionen los dropdowns) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<!--- Funcion para hacer collapse en el menu lateral -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const toggleBtn = document.getElementById("toggle-btn");
    const sidebar = document.getElementById("sidebar");

    toggleBtn.addEventListener("click", function() {
        sidebar.classList.toggle("collapsed");
        sidebar.classList.toggle("expanded");
    });
});

</script>

<body>
    <div id="app">
    @auth
    
    <div id="sidebar" class="sidebar">
        <div class="sidebar-header">
            <button id="toggle-btn" class="toggle-btn">☰</button>
        </div>
        <ul class="menu-items">
            <li><a href="{{ route('home') }}"><i class="fa fa-home icon"></i><span class="text">Home</span></a></li>
            
            <!-- Menú desplegable -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" id="gestionarMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-folder icon"></i><span class="text">Listas</span>
                </a>
                <ul class="submenu">
                    <li><a href="{{ route('empleados.index') }}"><i class="fa fa-user icon"></i><span class="text">Empleados</span></a></li>
                    <li><a href="{{ route('cargos.index') }}"><i class="fa fa-bolt icon"></i><span class="text">Cargos</span></a></li>
                </ul>
            </li>
        </ul>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container-fluid d-flex justify-content-between">
     
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="images/logo-color-psicoalianza-pruebas-psicotecnicas.webp" alt="Psico Alianza" width="140">
        </a>

        <ul class="navbar-nav ml-auto d-flex align-items-center">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="images/206881.png" alt="User Image" class="rounded-circle" width="40">
                    <div class="d-flex flex-column ml-2 text-left">
                        <span class="font-weight-bold text-dark">Jhoseph Zamora</span>
                        <span class="text-muted small">Administrador</span>
                    </div>
                </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">Perfil</a>
                            
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    Cerrar sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
     </nav>


     @endauth

        <main class="py-4">
            @yield('content')
        </main>
    </div>
  
</body>
</html>

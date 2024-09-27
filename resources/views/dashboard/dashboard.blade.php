@extends('layouts.app')

@section('content')
<div class="container-fluid">
   
    <div class="row">
        <!-- Agrega una clase o identificador para el contenido principal -->
        <div id="content" class="col">
            <div class="text-center mt-5">
                <h2>Bienvenida!</h2>
                <h3>Jhoseph Zamora</h3>
                <p>Añade los datos personales de tus empleados y después agrega su cargo en tu empresa</p>
                <button class="btn btn-outline-primary">
                    <i class="bi bi-person-plus-fill"></i> Empieza aquí
                </button>
            </div>
            {{-- <div class="illustration">
                <img src="images/ilustracion-concepto-windows.png" alt="Illustration" class="img-fluid">
            </div> --}}
        </div>
    </div>
</div>
@endsection

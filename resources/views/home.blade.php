@extends('layouts.app')

@section('content')
<div class="container-fluid main-content">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8 text-center">
            <h2>Bienvenida!</h2>
            <h3>{{ Auth::user()->name }}</h3> <!-- Aquí se muestra el nombre del usuario logueado -->
            <p>Añade los datos personales de tus empleados y después agrega su cargo en tu empresa</p>
            <button class="btn btn-primary mt-4" data-toggle="modal" data-target="#nuevoEmpleadoModal">
                Empieza aquí
            </button>
            <div class="illustration">
                <img src="images/ilustracion-concepto-windows.png" alt="Ilustración" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="nuevoEmpleadoModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Nuevo empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="nuevoEmpleadoForm">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombres" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Escribe el nombre de tu empleado">
                        </div>
                        <div class="col-md-6">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Escribe los apellidos de tu empleado">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="identificacion" class="form-label">Identificación</label>
                            <input type="text" class="form-control" id="identificacion" name="identificacion" placeholder="Escribe un número de identificación">
                        </div>
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Escribe un número de teléfono">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <select class="form-control" id="ciudad" name="ciudad">
                                <option value="">Selecciona una ciudad</option>
                                <option value="ciudad1">Ciudad 1</option>
                                <option value="ciudad2">Ciudad 2</option>
                                <option value="ciudad3">Ciudad 3</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="departamento" class="form-label">Departamento</label>
                            <select class="form-control" id="departamento" name="departamento">
                                <option value="">Selecciona un departamento</option>
                                <option value="departamento1">Departamento 1</option>
                                <option value="departamento2">Departamento 2</option>
                                <option value="departamento3">Departamento 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Escribe la direccion">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarEmpleado()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
   function guardarEmpleado() {
    const formData = new FormData(document.getElementById('nuevoEmpleadoForm'));

    console.log('Datos enviados:');
    for (let [key, value] of formData.entries()) {
        console.log(`${key}: ${value}`);
    }

    fetch("{{ route('empleados.store') }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al guardar empleado');
        }
        return response.json();
    })
    .then(data => {
        $('#nuevoEmpleadoModal').modal('hide');
        alert('Empleado guardado con éxito');
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al guardar empleado');
    });
}
</script>

@endsection

@extends('layouts.app')

@section('content')
<div class="container-fluid main-content">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8 text-center">
            <h2>Bienvenida!</h2>
            <h3>Elisa Gómez</h3>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="nuevoEmpleadoForm">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="nombres">Nombres</label>
                            <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Escribe el nombre de tu empleado">
                        </div>
                        <div class="col-md-6">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Escribe los apellidos de tu empleado">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="identificacion">Identificación</label>
                            <input type="text" class="form-control" id="identificacion" name="identificacion" placeholder="Escribe un número de identificación">
                        </div>
                        <div class="col-md-6">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Escribe un número de teléfono">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="ciudad">Ciudad</label>
                            <select class="form-control" id="ciudad" name="ciudad">
                                <option value="">Selecciona una ciudad</option>
                                <option value="ciudad1">Ciudad 1</option>
                                <option value="ciudad2">Ciudad 2</option>
                                <option value="ciudad3">Ciudad 3</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="departamento">Departamento</label>
                            <select class="form-control" id="departamento" name="departamento">
                                <option value="">Selecciona un departamento</option>
                                <option value="departamento1">Departamento 1</option>
                                <option value="departamento2">Departamento 2</option>
                                <option value="departamento3">Departamento 3</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="telefono">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Escribe la direccion">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarEmpleado()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
   function guardarEmpleado() {
    const formData = new FormData(document.getElementById('nuevoEmpleadoForm'));

    // Ver los datos que se están enviando
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

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <h2 class="fw-bold">Empleados</h2>
        </div>
        <button class="btn btn-outline-primary" onclick="mostrarModalAgregar()">
            <i class="fa fa-user"></i> Agregar
        </button>
    </div>
    
    <div class="table-responsive shadow-sm p-3 mb-5 bg-white rounded">
        <table class="table table-borderless table-hover align-middle">
            <thead class="bg-light text-secondary">
                <tr>
                    <th><input type="checkbox"></th>
                    <th>Nombre</th>
                    <th>Identificación</th>
                    <th>Teléfono</th>
                    <th>Ciudad</th>
                    <th>Departamento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($empleados as $empleado)
                    <tr class="border-bottom">
                        <td><input type="checkbox"></td>
                        <td>{{ $empleado->nombres }} {{ $empleado->apellidos }}</td>
                        <td>{{ $empleado->identificacion }}</td>
                        <td>{{ $empleado->telefono }}</td>
                        <td>{{ $empleado->ciudad }}</td>
                        <td>{{ $empleado->departamento }}</td>
                        <td>
                            <button class="btn btn-sm text-primary" onclick="editarEmpleado({{ $empleado->id }})">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button class="btn btn-sm text-danger" onclick="mostrarModalEliminar({{ $empleado->id }}, '{{ $empleado->nombres }} {{ $empleado->apellidos }}')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <p class="text-muted">Mostrando de {{ $empleados->firstItem() }} a {{ $empleados->lastItem() }} de {{ $empleados->total() }} empleados</p>
        <div>
            {{ $empleados->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

<!-- Modal para editar empleado -->
<div id="editarEmpleadoModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Editar empleado</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editarEmpleadoForm">
                    <input type="hidden" id="empleado_id">
                    <div class="form-group mb-3">
                        <label for="nombres_edit">Nombres</label>
                        <input type="text" id="nombres_edit" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="apellidos_edit">Apellidos</label>
                        <input type="text" id="apellidos_edit" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="identificacion_edit">Identificación</label>
                        <input type="text" id="identificacion_edit" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="telefono_edit">Teléfono</label>
                        <input type="text" id="telefono_edit" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="ciudad_edit">Ciudad</label>
                        <input type="text" id="ciudad_edit" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="departamento_edit">Departamento</label>
                        <input type="text" id="departamento_edit" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarEdicionEmpleado()">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para mostrar modal de agregar empleado
    function mostrarModalAgregar() {
        $('#agregarEmpleadoModal').modal('show');
    }

    // Función para mostrar modal de editar empleado
    function editarEmpleado(id) {
        fetch(`/empleados/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('empleado_id').value = data.id;
                document.getElementById('nombres_edit').value = data.nombres;
                document.getElementById('apellidos_edit').value = data.apellidos;
                document.getElementById('identificacion_edit').value = data.identificacion;
                document.getElementById('telefono_edit').value = data.telefono;
                document.getElementById('ciudad_edit').value = data.ciudad;
                document.getElementById('departamento_edit').value = data.departamento;

                $('#editarEmpleadoModal').modal('show');
            })
            .catch(error => console.error('Error:', error));
    }

    // Función para guardar edición del empleado
    function guardarEdicionEmpleado() {
        const id = document.getElementById('empleado_id').value;
        const url = `/empleados/${id}`;
        const data = {
            nombres: document.getElementById('nombres_edit').value,
            apellidos: document.getElementById('apellidos_edit').value,
            identificacion: document.getElementById('identificacion_edit').value,
            telefono: document.getElementById('telefono_edit').value,
            ciudad: document.getElementById('ciudad_edit').value,
            departamento: document.getElementById('departamento_edit').value,
            _token: '{{ csrf_token() }}'
        };

        fetch(url, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                alert(data.message);
                window.location.reload();
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
@endsection

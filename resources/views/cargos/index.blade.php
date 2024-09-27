@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <a href="#" class="me-3 text-primary"><i class="fa fa-arrow-left"></i></a>
            <h2 class="fw-bold">Cargos</h2>
        </div>
        <div>
            <button class="btn btn-link text-primary me-3"><i class="fa fa-trash"></i> Borrar selección</button>
            <button class="btn btn-link text-primary"><i class="fa fa-download"></i> Descargar datos</button>
        </div>
        <button class="btn btn-outline-primary" onclick="mostrarModalAgregar()">
            <i class="fa fa-briefcase"></i> Agregar
        </button>
    </div>
    
    <div class="table-responsive shadow-sm p-3 mb-5 bg-white rounded">
        <table class="table table-borderless table-hover align-middle">
            <thead class="bg-light text-secondary">
                <tr>
                    <th><input type="checkbox"></th>
                    <th>Nombre</th>
                    <th>Identificación</th>
                    <th>Área</th>
                    <th>Cargo</th>
                    <th>Rol</th>
                    <th>Jefe</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cargos as $cargo)
                    <tr class="border-bottom">
                        <td><input type="checkbox"></td>
                        <td>{{ $cargo->nombre }}{{ $cargo->apellidos }}</td>
                        <td>{{ $cargo->identificacion ?? 'Sin identificacion' }}</td>
                        <td>{{ $cargo->area }}</td>
                        <td>{{ $cargo->cargo }}</td>
                        <td>{{ $cargo->rol }}</td>
                        <td>{{ $cargo->jefe->nombres ?? 'Sin jefe' }}</td>
                        <td>
                            <button class="btn btn-sm text-primary" onclick="editarCargo({{ $cargo->id }})"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-sm text-danger" onclick="mostrarModalEliminar({{ $cargo->id }}, '{{ $cargo->nombre }}')"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <p class="text-muted">Mostrando de {{ $cargos->firstItem() }} a {{ $cargos->lastItem() }} de {{ $cargos->total() }} cargos</p>
        <div>
            {{ $cargos->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

<!-- Modal para agregar cargo -->
<div id="agregarCargoModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Cargo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="agregarCargoForm">
                    <div class="form-group mb-3">
                        <label for="empleado_agregar">Empleado</label>
                        <select id="empleado_agregar" class="form-control">
                            <!-- Aquí se llenarán los empleados disponibles -->
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="identificacion_agregar">Identificación</label>
                        <input type="text" id="identificacion_agregar" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="area_agregar">Área</label>
                        <input type="text" id="area_agregar" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="cargo_agregar">Cargo</label>
                        <input type="text" id="cargo_agregar" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="rol_agregar">Rol</label>
                        <select id="rol_agregar" class="form-control">
                            <option value="Jefe">Jefe</option>
                            <option value="Colaborador">Colaborador</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="jefe_agregar">Jefe</label>
                        <select id="jefe_agregar" class="form-control">
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarNuevoCargo()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para agregar cargo -->
<div id="agregarCargoModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Nuevo Cargo</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="agregarCargoForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="empleado_agregar">Empleado</label>
                            <select id="empleado_agregar" class="form-control">
                                <!-- Aquí se llenarán los empleados disponibles -->
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="identificacion_agregar">Identificación</label>
                            <input type="text" id="identificacion_agregar" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="area_agregar">Área</label>
                            <input type="text" id="area_agregar" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cargo_agregar">Cargo</label>
                            <input type="text" id="cargo_agregar" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="rol_agregar">Rol</label>
                            <select id="rol_agregar" class="form-control">
                                <option value="Jefe">Jefe</option>
                                <option value="Colaborador">Colaborador</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jefe_agregar">Jefe</label>
                            <select id="jefe_agregar" class="form-control">
                                <!-- Aquí se llenarán los empleados disponibles para ser jefe -->
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarNuevoCargo()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar cargo -->
<div id="editarCargoModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Editar Cargo</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editarCargoForm">
                    <input type="hidden" id="cargo_id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre_edit">Nombre</label>
                            <input type="text" id="nombre_edit" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="identificacion_edit">Identificación</label>
                            <input type="text" id="identificacion_edit" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="area_edit">Área</label>
                            <input type="text" id="area_edit" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cargo_edit">Cargo</label>
                            <input type="text" id="cargo_edit" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="rol_edit">Rol</label>
                            <select id="rol_edit" class="form-control">
                                <option value="Jefe">Jefe</option>
                                <option value="Colaborador">Colaborador</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jefe_edit">Jefe</label>
                            <select id="jefe_edit" class="form-control">
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarEdicionCargo()">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para mostrar modal de agregar cargo
    function mostrarModalAgregar() {
        $('#agregarCargoModal').modal('show');
        cargarEmpleadosParaSelect('empleado_agregar');
        cargarEmpleadosParaJefe('jefe_agregar');
    }

    // Función para mostrar modal de editar cargo
    function editarCargo(id) {
        fetch(`/cargos/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('cargo_id').value = data.cargo.id;
                document.getElementById('nombre_edit').value = data.cargo.nombre;
                document.getElementById('identificacion_edit').value = data.cargo.identificacion;
                document.getElementById('area_edit').value = data.cargo.area;
                document.getElementById('cargo_edit').value = data.cargo.cargo;
                document.getElementById('rol_edit').value = data.cargo.rol;
                cargarEmpleadosParaJefe('jefe_edit', data.cargo.jefe_id);

                $('#editarCargoModal').modal('show');
            })
            .catch(error => console.error('Error:', error));
    }

    // Función para guardar edición del cargo
    function guardarEdicionCargo() {
        const id = document.getElementById('cargo_id').value;
        const url = `/cargos/${id}`;
        const data = {
            nombre: document.getElementById('nombre_edit').value,
            identificacion: document.getElementById('identificacion_edit').value,
            area: document.getElementById('area_edit').value,
            cargo: document.getElementById('cargo_edit').value,
            rol: document.getElementById('rol_edit').value,
            jefe_id: document.getElementById('jefe_edit').value,
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

    // Función para guardar nuevo cargo
    function guardarNuevoCargo() {
        const url = '/cargos';
        const empleadoSelect = document.getElementById('empleado_agregar');
        const empleadoNombre = empleadoSelect.options[empleadoSelect.selectedIndex].text;

        const data = {
            nombre: empleadoNombre,
            empleado_id: empleadoSelect.value,
            identificacion: document.getElementById('identificacion_agregar').value,
            area: document.getElementById('area_agregar').value,
            cargo: document.getElementById('cargo_agregar').value,
            rol: document.getElementById('rol_agregar').value,
            jefe_id: document.getElementById('jefe_agregar').value,
            _token: '{{ csrf_token() }}'
        };

        fetch(url, {
            method: 'POST',
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

    // Función para cargar empleados en select
    function cargarEmpleadosParaSelect(selectId, selectedEmpleado = null) {
        fetch('/api/empleados')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById(selectId);
                select.innerHTML = '';
                data.empleados.forEach(empleado => {
                    const option = document.createElement('option');
                    option.value = empleado.id;
                    option.text = `${empleado.nombres} ${empleado.apellidos}`;
                    if (empleado.id === selectedEmpleado) {
                        option.selected = true;
                    }
                    select.add(option);
                });
            })
            .catch(error => console.error('Error:', error));
    }

    // Función para cargar empleados para jefe
    function cargarEmpleadosParaJefe(selectId, selectedJefe = null) {
        fetch('/api/empleados')
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById(selectId);
                select.innerHTML = '';
                data.empleados.forEach(empleado => {
                    const option = document.createElement('option');
                    option.value = empleado.id;
                    option.text = `${empleado.nombres} ${empleado.apellidos}`;
                    if (empleado.id === selectedJefe) {
                        option.selected = true;
                    }
                    select.add(option);
                });
            })
            .catch(error => console.error('Error:', error));
    }
</script>

@endsection

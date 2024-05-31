@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Proyecto: <strong>{{ $proyecto->nombre }}</strong></h1>
        <h3><strong>Estado del proyecto: </strong>{{ $proyecto->estado->nombre }}</h3>
        <h5>Detalle de Materiales, maquinarias, herramientas asociadas a este proyecto</h5>
        <br>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-material"
                    type="button" role="tab" aria-controls="nav-material" aria-selected="true">Materiales</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-maquinaria"
                    type="button" role="tab" aria-controls="nav-maquinaria" aria-selected="false">Maquinarias</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-herramienta"
                    type="button" role="tab" aria-controls="nav-herramienta"
                    aria-selected="false">Herramientas</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-conductor"
                    type="button" role="tab" aria-controls="nav-conductor" aria-selected="false">Conductores</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-material" role="tabpanel" aria-labelledby="nav-material-tab"
                tabindex="0">
                <br>
                <a href="{{ route('agregar_detalle_material', $proyecto->id) }}">
                    <button class="btn btn-primary"><i class="bi bi-plus-square"></i> Agregar material</button>
                </a>
                <a href="{{ route('reporte_materiales_por_proyecto', $proyecto->id) }}">
                    <button class="btn btn-primary"><i class="bi bi-filetype-pdf"></i> Imprimir pdf</button>
                </a>
                <br>
                <br>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre material</th>
                                <th>Cantidad</th>
                                <th>Precio unitario</th>
                                <th>Precio total</th>
                                <th>Accciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proyecto_material as $itemMaterialDetalle)
                                <tr>
                                    <td>{{ $itemMaterialDetalle->materiales->nombre }}</td>
                                    <td>{{ $itemMaterialDetalle->cantidad }}</td>
                                    <td>$ {{ $itemMaterialDetalle->materiales->precio_por_unidad }}</td>
                                    <td>$ {{ $itemMaterialDetalle->valor_total }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modalAddMaterial{{ $itemMaterialDetalle->materiales->id }}">
                                            <i class="bi bi-plus-lg"></i> Agregar
                                        </button>
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#modalSubstractMaterial{{ $itemMaterialDetalle->materiales->id }}">
                                            <i class="bi bi-dash"></i> Quitar
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalDeleteMaterial{{ $itemMaterialDetalle->materiales->id }}">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal add material-->
                                <div class="modal fade" id="modalAddMaterial{{ $itemMaterialDetalle->materiales->id }}"
                                    tabindex="-1" aria-labelledby="modalAddMaterial" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar unidades al
                                                    material</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Material: {{ $itemMaterialDetalle->materiales->nombre }}</p>
                                                <p>Disponible para agregar:
                                                    {{ $itemMaterialDetalle->materiales->cantidad }}</p>

                                                <form
                                                    action="{{ route('guardar_detalle_por_proyecto', ['proyectoId' => $proyecto->id, 'materialId' => $itemMaterialDetalle->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <input type="hidden" name="materialDetalleId"
                                                        value="{{ $itemMaterialDetalle->material_id }}">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="cantidad">Cantidad a aumentar</label>
                                                        <input type="number" step="1" name="cantidad"
                                                            class="form-control" value="{{ old('cantidad') }}"
                                                            min="1"
                                                            max="{{ $itemMaterialDetalle->materiales->cantidad }}"
                                                            required>
                                                    </div>

                                                    <br>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancelar</button>
                                                        <input type="submit" value="Guardar datos" class="btn btn-primary">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal substract material-->
                                <div class="modal fade"
                                    id="modalSubstractMaterial{{ $itemMaterialDetalle->materiales->id }}" tabindex="-1"
                                    aria-labelledby="modalSubstractMaterial" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Quitar unidades al
                                                    material</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Material: {{ $itemMaterialDetalle->materiales->nombre }}</p>
                                                <p>Disponible para quitar:
                                                    {{ $itemMaterialDetalle->cantidad }}</p>

                                                <form
                                                    action="{{ route('quitar_detalle_por_proyecto', ['proyectoId' => $proyecto->id, 'materialId' => $itemMaterialDetalle->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <input type="hidden" name="materialDetalleId"
                                                        value="{{ $itemMaterialDetalle->material_id }}">

                                                    <div class="mb-3">
                                                        <label class="form-label" for="cantidad">Cantidad a quitar</label>
                                                        <input type="number" step="1" name="cantidad"
                                                            class="form-control" value="{{ old('cantidad') }}"
                                                            min="1" max="{{ $itemMaterialDetalle->cantidad }}"
                                                            required>

                                                    </div>

                                                    <br>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancelar</button>
                                                        <input type="submit" value="Quitar unidades de material"
                                                            class="btn btn-primary">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal delete material-->
                                <div class="modal fade"
                                    id="modalDeleteMaterial{{ $itemMaterialDetalle->materiales->id }}" tabindex="-1"
                                    aria-labelledby="modalSubstractMaterial" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar material del
                                                    proyecto</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Material: {{ $itemMaterialDetalle->materiales->nombre }}</p>
                                                <div class="alert alert-warning" role="alert">
                                                    *Al realizar esta accion regresaras la totalidad de materiales asignados
                                                    a este proyecto al registro principal de materiales
                                                </div>

                                                <form
                                                    action="{{ route('eliminar_detalle_por_proyecto', ['proyectoId' => $proyecto->id, 'materialId' => $itemMaterialDetalle->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <input type="hidden" name="materialDetalleId"
                                                        value="{{ $itemMaterialDetalle->material_id }}">

                                                    <br>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancelar</button>
                                                        <input type="submit" value="Eliminar material"
                                                            class="btn btn-danger">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    <h3>Valor total de los materiales para este proyecto: <strong>
                            ${{ $precio_total_materiales }}</strong></h3>
                </div>
            </div>


            <div class="tab-pane fade" id="nav-maquinaria" role="tabpanel" aria-labelledby="nav-maquinaria-tab"
                tabindex="0">
                <br>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#modalAddMaquinaria">
                    <i class="bi bi-plus-square"></i> Agregar maquinaria
                </button>
                <br>
                <br>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre maquinaria</th>
                                <th>Accciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proyecto_maquinaria as $itemProyectoMaquinaria)
                                <tr>
                                    <td>{{ $itemProyectoMaquinaria->maquinarias->nombre }}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalDeleteMaquinaria{{ $itemProyectoMaquinaria->id }}">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>

                                        @if ($itemProyectoMaquinaria->maquinarias->disponible == false)
                                            <form
                                                action="{{ route('retornar_maquinaria_por_proyecto', ['proyectoId' => $proyecto->id, 'maquinariaId' => $itemProyectoMaquinaria->maquinaria_id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')

                                                <input type="submit" value="Retornar maquinaria"
                                                    class="btn btn-success">
                                            </form>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Modal delete maquinaria from project-->
                                <div class="modal fade" id="modalDeleteMaquinaria{{ $itemProyectoMaquinaria->id }}"
                                    tabindex="-1" aria-labelledby="modalDeleteMaquinaria" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Quitar maquinaria del
                                                    proyecto</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Material: {{ $itemProyectoMaquinaria->maquinarias->nombre }}</p>
                                                <div class="alert alert-warning" role="alert">
                                                    *Al realizar esta accion regresaras la maquinaria asignada
                                                    a este proyecto al registro principal de maquinarias con el estado de
                                                    "DISPONIBLE"
                                                </div>
                                                <form
                                                    action="{{ route('eliminar_maquinaria_por_proyecto', ['proyectoId' => $proyecto->id, 'proyectomaquinariaId' => $itemProyectoMaquinaria->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <br>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancelar</button>
                                                        <input type="submit" value="Quitar maquinaria del proyecto"
                                                            class="btn btn-primary">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Modal add maquinaria-->
                <div class="modal fade" id="modalAddMaquinaria" tabindex="-1" aria-labelledby="modalAddMaquinaria"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar maquinaria al
                                    proyecto</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('guardar_maquinaria_por_proyecto', $proyecto->id) }}"
                                    method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="maquinaria">Maquinaria</label>
                                        <select name="maquinaria" class="form-select" required>
                                            <option value="">Seleccione una maquinaria de la lista</option>
                                            @foreach ($maquinarias as $itemMaquinaria)
                                                <option value="{{ $itemMaquinaria->id }}"
                                                    {{ old('maquinaria') == $itemMaquinaria->id ? 'selected' : '' }}>
                                                    {{ $itemMaquinaria->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <input type="submit" value="Agregar al proyecto" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-herramienta" role="tabpanel" aria-labelledby="nav-herramienta-tab"
                tabindex="0">
                <br>
                <a href="{{ route('agregar_detalle_herramientas', $proyecto->id) }}">
                    <button class="btn btn-primary"><i class="bi bi-plus-square"></i> Agregar herramientas</button>
                </a>
                <br>
                <br>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre herramientas</th>
                                <th>Cantidad</th>
                                <th>Cantidad devuelta</th>
                                <th>Accciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proyecto_herramientas as $itemProyectoHerramienta)
                                <tr>
                                    <td>{{ $itemProyectoHerramienta->herramientas->nombre }}</td>
                                    <td>{{ $itemProyectoHerramienta->cantidad }}</td>
                                    <td>{{ $itemProyectoHerramienta->cantidad_devuelta }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modalAddHerramienta{{ $itemProyectoHerramienta->id }}">
                                            <i class="bi bi-plus-lg"></i> Agregar
                                        </button>
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#modalSubstractHerramienta{{ $itemProyectoHerramienta->id }}">
                                            <i class="bi bi-dash"></i> Quitar
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalDeleteHerramienta{{ $itemProyectoHerramienta->id }}">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                        @if ($itemProyectoHerramienta->cantidad_devuelta == 0 || $itemProyectoHerramienta->cantidad_devuelta == null)
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#modalRetornarHerramienta{{ $itemProyectoHerramienta->id }}">
                                                <i class="bi bi-arrow-clockwise"></i> Retornar herramientas
                                            </button>
                                        @endif

                                    </td>
                                </tr>

                                <!-- Modal add herramienta-->
                                <div class="modal fade" id="modalAddHerramienta{{ $itemProyectoHerramienta->id }}"
                                    tabindex="-1" aria-labelledby="modalAddHerramienta" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar unidades al
                                                    material</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Herramienta: {{ $itemProyectoHerramienta->herramientas->nombre }}</p>
                                                <p>Disponible para agregar:
                                                    {{ $itemProyectoHerramienta->herramientas->cantidad }}</p>

                                                <form
                                                    action="{{ route('guardar_herramienta_por_proyecto', ['proyectoId' => $proyecto->id, 'herramientaId' => $itemProyectoHerramienta->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-3">
                                                        <label class="form-label" for="cantidad">Cantidad a
                                                            aumentar</label>
                                                        <input type="number" step="1" name="cantidad"
                                                            class="form-control" value="{{ old('cantidad') }}"
                                                            min="1"
                                                            max="{{ $itemProyectoHerramienta->herramientas->cantidad }}"
                                                            required>
                                                    </div>

                                                    <br>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancelar</button>
                                                        <input type="submit" value="Guardar datos"
                                                            class="btn btn-primary">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal substract herramienta-->
                                <div class="modal fade" id="modalSubstractHerramienta{{ $itemProyectoHerramienta->id }}"
                                    tabindex="-1" aria-labelledby="modalSubstractHerramienta" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Quitar unidades de
                                                    herramienta</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Herramienta: {{ $itemProyectoHerramienta->herramientas->nombre }}</p>
                                                <p>Disponible para quitar:
                                                    {{ $itemProyectoHerramienta->cantidad }}</p>

                                                <form
                                                    action="{{ route('quitar_herramienta_por_proyecto', ['proyectoId' => $proyecto->id, 'herramientaId' => $itemProyectoHerramienta->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')


                                                    <div class="mb-3">
                                                        <label class="form-label" for="cantidad">Cantidad a quitar</label>
                                                        <input type="number" step="1" name="cantidad"
                                                            class="form-control" value="{{ old('cantidad') }}"
                                                            min="1" max="{{ $itemProyectoHerramienta->cantidad }}"
                                                            required>

                                                    </div>

                                                    <br>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancelar</button>
                                                        <input type="submit" value="Quitar unidades de herramienta"
                                                            class="btn btn-primary">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal delete herramienta-->
                                <div class="modal fade" id="modalDeleteHerramienta{{ $itemProyectoHerramienta->id }}"
                                    tabindex="-1" aria-labelledby="modalDeleteHerramienta" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar herramienta
                                                    del
                                                    proyecto</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Herramienta: {{ $itemProyectoHerramienta->herramientas->nombre }}</p>
                                                <div class="alert alert-warning" role="alert">
                                                    *Al realizar esta accion regresaras la totalidad de herramientas
                                                    asignadas
                                                    a este proyecto al registro principal de herramientas
                                                </div>

                                                <form
                                                    action="{{ route('eliminar_herramienta_por_proyecto', ['proyectoId' => $proyecto->id, 'herramientaId' => $itemProyectoHerramienta->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <br>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancelar</button>
                                                        <input type="submit" value="Eliminar herramienta"
                                                            class="btn btn-danger">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal retornar herramienta-->
                                <div class="modal fade" id="modalRetornarHerramienta{{ $itemProyectoHerramienta->id }}"
                                    tabindex="-1" aria-labelledby="modalRetornarHerramienta" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Retornar herramientas
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Herramienta: {{ $itemProyectoHerramienta->herramientas->nombre }}</p>
                                                <p>Cantidad maxima a retornar: {{ $itemProyectoHerramienta->cantidad }}</p>
                                                <div class="alert alert-warning" role="alert">
                                                    *Al realizar esta accion retornaras el numero de herramientas ya sea
                                                    total o parcial
                                                    de este proyecto al registro principal de herramientas
                                                </div>

                                                <form
                                                    action="{{ route('retornar_herramienta_por_proyecto', ['proyectoId' => $proyecto->id, 'herramientaId' => $itemProyectoHerramienta->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-3">
                                                        <label class="form-label" for="cantidad">Cantidad a
                                                            retornar</label>
                                                        <input type="number" step="1" name="cantidad"
                                                            class="form-control" value="{{ old('cantidad') }}"
                                                            min="1" max="{{ $itemProyectoHerramienta->cantidad }}"
                                                            required>
                                                    </div>

                                                    <br>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancelar</button>
                                                        <input type="submit" value="Retornar herramienta"
                                                            class="btn btn-success">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-conductor" role="tabpanel" aria-labelledby="nav-conductor-tab"
                tabindex="0">
                <br>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#modalAddConductor">
                    <i class="bi bi-plus-square"></i> Agregar conductor
                </button>
                <br>
                <br>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre conductor</th>
                                <th>Accciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($conductores as $itemConductor)
                                <tr>
                                    <td>{{ $itemConductor->conductores->nombre }}</td>
                                    <td>
                                        <form
                                            action="{{ route('eliminar_conductor_por_proyecto', ['proyectoId' => $proyecto->id, 'proyectoconductorId' => $itemConductor->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')

                                            <input type="submit" value="Eliminar registro" class="btn btn-danger">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Modal add conductor -->
                <div class="modal fade" id="modalAddConductor" tabindex="-1" aria-labelledby="modalAddConductor"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar conductor al
                                    proyecto</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('guardar_conductor_por_proyecto', $proyecto->id) }}"
                                    method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="conductor">Conductor</label>
                                        <select name="conductor" class="form-select" required>
                                            <option value="">Seleccione un conductor de la lista</option>
                                            @foreach ($conductoresSelect as $itemConductor)
                                                <option value="{{ $itemConductor->id }}"
                                                    {{ old('conductor') == $itemConductor->id ? 'selected' : '' }}>
                                                    {{ $itemConductor->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <input type="submit" value="Agregar al proyecto" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

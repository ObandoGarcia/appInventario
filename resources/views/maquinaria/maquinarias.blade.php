@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Maquinarias</h1>
        <a href="{{ route('crear_maquinaria') }}"><button class="btn btn-primary">Agregar maquinaria</button></a>
        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Disponible</th>
                        <th>Creado/Modificado por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($maquinarias as $itemMaquinaria)
                        <tr>
                            <td>{{ $itemMaquinaria->nombre }}</td>
                            <td>{{ $itemMaquinaria->descripcion }}</td>
                            <td>@if ($itemMaquinaria->disponible == true)
                                <span class="badge text-bg-success">Disponible</span>
                                @else
                                <span class="badge text-bg-danger">No disponible</span>
                                @endif
                            </td>
                            <td>{{ $itemMaquinaria->usuarios->name }}</td>
                            <td>
                                <a href="{{ route('ver_maquinaria', $itemMaquinaria->id) }}">
                                    <button class="btn btn-info">Ver detalles</button>
                                </a>
                                <a href="{{ route('editar_maquinaria', $itemMaquinaria->id) }}">
                                    <button class="btn btn-warning">Editar</button>
                                </a>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUpdateDisponible{{ $itemMaquinaria->id }}">Cambiar disponible</button>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="modalUpdateDisponible{{ $itemMaquinaria->id }}" tabindex="-1" aria-labelledby="modalUpdateDisponible"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar el estado la maquinaria</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('actualizar_maquinaria_disponible', $itemMaquinaria->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <label for="">Estado actual: </label>
                                            @if ($itemMaquinaria->disponible)
                                                <span class="badge text-bg-success">Disponible</span><br>
                                            @else
                                                <span class="badge text-bg-danger">No disponible</span><br>
                                            @endif

                                            <label for="">Esta disponible?</label>
                                            <br>
                                            <select name="disponible" id="" class="form-select">
                                                <option value="1">Disponible</option>
                                                <option value="2">No disponible</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <input type="submit" class="btn btn-primary" value="Cambiar estado">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
            {{ $maquinarias->links() }}
        </div>
    </div>
@endsection

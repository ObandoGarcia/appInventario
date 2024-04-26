@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Proyectos</h1>
        <a href="{{ route('crear_proyecto') }}"><button class="btn btn-primary">Agregar encargado de proyecto</button></a>
        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Ubicacion</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de finalizacion</th>
                        <th>Encargado</th>
                        <th>Estado</th>
                        <th>Creado/Modificado por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proyectos as $itemProyecto)
                        <tr>
                            <td>{{ $itemProyecto->nombre }}</td>
                            <td>{{ $itemProyecto->ubicacion }}</td>
                            <td>{{ $itemProyecto->fecha_de_incio}}</td>
                            <td>{{ $itemProyecto->fecha_de_finalizacion }}</td>
                            <td>{{ $itemProyecto->encargados->nombre }}</td>
                            <td>{{ $itemProyecto->estado->nombre }}</td>
                            <td>{{ $itemProyecto->usuario->name }}</td>
                            <td>
                                <a href="{{ route('editar_proyecto', $itemProyecto->id) }}">
                                    <button class="btn btn-warning">Editar</button>
                                </a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteProyecto{{ $itemProyecto->id }}">Eliminar</button>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="modalDeleteProyecto{{ $itemProyecto->id }}" tabindex="-1" aria-labelledby="modalDeleteProyecto"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Estas seguro de eliminar este registro?</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('eliminar_encargado', $itemProyecto->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            <label for="">Nombre</label>
                                            <input type="text" class="form-control" value="{{ $itemProyecto->nombre }}" readonly>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <input type="submit" class="btn btn-primary" value="Eliminar registro">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
            {{ $proyectos->links() }}
        </div>
    </div>
@endsection

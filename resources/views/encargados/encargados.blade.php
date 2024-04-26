@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Encardos de proyectos</h1>
        <a href="{{ route('crear_encargado') }}"><button class="btn btn-primary">Agregar encargado de proyecto</button></a>
        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>Estado</th>
                        <th>Creado/Modificado por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($encargados as $itemEncargado)
                        <tr>
                            <td>{{ $itemEncargado->nombre }}</td>
                            <td>{{ $itemEncargado->email }}</td>
                            <td>{{ $itemEncargado->telefono }}</td>
                            <td>{{ $itemEncargado->estados->nombre }}</td>
                            <td>{{ $itemEncargado->usuario->name }}</td>
                            <td>
                                <a href="{{ route('editar_encargado', $itemEncargado->id) }}">
                                    <button class="btn btn-warning">Editar</button>
                                </a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteEncargado{{ $itemEncargado->id }}">Eliminar</button>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="modalDeleteEncargado{{ $itemEncargado->id }}" tabindex="-1" aria-labelledby="modalDeleteEncargado"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Estas seguro de eliminar este registro?</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('eliminar_encargado', $itemEncargado->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            <label for="">Nombre</label>
                                            <input type="text" class="form-control" value="{{ $itemEncargado->nombre }}" readonly>
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
            {{ $encargados->links() }}
        </div>
    </div>
@endsection

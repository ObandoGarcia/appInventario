@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Marcas</h1>
        <a href="{{ route('crear_marca') }}"><button class="btn btn-primary">Agregar marca</button></a>
        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Creado/Modificado por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($marcas as $itemMarca)
                        <tr>
                            <td>{{ $itemMarca->nombre }}</td>
                            <td>{{ $itemMarca->usuario->name }}</td>
                            <td>
                                <a href="{{ route('editar_marca', $itemMarca->id) }}">
                                    <button class="btn btn-warning">Editar</button>
                                </a>
                                @role('administrador')
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteMarca{{ $itemMarca->id }}">Eliminar</button>
                                @endrole
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="modalDeleteMarca{{ $itemMarca->id }}" tabindex="-1" aria-labelledby="modalDeleteMarca"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Estas seguro de eliminar este registro?</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('eliminar_marca', $itemMarca->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                                <div>
                                                    Si continuas la informacion del registro no se podra recuperar de ninguna manera
                                                </div>
                                            </div>
                                            <label for="">Nombre</label>
                                            <input type="text" class="form-control" value="{{ $itemMarca->nombre }}" readonly>
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
            {{ $marcas->links() }}
        </div>
    </div>
@endsection

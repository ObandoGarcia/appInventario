@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Proveedores</h1>
        <a href="{{ route('crear_proveedor') }}"><button class="btn btn-primary">Agregar proveedor</button></a>
        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Creado/Modificado por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proveedores as $itemProveedor)
                        <tr>
                            <td>{{ $itemProveedor->nombre }}</td>
                            <td>{{ $itemProveedor->telefono }}</td>
                            <td>{{ $itemProveedor->email }}</td>
                            <td>{{ $itemProveedor->usuario->name }}</td>
                            <td>
                                <a href="{{ route('editar_proveedor', $itemProveedor->id) }}">
                                    <button class="btn btn-warning">Editar</button>
                                </a>
                                @role('administrador')
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteProveedor{{ $itemProveedor->id }}">Eliminar</button>
                                @endrole
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="modalDeleteProveedor{{ $itemProveedor->id }}" tabindex="-1" aria-labelledby="modalDeleteProveedor"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Estas seguro de eliminar este registro?</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('eliminar_proveedor', $itemProveedor->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                                <div>
                                                    Si continuas la informacion del registro no se podra recuperar de ninguna manera
                                                </div>
                                            </div>
                                            <label for="">Nombre</label>
                                            <input type="text" class="form-control" value="{{ $itemProveedor->nombre }}" readonly>
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
            {{ $proveedores->links() }}
        </div>
    </div>
@endsection

@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Usuarios</h1>
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $itemUsuario)
                        <tr>
                            <td>{{ $itemUsuario->name }}</td>
                            <td>{{ $itemUsuario->email }}</td>
                            <td>
                                @role('administrador')
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditUser{{ $itemUsuario->id }}">Editar</button>
                                @endrole
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="modalEditUser{{ $itemUsuario->id }}" tabindex="-1" aria-labelledby="modalDeleteMarca"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar registro de usuario</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="" method="POST">
                                        @csrf

                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label class="form-label" for="name">Nombre</label>
                                                <input type="text" name="name" class="form-control" value="{{ $itemUsuario->name }}">
                                                @error('name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="email">Correo electronico</label>
                                                <input type="email" name="name" class="form-control" value="{{ $itemUsuario->email }}">
                                                @error('email')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <input type="submit" class="btn btn-primary" value="Editar usuario">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
            {{ $usuarios->links() }}
        </div>
    </div>
@endsection

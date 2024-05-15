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
                                <p>
                                    ¡No hay acciones disponibles!
                                </p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $usuarios->links() }}
        </div>
    </div>
@endsection

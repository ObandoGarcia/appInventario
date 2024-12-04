@extends('dashboard')

@section('dinamic-content')
    <div class="container">
        @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible">
            {{Session::get('error')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <br>
        <h1>Editoriales de libros</h1>
        <a href="{{ route('create_editorial') }}"><button class="btn btn-primary"><i class="bi bi-plus-circle"></i> Agregar editorial</button></a>
        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Creado/Modificado por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($editorials as $itemEditorial)
                        <tr>
                            <td>{{ $itemEditorial->name }}</td>
                            <td>{{ $itemEditorial->phone }}</td>
                            <td>{{ $itemEditorial->users->name }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('edit_editorial', $itemEditorial->id) }}">
                                        <button class="btn btn-warning"><i class="bi bi-pencil-square"></i> Editar</button>
                                    </a>
                                    @role('administrador')
                                        <a href="{{ route('show_editorial', $itemEditorial->id) }}">
                                            <button class="btn btn-danger"><i class="bi bi-trash"></i> Eliminar</button>
                                        </a>
                                    @endrole
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $editorials->links() }}
        </div>
    </div>
@endsection

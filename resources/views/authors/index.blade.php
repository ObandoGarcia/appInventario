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
        <h1>Autores de libros</h1>
        <a href="{{ route('create_author') }}"><button class="btn btn-primary">Agregar autor</button></a>
        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Nacionalidad</th>
                        <th>Creado/Modificado por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($authors as $authorItem)
                        <tr>
                            <td>{{ $authorItem->firstname }}</td>
                            <td>{{ $authorItem->lastname }}</td>
                            <td>{{ $authorItem->nationality }}</td>
                            <td>{{ $authorItem->users->name }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('edit_author', $authorItem->id) }}">
                                        <button class="btn btn-warning"><i class="bi bi-pencil-square"></i> Editar</button>
                                    </a>
                                    <a href="{{ route('show_author', $authorItem->id) }}">
                                        <button class="btn btn-danger"><i class="bi bi-trash3-fill"></i> Eliminar</button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

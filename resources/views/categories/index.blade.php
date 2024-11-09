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
        <h1>Categorias de libros</h1>
        <a href="{{ route('create_category') }}"><button class="btn btn-primary"><i class="bi bi-plus-circle"></i> Agregar categoria</button></a>
        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Descripcion</th>
                        <th>Creado/Modificado por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($categories as $itemCategory)
                        <tr>
                            <td>{{ $itemCategory->category }}</td>
                            <td>{{ $itemCategory->description }}</td>
                            <td>{{ $itemCategory->users->name }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('edit_category', $itemCategory->id) }}">
                                        <button class="btn btn-warning"><i class="bi bi-pencil-square"></i> Editar</button>
                                    </a>
                                    <a href="{{ route('show_category', $itemCategory->id) }}">
                                        <button class="btn btn-danger"><i class="bi bi-trash"></i> Eliminar</button>
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

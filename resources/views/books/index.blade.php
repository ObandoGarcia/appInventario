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
        <h1>Libros</h1>
        <a href="{{ route('create_book') }}"><button class="btn btn-primary"><i class="bi bi-plus-circle"></i> Agregar libro</button></a>
        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Imagen</th>
                        <th>Categoria</th>
                        <th>Existencias</th>
                        <th>Disponibles</th>
                        <th>Precio de venta</th>
                        <th>Creado/Modificado por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($books as $bookItem)
                        <tr>
                            <td>{{ $bookItem->title }}</td>
                            <td><img src="{{ asset($bookItem->image_url) }}" alt="Imagen del libro" width="100" height="100"></td>
                            <td>{{ $bookItem->categories->category }}</td>
                            <td>{{ $bookItem->quantity }}</td>
                            <td>{{ $bookItem->available }}</td>
                            <td> $ {{ $bookItem->sale_price }}</td>
                            <td>{{ $bookItem->users->name }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('edit_book', $bookItem->id) }}">
                                        <button class="btn btn-warning"><i class="bi bi-pencil-square"></i> Editar</button>
                                    </a>
                                    <a href="{{ route('show_book', $bookItem->id) }}">
                                        <button class="btn btn-danger"><i class="bi bi-trash3-fill"></i> Eliminar</button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $books->links() }}
        </div>
    </div>
@endsection

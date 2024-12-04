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
        <a href="{{ route('books') }}"><button class="btn btn-primary"> Ver todos los registros</button></a>
        <br>
        <br>
        
        <div>
            <div class="card w-100 mb-3">
                <div class="card-body">
                    <h5 class="card-title">Buscar libro por titulo, isbn, o codigo interno</h5>
                    <form action="{{ route('search_book') }}" method="POST">
                        @csrf

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" placeholder="Busqueda..." name="search" required>
                        </div>

                        <br>
                        <input type="submit" class="btn btn-primary" value="Buscar en la base de datos">
                    </form>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Imagen</th>
                        <th>Categoria</th>
                        <th>Disponibles</th>
                        <th>Precio de venta</th>
                        <th>Fecha de ingreso</th>
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
                            <td>{{ $bookItem->available }}</td>
                            <td> $ {{ $bookItem->sale_price }}</td>
                            <td>{{ $bookItem->entry_date }}</td>
                            <td>{{ $bookItem->users->name }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('edit_book', $bookItem->id) }}">
                                        <button class="btn btn-warning"><i class="bi bi-pencil-square"></i> Editar</button>
                                    </a>
                                    @role('administrador')
                                        <a href="{{ route('show_book', $bookItem->id) }}">
                                            <button class="btn btn-danger"><i class="bi bi-trash3-fill"></i> Eliminar</button>
                                        </a>
                                    @endrole
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

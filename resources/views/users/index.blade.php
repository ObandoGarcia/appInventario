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
        <h1>Usuarios del sistema</h1>
        <a href="{{ route('create_user') }}"><button class="btn btn-primary"><i class="bi bi-plus-circle"></i> Agregar usuario</button></a>
        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($users as $userItem)
                        <tr>
                            <td>{{ $userItem->name }}</td>
                            <td>{{ $userItem->email }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('edit_user', $userItem->id) }}">
                                        <button class="btn btn-warning"><i class="bi bi-pencil-square"></i> Editar</button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links()}}
        </div>
    </div>
@endsection

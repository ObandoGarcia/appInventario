@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Materiales de construccion</h1>
        <a href="{{ route('crear_material') }}"><button class="btn btn-primary">Agregar material</button></a>
        <br>
        <br>
        <div>
            <div class="card w-100 mb-3">
                <div class="card-body">
                    <h5 class="card-title">Buscar material por nombre</h5>
                    <p class="card-text">Ingrese el nombre del material para iniciar la busqueda.</p>
                    <form action="{{ route('buscar_por_nombre') }}" method="POST">
                        @csrf

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" placeholder="Busqueda..." name="buscar" required>
                        </div>

                        <br>
                        <input type="submit" class="btn btn-primary" value="Buscar en la base de datos">
                    </form>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Medida</th>
                        <th>Fecha de ingreso</th>
                        <th>Creado/Modificado por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materiales as $itemMaterial)
                        <tr>
                            <td>{{ $itemMaterial->nombre }}</td>
                            <td>{{ $itemMaterial->cantidad }}</td>
                            <td>{{ $itemMaterial->medida }}</td>
                            <td>{{ $itemMaterial->fecha_de_ingreso }}</td>
                            <td>{{ $itemMaterial->usuario->name }}</td>
                            <td>
                                <a href="{{ route('ver_material', $itemMaterial->id) }}">
                                    <button class="btn btn-info">Ver detalles</button>
                                </a>
                                @role('administrador')
                                    <a href="{{ route('editar_material', $itemMaterial->id) }}">
                                        <button class="btn btn-warning">Editar</button>
                                    </a>
                                @endrole
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $materiales->links() }}
        </div>
    </div>
@endsection

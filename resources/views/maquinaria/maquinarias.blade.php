@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Maquinarias</h1>
        <a href="{{ route('crear_maquinaria') }}"><button class="btn btn-primary">Agregar maquinaria</button></a>
        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Disponible</th>
                        <th>Creado/Modificado por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($maquinarias as $itemMaquinaria)
                        <tr>
                            <td>{{ $itemMaquinaria->nombre }}</td>
                            <td>{{ $itemMaquinaria->descripcion }}</td>
                            <td>@if ($itemMaquinaria->disponible == true)
                                <span class="badge text-bg-success">Disponible</span>
                                @else
                                <span class="badge text-bg-danger">No disponible - en proyecto</span>
                                @endif
                            </td>
                            <td>{{ $itemMaquinaria->usuarios->name }}</td>
                            <td>
                                <a href="{{ route('ver_maquinaria', $itemMaquinaria->id) }}">
                                    <button class="btn btn-info">Ver detalles</button>
                                </a>
                                <a href="{{ route('editar_maquinaria', $itemMaquinaria->id) }}">
                                    <button class="btn btn-warning">Editar</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $maquinarias->links() }}
        </div>
    </div>
@endsection

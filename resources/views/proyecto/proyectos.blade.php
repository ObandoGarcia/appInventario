@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Proyectos</h1>
        <a href="{{ route('crear_proyecto') }}"><button class="btn btn-primary">Agregar encargado de proyecto</button></a>
        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Ubicacion</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de finalizacion</th>
                        <th>Encargado</th>
                        <th>Estado</th>
                        <th>Creado/Modificado por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proyectos as $itemProyecto)
                        <tr>
                            <td>{{ $itemProyecto->nombre }}</td>
                            <td>{{ $itemProyecto->ubicacion }}</td>
                            <td>{{ $itemProyecto->fecha_de_incio}}</td>
                            <td>{{ $itemProyecto->fecha_de_finalizacion }}</td>
                            <td>{{ $itemProyecto->encargados->nombre }}</td>
                            <td>
                                @if ($itemProyecto->estado->nombre == 'activo')
                                    <span class="badge text-bg-primary">{{ $itemProyecto->estado->nombre }}</span>
                                @elseif ($itemProyecto->estado->nombre == 'inactivo')
                                    <span class="badge text-bg-danger">{{ $itemProyecto->estado->nombre }}</span>
                                @elseif ($itemProyecto->estado->nombre == 'completado')
                                    <span class="badge text-bg-success">{{ $itemProyecto->estado->nombre }}</span>
                                @else
                                    <span class="badge text-bg-secondary">{{ $itemProyecto->estado->nombre }}</span>
                                @endif

                            </td>
                            <td>{{ $itemProyecto->usuario->name }}</td>
                            <td>
                                <a href="{{ route('editar_proyecto', $itemProyecto->id) }}">
                                    <button class="btn btn-warning">Editar</button>
                                </a>
                                <a href="{{ route('detalle_proyecto', $itemProyecto->id) }}">
                                    <button class="btn btn-info">Crear detalle</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $proyectos->links() }}
        </div>
    </div>
@endsection

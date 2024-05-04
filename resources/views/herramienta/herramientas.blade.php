@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Herramientas</h1>
        <a href="{{ route('crear_herramienta') }}"><button class="btn btn-primary">Agregar herramienta</button></a>
        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Descripcion</th>
                        <th>Marca</th>
                        <th>Estado</th>
                        <th>Proveedor</th>
                        <th>Creado/Modificado por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($herramientas as $itemHerramienta)
                        <tr>
                            <td>{{ $itemHerramienta->nombre }}</td>
                            <td>{{ $itemHerramienta->cantidad }}</td>
                            <td>{{ $itemHerramienta->descripcion }}</td>
                            <td>{{ $itemHerramienta->marcas->nombre }}</td>
                            <td>{{ $itemHerramienta->estados->nombre }}</td>
                            <td>{{ $itemHerramienta->proveedores->nombre }}</td>
                            <td>{{ $itemHerramienta->usuarios->name }}</td>
                            <td>
                                <a href="{{ route('editar_herramienta', $itemHerramienta->id) }}">
                                    <button class="btn btn-warning">Editar</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $herramientas->links() }}
        </div>
    </div>
@endsection

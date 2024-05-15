@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Materiales de construccion</h1>
        <a href="{{ route('crear_material') }}"><button class="btn btn-primary">Agregar material</button></a>
        <br>
        <br>
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
                                <a href="{{ route('editar_material', $itemMaterial->id) }}">
                                    <button class="btn btn-warning">Editar</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $materiales->links() }}
        </div>
    </div>
@endsection

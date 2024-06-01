@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Boletas de combustible</h1>
        <a href="{{ route('crear_boleta') }}"><button class="btn btn-primary">Agregar boleta</button></a>
        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Conductor</th>
                        <th>Fecha</th>
                        <th>Proyecto</th>
                        <th>Creado/Modificado por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($boletas as $itemBoleta)
                        <tr>
                            <td>{{ $itemBoleta->conductor->nombre}}</td>
                            <td>{{ $itemBoleta->fecha }}</td>
                            <td>{{ $itemBoleta->proyecto->nombre }}</td>
                            <td>{{ $itemBoleta->usuarios->name }}</td>
                            <td>
                                <a href="{{ route('ver_boleta', $itemBoleta->id) }}">
                                    <button class="btn btn-info">Ver detalles</button>
                                </a>
                                @role('administrador')
                                <a href="{{ route('editar_boleta', $itemBoleta->id) }}">
                                    <button class="btn btn-warning">Editar</button>
                                </a>
                                @endrole
                                <a href="{{ route('reporte_combustible', $itemBoleta->id) }}">
                                    <button class="btn btn-primary"><i class="bi bi-filetype-pdf"></i> Imprimir pdf</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $boletas->links() }}
        </div>
    </div>
@endsection

@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Conductores</h1>
        <a href="{{ route('crear_conductor') }}"><button class="btn btn-primary">Agregar motorista</button></a>
        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>DUI</th>
                        <th>Telefono</th>
                        <th>Licencia</th>
                        <th>Estado</th>
                        <th>Creado/Modificado por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($conductores as $itemConductor)
                        <tr>
                            <td>{{ $itemConductor->nombre }}</td>
                            <td>{{ $itemConductor->dui }}</td>
                            <td>{{ $itemConductor->telefono }}</td>
                            <td>{{ $itemConductor->licencia }}</td>
                            <td>@if ($itemConductor->estados->nombre == 'activo')
                                <span class="badge text-bg-primary">activo</span>
                                @else
                                <span class="badge text-bg-danger">inactivo</span>
                                @endif
                            </td>
                            <td>{{ $itemConductor->usuarios->name }}</td>
                            <td>
                                <a href="{{ route('editar_conductor', $itemConductor->id) }}">
                                    <button class="btn btn-warning">Editar</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $conductores->links() }}
        </div>
    </div>
@endsection

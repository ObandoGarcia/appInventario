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
                            <td>{{ $itemMaterial->fecha_de_ingreso }}</td>
                            <td>{{ $itemMaterial->usuario->name }}</td>
                            <td>
                                <a href="{{ route('ver_material', $itemMaterial->id) }}">
                                    <button class="btn btn-info">Ver detalles</button>
                                </a>
                                <a href="{{ route('editar_material', $itemMaterial->id) }}">
                                    <button class="btn btn-warning">Editar</button>
                                </a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteMaterial{{ $itemMaterial->id }}">Eliminar</button>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="modalDeleteMaterial{{ $itemMaterial->id }}" tabindex="-1" aria-labelledby="modalDeleteMaterial"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Estas seguro de eliminar este registro?</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('eliminar_material', $itemMaterial->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            <label for="">Nombre</label>
                                            <input type="text" class="form-control" value="{{ $itemMaterial->nombre }}" readonly>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <input type="submit" class="btn btn-primary" value="Eliminar registro">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
            {{ $materiales->links() }}
        </div>
    </div>
@endsection

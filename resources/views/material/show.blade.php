@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Informacion del material seleccionado</h1>
        <br>
        <br>
        <div class="card">
            <div class="card-header">
                <h1 class="text-center text-uppercase">{{ $material->nombre }}</h1>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered">
                    <thead>
                        <th>Concepto</th>
                        <th>Valor</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Cantidad</td>
                            <td>{{ $material->cantidad }}</td>
                        </tr>
                        <tr>
                            <td>Descripcion</td>
                            <td>{{ $material->descripcion }}</td>
                        </tr>
                        <tr>
                            <td>Fecha de ingreso</td>
                            <td>{{ $material->fecha_de_ingreso }}</td>
                        </tr>
                        <tr>
                            <td>Precio por unidad</td>
                            <td>$ {{ $material->precio_por_unidad }}</td>
                        </tr>
                        <tr>
                            <td>Costo total</td>
                            <td>$ {{ $material->precio_por_unidad * $material->cantidad }}</td>
                        </tr>
                        <tr>
                            <td>Marca</td>
                            <td>{{ $material->marcas->nombre }}</td>
                        </tr>
                        <tr>
                            <td>Estado</td>
                            <td>{{ $material->estados->nombre }}</td>
                        </tr>
                        <tr>
                            <td>Proveedor</td>
                            <td>{{ $material->proveedores->nombre }}</td>
                        </tr>
                        <tr>
                            <td>Actualizado por</td>
                            <td>{{ $material->usuario->name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-body-secondary">
                Ultima actualizacion: {{ $material->updated_at }}
            </div>
        </div>
    </div>
@endsection

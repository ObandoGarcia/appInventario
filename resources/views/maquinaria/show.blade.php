@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Informacion de la maquinaria seleccionada</h1>
        <br>
        <br>
        <div class="card">
            <div class="card-header">
                <h1 class="text-center text-uppercase">{{ $maquinaria->nombre }}</h1>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered">
                    <thead>
                        <th>Concepto</th>
                        <th>Valor</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Vehiculo</td>
                            <td>{{ $maquinaria->vehiculo }}</td>
                        </tr>
                        <tr>
                            <td>Placas</td>
                            <td>{{ $maquinaria->placas }}</td>
                        </tr>
                        <tr>
                            <td>Modelo</td>
                            <td>{{ $maquinaria->modelo }}</td>
                        </tr>
                        <tr>
                            <td>Serie</td>
                            <td>{{ $maquinaria->serie }}</td>
                        </tr>
                        <tr>
                            <td>Fecha de ingreso</td>
                            <td>{{ $maquinaria->fecha_de_ingreso }}</td>
                        </tr>
                        <tr>
                            <td>Dispinible</td>
                            <td>
                                @if ($maquinaria->disponible)
                                    Esta disponible
                                @else
                                    No esta disponible - esta en proyecto en ejecucion
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Marca</td>
                            <td>{{ $maquinaria->marcas->nombre }}</td>
                        </tr>
                        <tr>
                            <td>Estado</td>
                            <td>{{ $maquinaria->estados->nombre }}</td>
                        </tr>
                        <tr>
                            <td>Proveedor</td>
                            <td>{{ $maquinaria->proveedores->nombre }}</td>
                        </tr>
                        <tr>
                            <td>Actualizado por</td>
                            <td>{{ $maquinaria->usuarios->name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-body-secondary">
                Ultima actualizacion: {{ $maquinaria->updated_at }}
            </div>
        </div>
    </div>
@endsection

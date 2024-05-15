@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Informacion de la boleta de combustible seleccionada</h1>
        <br>
        <br>
        <div class="card">
            <div class="card-header">
                <h1 class="text-center text-uppercase">{{ $boleto->proyecto->nombre }}</h1>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered">
                    <thead>
                        <th>Concepto</th>
                        <th>Valor</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Motorista</td>
                            <td>{{ $boleto->conductor->nombre }}</td>
                        </tr>

                        <tr>
                            <td>Maquinaria</td>
                            <td>{{ $boleto->maquinaria->nombre }}</td>
                        </tr>

                        <tr>
                            <td>Cantidad en galones</td>
                            <td>{{ $boleto->cantidad }}</td>
                        </tr>

                        <tr>
                            <td>Descripcion</td>
                            <td>{{ $boleto->descripcion }}</td>
                        </tr>

                        <tr>
                            <td>Recibido por</td>
                            <td>{{ $boleto->recibido_por }}</td>
                        </tr>

                        <tr>
                            <td>Entregado por</td>
                            <td>{{ $boleto->entregado_por }}</td>
                        </tr>

                        <tr>
                            <td>Numero de impresiones de este registro</td>
                            <td>{{ $boleto->numero_de_impresiones }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-body-secondary">
                Ultima actualizacion: {{ $boleto->updated_at }}
            </div>
        </div>
    </div>
@endsection

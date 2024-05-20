@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Proyecto: <strong>{{ $proyecto->nombre }}</strong></h1>
        <h5>Detalle de Materiales, maquinarias, herramientas asociadas a este proyecto</h5>
        <br>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-material" type="button"
                    role="tab" aria-controls="nav-material" aria-selected="true">Materiales</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-maquinaria"
                    type="button" role="tab" aria-controls="nav-maquinaria" aria-selected="false">Maquinarias</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-herramienta"
                    type="button" role="tab" aria-controls="nav-herramienta" aria-selected="false">Herramientas</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-conductor"
                    type="button" role="tab" aria-controls="nav-conductor" aria-selected="false">Conductores</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-material" role="tabpanel" aria-labelledby="nav-material-tab"
                tabindex="0">
                <br>
                <a href="{{ route('agregar_detalle_material', $proyecto->id) }}"><button class="btn btn-primary">Agregar material</button></a>
                <br>
                <br>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre material</th>
                                <th>Cantidad</th>
                                <th>Cantidad devuelta</th>
                                <th>Precio unitario</th>
                                <th>Precio total</th>
                                <th>Procesado</th>
                                <th>Accciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proyecto_material as $itemMaterialDetalle )
                                <tr>
                                    <td>{{ $itemMaterialDetalle->materiales->nombre }}</td>
                                    <td>{{ $itemMaterialDetalle->cantidad }}</td>
                                    <td>{{ $itemMaterialDetalle->cantidad_devuelta }}</td>
                                    <td>{{ $itemMaterialDetalle->materiales->precio_por_unidad }}</td>
                                    <td>{{ $itemMaterialDetalle->valor_total}}</td>
                                    <td>{{ $itemMaterialDetalle->procesado }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-maquinaria" role="tabpanel" aria-labelledby="nav-maquinaria-tab" tabindex="0">
                <br>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre maquinaria</th>
                                <th>Accciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-herramienta" role="tabpanel" aria-labelledby="nav-herramienta-tab" tabindex="0">
                <br>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre herramientas</th>
                                <th>Cantidad</th>
                                <th>Cantidad devuelta</th>
                                <th>Accciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-conductor" role="tabpanel" aria-labelledby="nav-conductor-tab" tabindex="0">
                <br>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre conductor</th>
                                <th>Accciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

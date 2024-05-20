@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Resumen del Sistema</h1>
        <div class="row">
            <div class="col col-sm-4 col-md-2">
                <div class="card border-success mb-3">
                    <div class="card-header">Usuarios</div>
                    <div class="card-body">
                      <p><strong>Usuarios registrados: </strong>  {{ $usuarios }}</p>
                    </div>
                  </div>
            </div>
            <div class="col col-sm-4 col-md-2">
                <div class="card border-success mb-3">
                    <div class="card-header">Proyectos</div>
                    <div class="card-body">
                        <p><strong>Proyectos: </strong>  {{ $proyectos }}</p>
                    </div>
                  </div>
            </div>
            <div class="col col-sm-4 col-md-2">
                <div class="card border-success mb-3">
                    <div class="card-header">Marcas</div>
                    <div class="card-body">
                        <p><strong>Marcas registradas: </strong>  {{ $marcas }}</p>
                    </div>
                  </div>
            </div>
            <div class="col col-sm-4 col-md-2">
                <div class="card border-success mb-3">
                    <div class="card-header">Proveedores</div>
                    <div class="card-body">
                        <p><strong>Proveedores registrados: </strong> {{ $proveedores }}</p>
                    </div>
                  </div>
            </div>
            <div class="col col-sm-4 col-md-2">
                <div class="card border-success mb-3">
                    <div class="card-header">Materiales de construccion</div>
                    <div class="card-body">
                      <p><strong>Materiales registrados: </strong>  {{ $materiales_totales }}</p>
                      <p><strong>Valor total de materiales: </strong>$ {{ $valor_materiales }} </p>
                    </div>
                  </div>
            </div>
            <div class="col col-sm-4 col-md-2">
                <div class="card border-success mb-3">
                    <div class="card-header">Maquinarias</div>
                    <div class="card-body">
                        <p><strong>Maquinarias: </strong>  {{ $maquinarias }}</p>
                    </div>
                  </div>
            </div>
            <div class="col col-sm-4 col-md-2">
                <div class="card border-success mb-3">
                    <div class="card-header">Herramientas</div>
                    <div class="card-body">
                        <p><strong>Total de herramientas: </strong>  {{ $herramientas }}</p>
                    </div>
                  </div>
            </div>
            <div class="col col-sm-4 col-md-2">
                <div class="card border-success mb-3">
                    <div class="card-header">Conductores</div>
                    <div class="card-body">
                        <p><strong>Conductores: </strong>  {{ $conductores }}</p>
                    </div>
                  </div>
            </div>
            <div class="col col-sm-4 col-md-2">
                <div class="card border-success mb-3">
                    <div class="card-header">Boletas de gas</div>
                    <div class="card-body">
                        <p><strong>Vales de combustible: </strong>  {{ $boletos }}</p>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection

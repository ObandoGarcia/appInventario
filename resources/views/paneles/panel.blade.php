@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Resumen del Sistema</h1>
        <div class="row">
            <div class="col col-sm-4 col-md-2">
                <div class="card border-success mb-3">
                    <div class="card-header">Usuarios</div>
                    <div class="card-body">
                      <h5 class="card-title">Usuarios registrados</h5>
                      <p class="text-end">{{ $usuarios }}</p>
                    </div>
                  </div>
            </div>
            <div class="col col-sm-4 col-md-2">
                <div class="card border-success mb-3">
                    <div class="card-header">Proyectos</div>
                    <div class="card-body">
                      <h5 class="card-title">Proyecto activos</h5>
                      <p class="text-end">{{ $proyectos }}</p>
                    </div>
                  </div>
            </div>
            <div class="col col-sm-4 col-md-2">
                <div class="card border-success mb-3">
                    <div class="card-header">Marcas</div>
                    <div class="card-body">
                      <h5 class="card-title">Marcas registradas</h5>
                      <p class="text-end">{{ $marcas }}</p>
                    </div>
                  </div>
            </div>
            <div class="col col-sm-4 col-md-2">
                <div class="card border-success mb-3">
                    <div class="card-header">Proveedores</div>
                    <div class="card-body">
                      <h5 class="card-title">Proveedores registrados</h5>
                      <p class="text-end"></p>
                    </div>
                  </div>
            </div>
            <div class="col col-sm-4 col-md-2">
                <div class="card border-success mb-3">
                    <div class="card-header">Materiales de construccion</div>
                    <div class="card-body">
                      <h5 class="card-title">Materiales registrados</h5>
                      <p class="text-end"></p>
                    </div>
                  </div>
            </div>
            <div class="col col-sm-4 col-md-2">
                <div class="card border-success mb-3">
                    <div class="card-header">Maquinarias</div>
                    <div class="card-body">
                      <h5 class="card-title">Maquinarias registradas</h5>
                      <p class="text-end"></p>
                    </div>
                  </div>
            </div>
            <div class="col col-sm-4 col-md-2">
                <div class="card border-success mb-3">
                    <div class="card-header">Herramientas</div>
                    <div class="card-body">
                      <h5 class="card-title">Total de herramientas</h5>
                      <p class="text-end"></p>
                    </div>
                  </div>
            </div>
            <div class="col col-sm-4 col-md-2">
                <div class="card border-success mb-3">
                    <div class="card-header">Conductores</div>
                    <div class="card-body">
                      <h5 class="card-title">Conductores registrados</h5>
                      <p class="text-end"></p>
                    </div>
                  </div>
            </div>
            <div class="col col-sm-4 col-md-2">
                <div class="card border-success mb-3">
                    <div class="card-header">Boletas de gas</div>
                    <div class="card-body">
                      <h5 class="card-title">Total de boletas creadas</h5>
                      <p class="text-end"></p>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection

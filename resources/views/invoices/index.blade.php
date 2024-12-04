@extends('dashboard')

@section('dinamic-content')
    <div class="container">
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible">
                {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <br>
        <h1>Facturas de ventas</h1>
        <a href="{{ route('create_invoice') }}"><button class="btn btn-primary"><i class="bi bi-plus-circle"></i> Crear
                factura</button></a>
        <a href="{{ route('invoices') }}"><button class="btn btn-primary"> Ver todos los registros</button></a>
        <br>
        <br>

        <div>
            <div class="card w-100 mb-3">
                <div class="card-body">
                    <h5 class="card-title">Buscar factura por numero de factura, codigo interno o fecha de creacion</h5>
                    <form action="{{ route('search_invoice') }}" method="POST">
                        @csrf

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" placeholder="Busqueda..." name="search" required>
                        </div>

                        <br>
                        <input type="submit" class="btn btn-primary" value="Buscar en la base de datos">
                    </form>
                </div>
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Numero de factura</th>
                        <th>Codigo interno</th>
                        <th>Cliente</th>
                        <th>Estado</th>
                        <th>Fecha de creacion</th>
                        <th>Creado/Modificado por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($invoices as $invoiceItem)
                        <tr>
                            <td>{{ $invoiceItem->invoice_number }}</td>
                            <td>{{ $invoiceItem->internal_code }}</td>
                            <td>{{ $invoiceItem->customers->firstname . ' ' . $invoiceItem->customers->lastname }}</td>
                            <td>
                                @if ($invoiceItem->state == 'pendiente de pago')
                                    <span class="badge text-bg-warning"><i class="bi bi-exclamation-lg"></i> Pendiente de
                                        pago</span>
                                @elseif ($invoiceItem->state == 'pagado')
                                    <span class="badge text-bg-success"><i class="bi bi-check-lg"></i></i> Pagado</span>
                                @elseif ($invoiceItem->state == 'anulada')
                                    <span class="badge text-bg-danger"><i class="bi bi-x"></i> Anulada</span>
                                @endif
                            </td>
                            <td>{{ $invoiceItem->created_at }}</td>
                            <td>{{ $invoiceItem->users->name }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    @role('administrador')
                                        @if ($invoiceItem->state != 'anulada')
                                            <a href="{{ route('edit_invoice', $invoiceItem->id) }}">
                                                <button class="btn btn-warning"><i class="bi bi-pencil-square"></i>
                                                    Editar</button>
                                            </a>
                                            <a href="{{ route('cancel_invoice', $invoiceItem->id) }}">
                                                <button class="btn btn-secondary"><i class="bi bi-folder-minus"></i>
                                                    Anular</button>
                                            </a>
                                        @endif
                                    @endrole

                                    <a href="{{ route('invoice_detail', $invoiceItem->id) }}">
                                        <button class="btn btn-info"><i class="bi bi-card-checklist"></i></i>
                                            Procesar</button>
                                    </a>
                                </div>

                                @role('administrador')
                                    <a href="{{ route('show_invoice', $invoiceItem->id) }}">
                                        <button class="btn btn-danger"><i class="bi bi-trash3-fill"></i> Eliminar</button>
                                    </a>
                                @endrole

                                @if ($invoiceItem->state != 'anulada')
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#modalChangeStateToPaid{{ $invoiceItem->id }}">
                                        <i class="bi bi-bag-check-fill"></i> Cambiar estado
                                    </button>
                                @endif

                            </td>
                        </tr>

                        <!-- Modal paid invoice -->
                        <div class="modal fade" id="modalChangeStateToPaid{{ $invoiceItem->id }}" tabindex="-1"
                            aria-labelledby="modalChangeStateToPaid" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar estado de la factura
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('change_state_to_paid', $invoiceItem->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="alert alert-success" role="alert">
                                                <h3>Cambiaras el estado de la factura a "Pagada"</h3>
                                            </div>

                                            <br>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <input type="submit" value="Cambiar estado" class="btn btn-success">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
            {{ $invoices->links() }}
        </div>
    </div>
@endsection

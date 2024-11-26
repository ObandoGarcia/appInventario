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
        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Numero de factura</th>
                        <th>Codigo interno</th>
                        <th>Cliente</th>
                        <th>Estado</th>
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
                                    <span class="badge text-bg-warning"><i class="bi bi-exclamation-lg"></i> Pendiente de pago</span>
                                @elseif ($invoiceItem->state == 'pagado')
                                    <span class="badge text-bg-success"><i class="bi bi-check-lg"></i></i> Pagado</span>
                                @elseif ($invoiceItem->state == 'anulada')
                                    <span class="badge text-bg-danger"><i class="bi bi-x"></i> Anulada</span>
                                @endif
                            </td>
                            <td>{{ $invoiceItem->users->name }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    @if ($invoiceItem->state != 'anulada')
                                        <a href="{{ route('edit_invoice', $invoiceItem->id) }}">
                                            <button class="btn btn-warning"><i class="bi bi-pencil-square"></i> Editar</button>
                                        </a>
                                        <a href="{{ route('cancel_invoice', $invoiceItem->id) }}">
                                            <button class="btn btn-secondary"><i class="bi bi-folder-minus"></i> Anular</button>
                                        </a>
                                    @endif

                                    <a href="{{ route('invoice_detail', $invoiceItem->id) }}">
                                        <button class="btn btn-info"><i class="bi bi-card-checklist"></i></i> Procesar</button>
                                    </a>
                                </div>

                                <a href="{{ route('show_invoice', $invoiceItem->id) }}">
                                    <button class="btn btn-danger"><i class="bi bi-trash3-fill"></i> Eliminar</button>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

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
        <h1>Detalle de factura</h1>
        <h2>Numero de factura: <strong>{{ $invoice->invoice_number }}</strong> </h2>
        <h2>Cliente: <strong>{{ $invoice->customers->firstname . ' ' . $invoice->customers->lastname }}</strong></h2>
        <h2>Estado: <strong>{{ $invoice->state }}</strong></p>
        </h2>
        <br>
        @if ($invoice->state != 'anulada')
            <a href="{{ route('add_book_invoice', $invoice->id) }}"><button class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Agregar libro</button>
            </a>
        @endif

        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Libro</th>
                        <th>Cantidad</th>
                        <th>Precio por unidad</th>
                        <th>Precio total por libro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($invoice_book as $invoice_bookItem)
                        <tr>
                            <td>{{ $invoice_bookItem->books->title }}</td>
                            <td>{{ $invoice_bookItem->quantity }}</td>
                            <td>$ {{ $invoice_bookItem->price }}</td>
                            <td>$ {{ $invoice_bookItem->total_price }}</td>
                            <td>
                                @if ($invoice_bookItem->invoices->state == 'anulada')
                                    <p>Sin acciones disponibles!</p>
                                @else
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalAddBook{{ $invoice_bookItem->id }}">
                                        <i class="bi bi-plus-lg"></i> Agregar
                                    </button>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#modalDecreaseBook{{ $invoice_bookItem->id }}">
                                        <i class="bi bi-dash-lg"></i> Disminuir
                                    </button>
                                    <a href="{{ route('delete_book_invoice', $invoice_bookItem->id) }}">
                                        <button class="btn btn-danger"><i class="bi bi-trash-fill"></i> Quitar de la
                                            factura</button>
                                    </a>
                                @endif
                            </td>
                        </tr>

                        <!-- Modal add book-->
                        <div class="modal fade" id="modalAddBook{{ $invoice_bookItem->id }}" tabindex="-1"
                            aria-labelledby="modalAddBook" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar unidades del libro</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h1>{{ $invoice_bookItem->books->title }}</h1>
                                        <p>Disponible para agregar: {{ $invoice_bookItem->books->available }}</p>

                                        <form action="{{ route('increase_book', $invoice_bookItem->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-3">
                                                <label class="form-label" for="quantity">Cantidad a aumentar</label>
                                                <input type="number" step="1" name="quantity" class="form-control"
                                                    value="{{ old('quantity') }}" min="1"
                                                    max="{{ $invoice_bookItem->books->available }}" required>
                                            </div>

                                            <br>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <input type="submit" value="Guardar datos" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal decrease book-->
                        <div class="modal fade" id="modalDecreaseBook{{ $invoice_bookItem->id }}" tabindex="-1"
                            aria-labelledby="modalDecreaseBook" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Quitar unidades del libro</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h1>{{ $invoice_bookItem->books->title }}</h1>
                                        <p>Maximo para quitar: {{ $invoice_bookItem->available }}</p>

                                        <form action="{{ route('decresase_book', $invoice_bookItem->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-3">
                                                <label class="form-label" for="delquantity">Cantidad a quitar</label>
                                                <input type="number" step="1" name="delquantity" class="form-control"
                                                    value="{{ old('delquantity') }}" min="1"
                                                    max="{{ $invoice_bookItem->quantity }}" required>
                                            </div>

                                            <br>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <input type="submit" value="Guardar datos" class="btn btn-warning">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>

            <button> Generar pdf</button>
        </div>
    </div>
@endsection

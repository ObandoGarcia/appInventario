@extends('dashboard')

@section('dinamic-content')
    <div class="container">
        <h1>¿Estas seguro de anular esta factura?</h1>
        <br>
        <br>

        <div class="alert alert-warning" role="alert">
            <h3>¡Esta accion no se puede deshacer!</h3>
            <h4>Ten en cuenta lo siguiente:</h4>
            <ol>
                <li> - Los libros que han sido agregados al detalle de la factura se regresaran a la tabla de libros.</li>
                <li> - No se podra regresar ni restaurar de ningun modo.</li>
            </ol>
        </div>

        <div class="row">
            <div class="col col-12">
                <form action="{{ route('change_invoice_to_invalid', $invoice->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="invoice_number">Numero de factura</label>
                        <input type="text" name="invoice_number" class="form-control" value="{{ $invoice->invoice_number }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="internal_code">Codigo interno</label>
                        <input type="text" name="internal_code" class="form-control" value="{{ $invoice->internal_code }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="categories">Cliente</label>
                        <input type="text" name="customer" class="form-control" value="{{ $invoice->customers->firstname . " " . $invoice->customers->lastname }}" readonly>
                    </div>

                    <br>
                    <input type="submit" value="Anular factura" class="btn btn-warning">
                </form>
            </div>
        </div>
    </div>
@endsection

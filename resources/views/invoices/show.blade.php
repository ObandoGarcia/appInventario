@extends('dashboard')

@section('dinamic-content')
    <div class="container">
        <h1>¿Estas seguro de eliminar este registro de factura?</h1>
        <br>
        <br>

        <div class="alert alert-danger" role="alert">
            <h3>¡Esta accion no se puede deshacer!</h3>
            <h4>Ten en cuenta lo siguiente:</h4>
            <ol>
                <li> - La informacion relacionada a este registro se eliminara. Incluyendo los libros agregados, los cuales NO se regresaran a la tabla de libros.</li>
                <li> - No se podra regresar ni restaurar de ningun modo.</li>
            </ol>
        </div>

        <div class="row">
            <div class="col col-12">
                <form action="{{ route('delete_invoice', $invoice->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

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
                    @role('administrador')
                        <input type="submit" value="Eliminar registro" class="btn btn-danger">
                    @endrole
                </form>
            </div>
        </div>
    </div>
@endsection
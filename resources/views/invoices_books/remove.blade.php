@extends('dashboard')

@section('dinamic-content')
    <div class="container">
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible">
                {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h1>¿Estas seguro de eliminar este libro del detalle de la factura?</h1>
        <br>
        <br>
        <div class="row">
            <div class="col col-12">
                <form action="{{ route('delete_invoice_book', $invoice_book->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="alert alert-warning" role="alert">
                        <h3>*Al realizar esta accion regresaras la cantidad de libros de este registro a la tabla principal de libros</h3>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="book">Titulo del libro</label>
                        <input type="text" name="book" class="form-control" value="{{ $invoice_book->books->title }}" readonly>
                    </div>

                    <br>
                    <input type="submit" value="Quitar libro" class="btn btn-danger">
                </form>
            </div>
        </div>
    </div>
@endsection
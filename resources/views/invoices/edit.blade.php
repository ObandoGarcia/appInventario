@extends('dashboard')

@section('dinamic-content')
    <div class="container">
        <h1>Editar factura</h1>
        <br>
        <br>
        <div class="row">
            <div class="col col-12">
                <form action="{{ route('update_invoice', $invoice->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="invoice_number">Numero de factura</label>
                        <input type="text" name="invoice_number" class="form-control" value="{{ $invoice->invoice_number }}">
                        @error('invoice_number')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="internal_code">Codigo interno</label>
                        <input type="text" name="internal_code" class="form-control" value="{{ $invoice->internal_code }}">
                        @error('internal_code')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="customers">Cliente</label>
                        <select name="customers" class="form-select">
                            <option value="{{ $invoice->customer_id }}" selected>{{ $invoice->customers->firstname . " " . $invoice->customers->lastname }}</option>
                            @foreach ($customers as $itemCustomer)
                                <option value="{{ $itemCustomer->id }}"
                                    {{ old('customers') == $itemCustomer->id ? 'selected' : '' }}>
                                    {{ $itemCustomer->firstname . " " . $itemCustomer->lastname }}</option>
                            @endforeach
                        </select>
                        @error('customers')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <br>
                    <input type="submit" value="Actualizar registro" class="btn btn-warning">
                </form>
            </div>
        </div>
    </div>
@endsection
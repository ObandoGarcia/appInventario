@extends('dashboard')

@section('dinamic-content')
    <div class="container">
        <h1>Agregar una nueva factura</h1>
        <br>
        <br>
        <div class="row">
            <div class="col col-12">
                <form action="{{ route('save_invoice') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="invoice_number">Numero de factura</label>
                        <input type="text" name="invoice_number" class="form-control" value="{{ old('invoice_number') }}">
                        @error('invoice_number')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="internal_code">Codigo interno</label>
                        <input type="text" name="internal_code" class="form-control" value="{{ old('internal_code') }}">
                        @error('internal_code')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="customers">Cliente</label>
                        <select name="customers" class="form-select">
                            <option value="" disabled selected>Seleccione una opcion de la lista</option>
                            @foreach ($customers as $itemCustomer)
                                <option value="{{ $itemCustomer->id }}"
                                    {{ old('customers') == $itemCustomer->id ? 'selected' : '' }}>
                                    {{ $itemCustomer->firstname . " " . $itemCustomer->lastname}}</option>
                            @endforeach
                        </select>
                        @error('customers')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <br>
                    <input type="submit" value="Guardar registro" class="btn btn-primary">
                    <input type="reset" value="Limpiar formulario" class="btn btn-info">
                </form>
            </div>
        </div>
    </div>
@endsection
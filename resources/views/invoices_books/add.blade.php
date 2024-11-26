@extends('dashboard')

@section('dinamic-content')
    <div class="container">
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible">
                {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h1>Agregar un nuevo libro a la factura</h1>
        <br>
        <br>
        <div class="row">
            <div class="col col-12">
                <form action="{{ route('save_book_invoice', $invoice->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="books">Seleccionar libro</label>
                        <select name="books" class="form-select">
                            <option value="" disabled selected>Seleccione una libro de la lista</option>
                            @foreach ($books as $itemBook)
                                <option value="{{ $itemBook->id }}"
                                    {{ old('books') == $itemBook->id ? 'selected' : '' }}>
                                    {{ $itemBook->title }}</option>
                            @endforeach
                        </select>
                        @error('books')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <br>
                    <input type="submit" value="Agregar libro" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
@extends('dashboard')

@section('dinamic-content')
    <div class="container">
        <h1>Editar cliente</h1>
        <br>
        <br>
        <div class="row">
            <div class="col col-12">
                <form action="{{ route('update_customer', $customer->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="firstname">Nombre</label>
                        <input type="text" name="firstname" class="form-control" value="{{ $customer->firstname }}">
                        @error('firstname')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="lastname">Apellido</label>
                        <input type="text" name="lastname" class="form-control" value="{{ $customer->lastname }}">
                        @error('lastname')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="phone">Telefono</label>
                        <input type="text" name="phone" class="form-control" value="{{ $customer->phone }}">
                        @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="code">Descripcion</label>
                        <input type="text" name="code" class="form-control" value="{{ $customer->code }}">
                        @error('code')
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
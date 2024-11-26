@extends('dashboard')

@section('dinamic-content')
    <div class="container">
        <h1>Agregar un nuevo cliente</h1>
        <br>
        <br>
        <div class="row">
            <div class="col col-12">
                <form action="{{ route('save_customer') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="firstname">Nombre</label>
                        <input type="text" name="firstname" class="form-control" value="{{ old('firstname') }}">
                        @error('firstname')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="lastname">Apellido</label>
                        <input type="text" name="lastname" class="form-control" value="{{ old('lastname') }}">
                        @error('lastname')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="phone">Telefono</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                        @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="code">Codigo de cliente</label>
                        <input type="text" name="code" class="form-control" value="{{ old('code') }}">
                        @error('code')
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
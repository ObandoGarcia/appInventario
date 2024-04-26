@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Registrar un nuevo proveedor</h1>
        <div class="row">
            <div class="col-6">
                <form action="{{ route('guardar_proveedor') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
                        @error('nombre')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="telefono">Numero de telefono</label>
                        <input type="number" name="telefono" class="form-control" value="{{ old('telefono') }}">
                        @error('telefono')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="email">Correo electronico</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <br>
                    <input type="submit" value="Guardar registro" class="btn btn-primary">
                </form>
            </div>
        </div>

    </div>
@endsection

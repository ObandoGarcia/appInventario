@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Registrar una nueva marca</h1>
        <div class="row">
            <div class="col-6">
                <form action="{{ route('guardar_marca') }}" method="POST">
                    @csrf

                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
                    @error('nombre')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <br>
                    <input type="submit" value="Guardar registro" class="btn btn-primary">
                </form>
            </div>
        </div>

    </div>
@endsection

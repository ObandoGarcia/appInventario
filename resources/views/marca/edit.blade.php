@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Editar marca</h1>
        <div class="row">
            <div class="col-6">
                <form action="{{ route('actualizar_marca', $marca->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $marca->nombre }}">
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

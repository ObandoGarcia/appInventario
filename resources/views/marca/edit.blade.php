@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Editar marca</h1>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-10">
                <form action="{{ route('actualizar_marca', $marca->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ $marca->nombre }}">
                        @error('nombre')
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

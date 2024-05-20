@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Registrar un nuevo encargado</h1>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-10">
                <form action="{{ route('guardar_encargado') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
                        @error('nombre')
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

                    <div class="mb-3">
                        <label class="form-label" for="telefono">Telefono</label>
                        <input type="number" name="telefono" class="form-control" value="{{ old('telefono') }}">
                        @error('telefono')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="estado">Estado</label>
                        <select name="estado" class="form-select">
                            <option value="">Seleccione una opcion de la lista</option>
                            @foreach ($estados as $itemEstado)
                                <option value="{{ $itemEstado->id }}"
                                    {{ old('estado') == $itemEstado->id ? 'selected' : '' }}>{{ $itemEstado->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <br>
                    <input type="submit" value="Guardar registro" class="btn btn-primary">
                </form>
            </div>
        </div>

    </div>
@endsection

@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Editar encargado</h1>
        <div class="row">
            <div class="col-12 col-xl-6 col-xxl-6">
                <form action="{{ route('actualizar_encargado', $encargado->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ $encargado->nombre }}">
                        @error('nombre')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="email">Correo electronico</label>
                        <input type="email" name="email" class="form-control" value="{{ $encargado->email }}">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="telefono">Telefono</label>
                        <input type="number" name="telefono" class="form-control" value="{{ $encargado->telefono }}">
                        @error('telefono')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="estado">Estado</label>
                        <select name="estado" class="form-select">
                            <option value="{{ $encargado->estado_id }}">{{ $encargado->estados->nombre }}</option>
                            @foreach ($estados as $itemEstado)
                                <option value="{{ $itemEstado->id }}"
                                    {{ old('estado') == $itemEstado->id ? 'selected' : '' }}>
                                    {{ $itemEstado->nombre }}</option>
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

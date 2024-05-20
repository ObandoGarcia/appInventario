@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Editar registro motorista</h1>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-10">
                <form action="{{ route('actualizar_conductor', $conductor->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ $conductor->nombre }}">
                        @error('nombre')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="dui">DUI</label>
                        <input type="text" name="dui" class="form-control" value="{{ $conductor->dui }}">
                        @error('dui')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="telefono">Telefono</label>
                        <input type="number" name="telefono" class="form-control" value="{{ $conductor->telefono }}">
                        @error('telefono')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="licencia">Licencia de conducir</label>
                        <input type="text" name="licencia" class="form-control" value="{{ $conductor->licencia}}">
                        @error('licencia')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="estado">Estado</label>
                        <select name="estado" class="form-select">
                            <option value="{{ $conductor->estado_id }}">{{ $conductor->estados->nombre }}</option>
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

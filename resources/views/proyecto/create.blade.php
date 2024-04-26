@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Registrar un nuevo proyecto</h1>
        <div class="row">
            <div class="col-6">
                <form action="{{ route('guardar_proyecto') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
                        @error('nombre')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="ubicacion">Ubicacion</label>
                        <input type="text" name="ubicacion" class="form-control" value="{{ old('ubicacion') }}">
                        @error('ubicacion')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="fecha_de_inicio">Fecha de inicio</label>
                        <input type="datetime-local" name="fecha_de_inicio" class="form-control"
                            value="{{ old('fecha_de_inicio') }}">
                        @error('fecha_de_inicio')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="fecha_de_finalizacion">Fecha de finalizacion</label>
                        <input type="datetime-local" name="fecha_de_finalizacion" class="form-control"
                            value="{{ old('fecha_de_finalizacion') }}">
                        @error('fecha_de_finaclizacion')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="encargado">Encargado de proyecto</label>
                        <select name="encargado" class="form-select">
                            <option value="">Seleccione una opcion de la lista</option>
                            @foreach ($encargados as $itemEncargado)
                                <option value="{{ $itemEncargado->id }}"
                                    {{ old('encargado') == $itemEncargado->id ? 'selected' : '' }}>
                                    {{ $itemEncargado->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="estado">Estado</label>
                        <select name="estado" class="form-select">
                            <option value="">Seleccione una opcion de la lista</option>
                            @foreach ($estado as $itemEstado)
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

@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Registrar una boleta</h1>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-10">
                <form action="{{ route('guardar_boleta') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="conductor">Conductores</label>
                        <select name="conductor" class="form-select" required>
                            <option value="">Seleccione una opcion de la lista</option>
                            @foreach ($conductores as $itemConductor)
                                <option value="{{ $itemConductor->id }}"
                                    {{ old('conductor') == $itemConductor->id ? 'selected' : '' }}>{{ $itemConductor->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="fecha">Fecha</label>
                        <input type="datetime-local" name="fecha" class="form-control" value="{{ old('fecha') }}">
                        @error('fecha')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="proyecto">Proyecto</label>
                        <select name="proyecto" class="form-select" required>
                            <option value="">Seleccione una opcion de la lista</option>
                            @foreach ($proyectos as $itemProyecto)
                                <option value="{{ $itemProyecto->id }}"
                                    {{ old('proyecto') == $itemProyecto->id ? 'selected' : '' }}>{{ $itemProyecto->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="maquinaria">Maquinaria</label>
                        <select name="maquinaria" class="form-select" required>
                            <option value="">Seleccione una opcion de la lista</option>
                            @foreach ($maquinarias as $itemMaquinaria)
                                <option value="{{ $itemMaquinaria->id }}"
                                    {{ old('maquinaria') == $itemMaquinaria->id ? 'selected' : '' }}>{{ $itemMaquinaria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="cantidad">Cantidad en Galones</label>
                        <input type="number" name="cantidad" class="form-control" value="{{ old('cantidad') }}" min="0" step="0.0001">
                        @error('cantidad')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="descripcion">Descripcion</label>
                        <textarea name="descripcion" cols="15" rows="10" class="form-control">
                            {{ old('descripcion') }}
                        </textarea>
                        @error('descripcion')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="entregado">Entregado por</label>
                        <input type="text" name="entregado" class="form-control" value="{{ old('entregado') }}">
                        @error('entregado')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="recibido">Recibido por</label>
                        <input type="text" name="recibido" class="form-control" value="{{ old('recibido') }}">
                        @error('recibido')
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

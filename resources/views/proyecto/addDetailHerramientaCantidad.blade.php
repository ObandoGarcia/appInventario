@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Agregar una nueva herramienta al proyecto</h1>
        <br>
        <h3>Proyecto: <strong>{{ $proyecto->nombre }}</strong></h3>
        <br>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-10">
                <form action="{{ route('guardar_detalle_herramientas', ['proyectoId' => $proyecto->id, 'herramientaId' => $herramienta->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="material">Material: {{ $herramienta->nombre }}</label>
                        <p><strong>Cantidad disponible: {{ $herramienta->cantidad }} </strong></p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="cantidad">Cantidad</label>
                        <input type="number" name="cantidad" class="form-control" value="{{ old('cantidad') }}" min="1" max="{{ $herramienta->cantidad }}" required>
                        @error('cantidad')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <br>
                    <input type="submit" value="Guardar registro de material" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection

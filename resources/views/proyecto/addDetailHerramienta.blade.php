@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Agregar una nueva herramienta al proyecto</h1>
        <br>
        <h3>Proyecto: <strong>{{ $proyecto->nombre }}</strong></h3>
        <br>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-10">
                <form action="{{ route('validar_cantidad_maherramientas', $proyecto->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="herramienta">Herraminetas disponibles</label>
                        <select name="herramienta" class="form-select" required>
                            <option value="">Seleccione una herramienta de la lista</option>
                            @foreach ($herramientas as $itemHerramienta)
                                <option value="{{ $itemHerramienta->id }}"
                                    {{ old('herramienta') == $itemHerramienta->id ? 'selected' : '' }}>
                                    {{ $itemHerramienta->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <br>
                    <input type="submit" value="Verificar cantidad disponible" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection

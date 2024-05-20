@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Agregar un nuevo material al proyecto</h1>
        <br>
        <h3>Proyecto: <strong>{{ $proyecto->nombre }}</strong></h3>
        <br>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-10">
                <form action="{{ route('validar_cantidad_materiales', $proyecto->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="material">Material</label>
                        <select name="material" class="form-select" required>
                            <option value="">Seleccione un material de la lista</option>
                            @foreach ($materiales as $itemMaterial)
                                <option value="{{ $itemMaterial->id }}"
                                    {{ old('material') == $itemMaterial->id ? 'selected' : '' }}>
                                    {{ $itemMaterial->nombre }}
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

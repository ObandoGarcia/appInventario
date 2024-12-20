@extends('dashboard')

@section('dinamic-content')
    <div class="container">
        <h1>Agregar una nueva categoria</h1>
        <br>
        <br>
        <div class="row">
            <div class="col col-12">
                <form action="{{ route('save_category') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="category">Categoria</label>
                        <input type="text" name="category" class="form-control" value="{{ old('category') }}">
                        @error('category')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="description">Descripcion</label>
                        <input type="text" name="description" class="form-control" value="{{ old('description') }}">
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <br>
                    <input type="submit" value="Guardar registro" class="btn btn-primary">
                    <input type="reset" value="Limpiar formulario" class="btn btn-info">
                </form>
            </div>
        </div>
    </div>
@endsection
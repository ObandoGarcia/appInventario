@extends('dashboard')

@section('dinamic-content')
    <div class="container">
        <h1>Editar categoria</h1>
        <br>
        <br>
        <div class="row">
            <div class="col col-12">
                <form action="{{ route('update_category', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="category">Categoria</label>
                        <input type="text" name="category" class="form-control" value="{{ $category->category }}">
                        @error('category')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="description">Descripcion</label>
                        <input type="text" name="description" class="form-control" value="{{ $category->description }}">
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <br>
                    <input type="submit" value="Actualizar registro" class="btn btn-warning">
                </form>
            </div>
        </div>
    </div>
@endsection
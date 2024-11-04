@extends('dashboard')

@section('dinamic-content')
    <div class="container">
        <h1>¿Estas seguro de eliminar este registro de categoria?</h1>
        <br>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-10">
                <form action="{{ route('delete_category', $category->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

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
                    <input type="submit" value="Eliminar registro" class="btn btn-danger">
                </form>
            </div>
        </div>
    </div>
@endsection
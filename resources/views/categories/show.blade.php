@extends('dashboard')

@section('dinamic-content')
    <div class="container">
        <h1>¿Estas seguro de eliminar este registro de categoria?</h1>
        <br>
        <div class="row">
            <div class="col col-12">
                <form action="{{ route('delete_category', $category->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="mb-3">
                        <label class="form-label" for="category">Categoria</label>
                        <input type="text" name="category" class="form-control" value="{{ $category->category }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="description">Descripcion</label>
                        <input type="text" name="description" class="form-control" value="{{ $category->description }}" readonly>
                    </div>

                    <br>
                    @role('administrador')
                        <input type="submit" value="Eliminar registro" class="btn btn-danger">
                    @endrole
                </form>
            </div>
        </div>
    </div>
@endsection
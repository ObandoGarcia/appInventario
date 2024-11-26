@extends('dashboard')

@section('dinamic-content')
    <div class="container">
        <h1>¿Estas seguro de eliminar este registro de libro?</h1>
        <br>
        <br>
        <div class="row">
            <div class="col col-12">
                <form action="{{ route('delete_book', $book->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="mb-3">
                        <label class="form-label" for="title">Titulo</label>
                        <input type="text" name="title" class="form-control" value="{{ $book->title }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="internal_code">Codigo interno</label>
                        <input type="text" name="internal_code" class="form-control" value="{{ $book->internal_code }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="isbn">ISBN</label>
                        <input type="text" name="isbn" class="form-control" value="{{ $book->isbn}}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="image_title">Imagen actual</label>
                        <br>
                        <img src="{{ asset($book->image_url) }}" alt="Imagen de libro" width="250" height="250">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="available">Disponibles]</label>
                        <input type="number" name="quantity" class="form-control" value="{{ $book->available }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="cost">Costo</label>
                        <input type="number" name="cost" class="form-control" value="{{ $book->cost }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="state">Estado</label>
                        <input type="text" name="state" class="form-control" value="{{ $book->state }}" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label" for="entry_date">Fecha de ingreso</label>
                        <input type="datetime-local" name="entry_date" class="form-control" value="{{ $book->entry_date }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="author">Autor</label>
                        <input type="text" name="author" class="form-control" value="{{ $book->authors->firstname . " " . $book->authors->lastname }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="categories">Categoria</label>
                        <input type="text" name="author" class="form-control" value="{{ $book->categories->category }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="editorials">Editorial</label>
                        <input type="text" name="author" class="form-control" value="{{ $book->editorials->name }}" readonly>
                    </div>

                    <br>
                    <input type="submit" value="Eliminar registro" class="btn btn-danger">
                </form>
            </div>
        </div>
    </div>
@endsection
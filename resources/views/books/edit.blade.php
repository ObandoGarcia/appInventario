@extends('dashboard')

@section('dinamic-content')
    <div class="container">
        <h1>Editar libro</h1>
        <br>
        <br>
        <div class="row">
            <div class="col col-12">
                <form action="{{ route('update_book', $book->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="title">Titulo</label>
                        <input type="text" name="title" class="form-control" value="{{ $book->title }}">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="internal_code">Codigo interno</label>
                        <input type="text" name="internal_code" class="form-control" value="{{ $book->internal_code }}">
                        @error('internal_code')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="isbn">ISBN</label>
                        <input type="text" name="isbn" class="form-control" value="{{ $book->isbn}}">
                        @error('isbn')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="image_title">Imagen actual</label>
                        <br>
                        <img src="{{ asset($book->image_url) }}" alt="Imagen de libro" width="150" height="150">
                        <br>
                        <br>
                        <label class="form-label" for="image_title2">Cambiar imagen</label>
                        <br>
                        <input type="file" name="image">
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="available">Cantidad</label>
                        <input type="number" name="available" class="form-control" value="{{ $book->available }}" step="1">
                        @error('available')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="cost">Costo</label>
                        <input type="number" name="cost" class="form-control" value="{{ $book->cost }}" step="0.01">
                        @error('cost')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="state">Estado</label>
                        <select name="state" class="form-select">
                            <option value="{{ $book->state }}" selected>{{ $book->state }}</option>
                            <option value="disponible">disponible</option>
                            <option value="no disponible">no disponible</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label" for="entry_date">Fecha de ingreso</label>
                        <input type="datetime-local" name="entry_date" class="form-control" value="{{ $book->entry_date }}">
                        @error('entry_date')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="authors">Autor</label>
                        <select name="authors" class="form-select">
                            <option value="{{ $book->author_id }}" selected>{{ $book->authors->firstname . " " . $book->authors->lastname }}</option>
                            @foreach ($authors as $itemAuthor)
                                <option value="{{ $itemAuthor->id }}"
                                    {{ old('authors') == $itemAuthor->id ? 'selected' : '' }}>
                                    {{ $itemAuthor->firstname . " " . $itemAuthor->lastname}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="categories">Categoria</label>
                        <select name="categories" class="form-select">
                            <option value="{{ $book->category_id }}" selected>{{ $book->categories->category }}</option>
                            @foreach ($categories as $itemCategory)
                                <option value="{{ $itemCategory->id }}"
                                    {{ old('categories') == $itemCategory->id ? 'selected' : '' }}>
                                    {{ $itemCategory->category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="editorials">Editorial</label>
                        <select name="editorials" class="form-select">
                            <option value="{{ $book->editorial_id }}" selected>{{ $book->editorials->name }}</option>
                            @foreach ($editorials as $itemEditorial)
                                <option value="{{ $itemEditorial->id }}"
                                    {{ old('categories') == $itemEditorial->id ? 'selected' : '' }}>
                                    {{ $itemEditorial->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <br>
                    <input type="submit" value="Actualizar registro" class="btn btn-warning">
                </form>
            </div>
        </div>
    </div>
@endsection
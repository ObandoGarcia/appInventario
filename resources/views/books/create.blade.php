@extends('dashboard')

@section('dinamic-content')
    <div class="container">
        <h1>Agregar un nuevo libro</h1>
        <br>
        <br>
        <div class="row">
            <div class="col col-12">
                <form action="{{ route('save_book') }}" enctype="multipart/form-data" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="title">Titulo</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                        @error('title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="internal_code">Codigo interno</label>
                        <input type="text" name="internal_code" class="form-control" value="{{ old('internal_code') }}">
                        @error('internal_code')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="isbn">ISBN</label>
                        <input type="text" name="isbn" class="form-control" value="{{ old('isbn') }}">
                        @error('isbn')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="image_title">Imagen</label>
                        <br>
                        <input type="file" name="image" class="form-control">
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="available">Cantidad</label>
                        <input type="number" name="available" class="form-control" value="{{ old('available') }}" step="1">
                        @error('available')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="cost">Costo</label>
                        <input type="number" name="cost" class="form-control" value="{{ old('cost') }}" step="0.01">
                        @error('cost')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="state">Estado</label>
                        <select name="state" class="form-select">
                            <option value="" disabled selected>Seleccione una opcion de la lista</option>
                            <option value="disponible">Disponible</option>
                            <option value="no disponible">No disponible</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label" for="entry_date">Fecha de ingreso</label>
                        <input type="datetime-local" name="entry_date" class="form-control" value="{{ old('entry_date') }}">
                        @error('entry_date')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="authors">Autor</label>
                        <select name="authors" class="form-select">
                            <option value="" disabled selected>Seleccione una opcion de la lista</option>
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
                            <option value="" disabled selected>Seleccione una opcion de la lista</option>
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
                            <option value="" disabled selected>Seleccione una opcion de la lista</option>
                            @foreach ($editorials as $itemEditorial)
                                <option value="{{ $itemEditorial->id }}"
                                    {{ old('categories') == $itemEditorial->id ? 'selected' : '' }}>
                                    {{ $itemEditorial->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <br>
                    <input type="submit" value="Guardar registro" class="btn btn-primary">
                    <input type="reset" value="Limpiar formulario" class="btn btn-info">
                </form>
            </div>
        </div>
    </div>
@endsection
@extends('dashboard')

@section('dinamic-content')
    <div class="container">
        <h1>Editar autor</h1>
        <br>
        <br>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-10">
                <form action="{{ route('update_author', $author->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="firstname">Nombre</label>
                        <input type="text" name="firstname" class="form-control" value="{{ $author->firstname }}">
                        @error('firstname')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="lastname">Apellido</label>
                        <input type="text" name="lastname" class="form-control" value="{{ $author->lastname }}">
                        @error('lastname')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="nationality">Nacionalidad</label>
                        <input type="text" name="nationality" class="form-control" value="{{ $author->nationality}}">
                        @error('nationality')
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
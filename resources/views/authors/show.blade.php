@extends('dashboard')

@section('dinamic-content')
    <div class="container">
        <h1>¿Estas seguro de eliminar este registro de autor?</h1>
        <br>
        <div class="row">
            <div class="col col-12">
                <form action="{{ route('delete_author', $author->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="mb-3">
                        <label class="form-label" for="firstname">Nombre</label>
                        <input type="text" name="firstname" class="form-control" value="{{ $author->firstname }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="lastname">Apellido</label>
                        <input type="text" name="lastname" class="form-control" value="{{ $author->lastname }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="nationality">Nacionalidad</label>
                        <input type="text" name="nationality" class="form-control" value="{{ $author->nationality}}" readonly>
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
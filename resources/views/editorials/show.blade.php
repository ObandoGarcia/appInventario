@extends('dashboard')

@section('dinamic-content')
    <div class="container">
        <h1>¿Estas seguro de eliminar este registro de editorial?</h1>
        <br>
        <br>
        <div class="row">
            <div class="col col-12">
                <form action="{{ route('delete_editorial', $editorial->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="mb-3">
                        <label class="form-label" for="name">Nombre</label>
                        <input type="text" name="name" class="form-control" value="{{ $editorial->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="phone">Telefono</label>
                        <input type="text" name="phone" class="form-control" value="{{ $editorial->phone }}" readonly>
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
@extends('dashboard')

@section('dinamic-content')
    <div class="container">
        <h1>Editar editorial</h1>
        <br>
        <br>
        <div class="row">
            <div class="col col-12">
                <form action="{{ route('update_editorial', $editorial->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="name">Nombre</label>
                        <input type="text" name="name" class="form-control" value="{{ $editorial->name }}">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="phone">Telefono</label>
                        <input type="text" name="phone" class="form-control" value="{{ $editorial->phone }}">
                        @error('phone')
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
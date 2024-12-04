@extends('dashboard')

@section('dinamic-content')
    <div class="container">
        <h1>Editar usuario</h1>
        <br>
        <br>
        <div class="row">
            <div class="col col-12">
                <form action="{{ route('update_user', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="name">Nombre</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password">Nueva contrasenia</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <br>
                    @role('administrador')
                       <input type="submit" value="Guardar registro" class="btn btn-primary">
                    @endrole
                </form>
            </div>
        </div>
    </div>
@endsection
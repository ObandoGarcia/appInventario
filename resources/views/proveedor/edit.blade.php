@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Editar un proveedor</h1>
        <div class="row">
            <div class="col-12 col-xl-6 col-xxl-6">
                <form action="{{ route('actualizar_proveedor', $proveedor->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ $proveedor->nombre }}">
                        @error('nombre')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="telefono">Numero de telefono</label>
                        <input type="number" name="telefono" class="form-control" value="{{ $proveedor->telefono }}">
                        @error('telefono')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="email">Correo electronico</label>
                        <input type="email" name="email" class="form-control" value="{{ $proveedor->email }}">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                    <br>
                    <input type="submit" value="Guardar registro" class="btn btn-primary">
                </form>
            </div>
        </div>

    </div>
@endsection

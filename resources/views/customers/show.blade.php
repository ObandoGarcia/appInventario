@extends('dashboard')

@section('dinamic-content')
    <div class="container">
        <h1>¿Estas seguro de eliminar este registro de cliente?</h1>
        <br>
        <br>
        <div class="row">
            <div class="col col-12">
                <form action="{{ route('delete_customer', $customer->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="mb-3">
                        <label class="form-label" for="firstname">Nombre</label>
                        <input type="text" name="firstname" class="form-control" value="{{ $customer->firstname }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="lastname">Apellido</label>
                        <input type="text" name="lastname" class="form-control" value="{{ $customer->lastname }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="phone">Telefono</label>
                        <input type="text" name="phone" class="form-control" value="{{ $customer->phone }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="code">Descripcion</label>
                        <input type="text" name="code" class="form-control" value="{{ $customer->code }}" readonly>
                    </div>

                    <br>
                    <input type="submit" value="Eliminar registro" class="btn btn-danger">
                </form>
            </div>
        </div>
    </div>
@endsection
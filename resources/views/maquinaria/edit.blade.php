@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Editar una maquinaria</h1>
        <div class="row">
            <div class="col-12 col-xl-6 col-xxl-6">
                <form action="{{ route('actualizar_maquinaria', $maquinaria->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ $maquinaria->nombre }}">
                        @error('nombre')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="vehiculo">Vehiculo</label>
                        <input type="text" name="vehiculo" class="form-control"
                            value="{{ $maquinaria->vehiculo }}">
                        @error('vehiculo')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="placas">Placas</label>
                        <input type="text" name="placas" class="form-control"
                            value="{{ $maquinaria->placas }}">
                        @error('placas')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="modelo">Modelo</label>
                        <input type="text" name="modelo" class="form-control"
                            value="{{ $maquinaria->modelo }}">
                        @error('modelo')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="serie">Serie</label>
                        <input type="text" name="serie" class="form-control"
                            value="{{ $maquinaria->serie }}">
                        @error('serie')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="descripcion">Descripcion</label>
                        <textarea name="descripcion" cols="15" rows="5" class="form-control">
                        {{ $maquinaria->descripcion }}
                    </textarea>
                        @error('descripcion')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="fecha_de_ingreso">Fecha de ingreso</label>
                        <input type="datetime-local" name="fecha_de_ingreso" class="form-control"
                            value="{{ $maquinaria->fecha_de_ingreso }}">
                        @error('fecha_de_ingreso')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="marca">Marca</label>
                        <select name="marca" class="form-select">
                            <option value="{{ $maquinaria->marca_id }}">{{ $maquinaria->marcas->nombre }}</option>
                            @foreach ($marcas as $itemMarca)
                                <option value="{{ $itemMarca->id }}"
                                    {{ old('marca') == $itemMarca->id ? 'selected' : '' }}>{{ $itemMarca->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="proveedor">Proveedor</label>
                        <select name="proveedor" class="form-select">
                            <option value="{{ $maquinaria->proveedor_id }}">{{ $maquinaria->proveedores->nombre }}</option>
                            @foreach ($proveedores as $itemProveedor)
                                <option value="{{ $itemProveedor->id }}"
                                    {{ old('proveedor') == $itemProveedor->id ? 'selected' : '' }}>
                                    {{ $itemProveedor->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="estado">Estado</label>
                        <select name="estado" class="form-select">
                            <option value="{{ $maquinaria->estado_id }}">{{ $maquinaria->estados->nombre }}</option>
                            @foreach ($estados as $itemEstado)
                                <option value="{{ $itemEstado->id }}"
                                    {{ old('estado') == $itemEstado->id ? 'selected' : '' }}>{{ $itemEstado->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <br>
                    <input type="submit" value="Guardar registro" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection

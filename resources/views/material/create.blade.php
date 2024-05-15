@extends('dashboard')

@section('contenido-dinamico')
    <div>
        <h1>Registrar un nuevo material</h1>
        <div class="row">
            <div class="col-12 col-xl-6 col-xxl-6">
                <form action="{{ route('guardar_material') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
                        @error('nombre')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="cantidad">Cantidad</label>
                        <input type="number" step="1" name="cantidad" class="form-control"
                            value="{{ old('cantidad') }}">
                        @error('cantidad')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="medida">Unidad de medida</label>
                        <select name="medida" class="form-select">
                            <option value="general" selected>Medida general sin especificar</option>
                            <option value="" disabled>--------------------------Peso--------------------------</option>
                            <option value="kilogramo">Kilogramo</option>
                            <option value="libra">Libra</option>
                            <option value="" disabled>------------------------Longitud------------------------</option>
                            <option value="metros">Metros</option>
                            <option value="pulgadas">Pulgadas</option>
                            <option value="yardas">Yardas</option>
                            <option value="pies">Pies</option>
                            <option value="" disabled>------------------------Volumen------------------------</option>
                            <option value="litros">Litros</option>
                            <option value="galones">Galones</option>
                            <option value="cuarto de galon">Cuarto de galon</option>
                            <option value="metros cubicos">Metros Cubicos</option>
                            <option value="pies cubicos">Pies Cubicos</option>
                            <option value="" disabled>---------------------Otras medidas----------------------</option>
                            <option value="bolsas">Bolsas</option>
                            <option value="sacos">Sacos</option>
                            <option value="cajas">Cajas</option>
                            <option value="Barril">Barriles</option>
                            <option value="rollo">Rollos</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="descripcion">Descripcion</label>
                        <textarea name="descripcion" cols="15" rows="5" class="form-control">
                        {{ old('descripcion') }}
                    </textarea>
                        @error('descripcion')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="fecha_de_ingreso">Fecha de ingreso</label>
                        <input type="datetime-local" name="fecha_de_ingreso" class="form-control"
                            value="{{ old('fecha_de_ingreso') }}">
                        @error('fecha_de_ingreso')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="precio_por_unidad">Precio por unidad</label>
                        <input type="number" step="0.01" name="precio_por_unidad" class="form-control"
                            value="{{ old('precio_por_unidad') }}">
                        @error('precio_por_unidad')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="marca">Marca</label>
                        <select name="marca" class="form-select">
                            <option value="">Seleccione una opcion de la lista</option>
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
                            <option value="">Seleccione una opcion de la lista</option>
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
                            <option value="">Seleccione una opcion de la lista</option>
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

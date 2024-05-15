<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Marca;
use App\Models\Proveedor;
use App\Models\Estado;
use Illuminate\Http\Request;

class MaterialesController extends Controller
{
    public function index()
    {
        $materiales = Material::orderBy('id', 'desc')->paginate(10);

        return view('material.material',compact('materiales'));
    }

    public function create()
    {
        $marcas = Marca::all();
        $proveedores = Proveedor::all();
        $estados = Estado::where('nombre', '=', 'nuevo')
            ->orwhere('nombre', '=', 'usado')
            ->get();

        return view('material.create', compact('marcas', 'proveedores', 'estados'));
    }

    public function show($id)
    {
        $material = Material::find($id);

        return view('material.show', compact('material'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:2'],
            'cantidad' => ['required', 'numeric', 'min:0'],
            'descripcion' => ['nullable', 'string'],
            'fecha_de_ingreso' => ['required', 'date'],
            'precio_por_unidad' => ['required', 'decimal:2', 'min:0']
        ]);

        $material = new Material();
        $material->nombre = $request->nombre;
        $material->cantidad = $request->cantidad;
        $material->medida = $request->medida;
        $material->descripcion = $request->descripcion;
        $material->fecha_de_ingreso = $request->fecha_de_ingreso;
        $material->precio_por_unidad = $request->precio_por_unidad;
        $material->marca_id = $request->marca;
        $material->estado_id = $request->estado;
        $material->proveedor_id = $request->proveedor;
        $material->usuario_id = auth()->user()->id;
        $material->save();
        //notify()->success('Registro creado correctamente', 'Informacion');

        return redirect()->route('materiales');
    }

    public function edit($id)
    {
        $marcas = Marca::all();
        $proveedores = Proveedor::all();
        $estados = Estado::where('nombre', '=', 'nuevo')
            ->orwhere('nombre', '=', 'usado')
            ->get();
        $material = Material::find($id);

        return view('material.edit', compact('material', 'marcas', 'proveedores', 'estados'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:2'],
            'cantidad' => ['required', 'numeric', 'min:0'],
            'descripcion' => ['nullable', 'string'],
            'fecha_de_ingreso' => ['required', 'date'],
            'precio_por_unidad' => ['required', 'decimal:2', 'min:0']
        ]);

        $material = Material::find($id);
        $material->nombre = $request->nombre;
        $material->cantidad = $request->cantidad;
        $material->medida = $request->medida;
        $material->descripcion = $request->descripcion;
        $material->fecha_de_ingreso = $request->fecha_de_ingreso;
        $material->precio_por_unidad = $request->precio_por_unidad;
        $material->marca_id = $request->marca;
        $material->estado_id = $request->estado;
        $material->proveedor_id = $request->proveedor;
        $material->usuario_id = auth()->user()->id;
        $material->update();
        //notify()->success('Registro actualizado correctamente', 'Informacion');

        return redirect()->route('materiales');
    }
}

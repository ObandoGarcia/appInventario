<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Proveedor;
use App\Models\Estado;
use App\Models\Maquinaria;

class MaquinariasController extends Controller
{
    public function index()
    {
        $maquinarias = Maquinaria::orderBy('id', 'desc')->paginate(10);

        return view('maquinaria.maquinarias', compact('maquinarias'));
    }

    public function create()
    {
        $marcas = Marca::all();
        $estados = Estado::where('nombre', '=', 'nuevo')
            ->orwhere('nombre', '=', 'usado')
            ->orwhere('nombre', '=', 'alquiler')
            ->orwhere('nombre', '=', 'en proyecto')
            ->get();
        $proveedores = Proveedor::all();

        return view('maquinaria.create', compact('marcas', 'estados', 'proveedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:2'],
            'vehiculo' => ['nullable'],
            'placas' => ['nullable'],
            'modelo' => ['required', 'string', 'min:2'],
            'serie' => ['required', 'string', 'min:2'],
            'descripcion' => ['nullable', 'string'],
            'fecha_de_ingreso' => ['required', 'date']
        ]);

        $maquinaria = new Maquinaria();
        $maquinaria->nombre = $request->nombre;
        $maquinaria->vehiculo = $request->vehiculo;
        $maquinaria->placas = $request->placas;
        $maquinaria->modelo = $request->modelo;
        $maquinaria->serie = $request->serie;
        $maquinaria->descripcion = $request->descripcion;
        $maquinaria->fecha_de_ingreso = $request->fecha_de_ingreso;
        $maquinaria->disponible = true;
        $maquinaria->marca_id = $request->marca;
        $maquinaria->estado_id = $request->estado;
        $maquinaria->proveedor_id = $request->proveedor;
        $maquinaria->usuario_id = auth()->user()->id;
        $maquinaria->save();
        //notify()->success('Registro creado correctamente', 'Informacion');

        return redirect()->route('maquinarias');
    }

    public function show($id)
    {
        $maquinaria = Maquinaria::find($id);

        return view('maquinaria.show', compact('maquinaria'));
    }

    public function edit($id)
    {
        $marcas = Marca::all();
        $estados = Estado::where('nombre', '=', 'nuevo')
            ->orwhere('nombre', '=', 'usado')
            ->orwhere('nombre', '=', 'alquiler')
            ->orwhere('nombre', '=', 'en proyecto')
            ->get();
        $proveedores = Proveedor::all();
        $maquinaria = Maquinaria::find($id);

        return view('maquinaria.edit', compact('maquinaria', 'marcas', 'estados', 'proveedores'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:2'],
            'vehiculo' => ['nullable'],
            'placas' => ['nullable'],
            'modelo' => ['required', 'string', 'min:2'],
            'serie' => ['required', 'string', 'min:2'],
            'descripcion' => ['nullable', 'string'],
            'fecha_de_ingreso' => ['required', 'date'],
        ]);

        $maquinaria = Maquinaria::find($id);
        $maquinaria->nombre = $request->nombre;
        $maquinaria->vehiculo = $request->vehiculo;
        $maquinaria->placas = $request->placas;
        $maquinaria->modelo = $request->modelo;
        $maquinaria->serie = $request->serie;
        $maquinaria->descripcion = $request->descripcion;
        $maquinaria->fecha_de_ingreso = $request->fecha_de_ingreso;
        $maquinaria->marca_id = $request->marca;
        $maquinaria->estado_id = $request->estado;
        $maquinaria->proveedor_id = $request->proveedor;
        $maquinaria->usuario_id = auth()->user()->id;
        $maquinaria->update();
        //notify()->success('Registro actualizado correctamente', 'Informacion');

        return redirect()->route('maquinarias');

    }
}

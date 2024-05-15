<?php

namespace App\Http\Controllers;

use App\Models\Herramientas;
use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Proveedor;
use App\Models\Estado;

class HerramientasController extends Controller
{
    public function index()
    {
        $herramientas = Herramientas::orderBy('id', 'desc')->paginate(10);

        return view('herramienta.herramientas', compact('herramientas'));
    }

    public function create()
    {
        $marcas = Marca::all();
        $proveedores = Proveedor::all();
        $estados = Estado::where('nombre', '=', 'nuevo')
            ->orwhere('nombre', '=', 'usado')
            ->get();

        return view('herramienta.create', compact('marcas', 'proveedores', 'estados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:2'],
            'cantidad' => ['required', 'numeric', 'min:0'],
            'descripcion' => ['nullable', 'string']
        ]);

        $herramienta = new Herramientas();
        $herramienta->nombre = $request->nombre;
        $herramienta->cantidad = $request->cantidad;
        $herramienta->descripcion = $request->descripcion;
        $herramienta->marca_id = $request->marca;
        $herramienta->proveedor_id = $request->proveedor;
        $herramienta->estado_id = $request->estado;
        $herramienta->usuario_id = auth()->user()->id;
        $herramienta->save();
        //notify()->success('Registro creado correctamente', 'Informacion');

        return redirect()->route('herramientas');
    }

    public function edit($id)
    {
        $marcas = Marca::all();
        $proveedores = Proveedor::all();
        $estados = Estado::where('nombre', '=', 'nuevo')
            ->orwhere('nombre', '=', 'usado')
            ->get();

        $herramienta = Herramientas::find($id);

        return view('herramienta.edit', compact('herramienta', 'marcas', 'proveedores', 'estados'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:2'],
            'cantidad' => ['required', 'numeric', 'min:0'],
            'descripcion' => ['nullable', 'string']
        ]);

        $herramienta = Herramientas::find($id);
        $herramienta->nombre = $request->nombre;
        $herramienta->cantidad = $request->cantidad;
        $herramienta->descripcion = $request->descripcion;
        $herramienta->marca_id = $request->marca;
        $herramienta->proveedor_id = $request->proveedor;
        $herramienta->estado_id = $request->estado;
        $herramienta->usuario_id = auth()->user()->id;
        $herramienta->update();
        //notify()->success('Registro actualizado correctamente', 'Informacion');

        return redirect()->route('herramientas');
    }
}

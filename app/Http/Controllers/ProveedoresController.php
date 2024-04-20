<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Provider;

class ProveedoresController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::orderBy('id', 'asc')->paginate(10);

        return view('proveedor.proveedor', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:2'],
            'telefono' => ['numeric', 'min:0'],
            'email' => ['email']
        ]);

        $proveedor = new Proveedor();
        $proveedor->nombre = $request->nombre;
        $proveedor->telefono = $request->telefono;
        $proveedor->email = $request->email;
        $proveedor->usuario_id = auth()->user()->id;
        $proveedor->save();

        notify()->success('Registro creado correctamente', 'Informacion');

        return redirect()->route('proveedores');
    }

    public function edit($id)
    {
        $proveedor = Proveedor::find($id);

        return view('proveedor.edit', compact('proveedor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:2'],
            'telefono' => ['numeric', 'min:0'],
            'email' => ['email']
        ]);

        $proveedor = Proveedor::find($id);
        $proveedor->nombre = $request->nombre;
        $proveedor->telefono = $request->telefono;
        $proveedor->email = $request->email;
        $proveedor->usuario_id = auth()->user()->id;
        $proveedor->update();

        notify()->success('Registro actualizado correctamente', 'Informacion');

        return redirect()->route('proveedores');

    }

    public function destroy($id)
    {
        $proveedor = Proveedor::find($id);
        $proveedor->delete();

        notify()->success('Registro eliminado correctamente', 'Informacion');

        return redirect()->route('proveedores');
    }
}

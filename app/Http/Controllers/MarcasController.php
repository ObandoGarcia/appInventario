<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;

class MarcasController extends Controller
{
    public function index()
    {
        $marcas = Marca::orderBy('id', 'asc')->paginate(10);

        return view('marca.marca', compact('marcas'));
    }

    public function create()
    {
        return view('marca.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:2']
        ]);

        $marca = new Marca();
        $marca->nombre = $request->nombre;
        $marca->usuario_id = auth()->user()->id;
        $marca->save();
        notify()->success('Registro creado correctamente', 'Informacion');

        return redirect()->route('marcas');
    }

    public function edit($id)
    {
        $marca = Marca::find($id);

        return view('marca.edit', compact('marca'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:2']
        ]);

        $marca = Marca::find($id);
        $marca->nombre = $request->nombre;
        $marca->usuario_id = auth()->user()->id;
        $marca->update();

        notify()->success('Registro actualizado correctamente', 'Informacion');

        return redirect()->route('marcas');
    }

    public function destroy($id)
    {
        $marca = Marca::find($id);
        $marca->delete();

        notify()->success('Registro eliminado correctamente', 'Informacion');

        return redirect()->route('marcas');
    }
}

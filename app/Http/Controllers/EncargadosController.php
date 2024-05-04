<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encargado;
use App\Models\Estado;
use App\Models\User;

class EncargadosController extends Controller
{
    public function index()
    {
        $encargados = Encargado::orderBy('id', 'asc')->paginate(10);

        return view('encargados.encargados', compact('encargados'));
    }

    public function create()
    {
        $estados = Estado::where('nombre', '=', 'activo')
            ->orwhere('nombre', '=', 'inactivo')
            ->get();

        return view('encargados.create', compact('estados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:2'],
            'email' => ['email'],
            'telefono' => ['numeric', 'min:0']
        ]);

        $encargado = new Encargado();
        $encargado->nombre = $request->nombre;
        $encargado->email = $request->email;
        $encargado->telefono = $request->telefono;
        $encargado->estado_id = $request->estado;
        $encargado->usuario_id = auth()->user()->id;
        $encargado->save();
        notify()->success('Registro creado correctamente', 'Informacion');

        return redirect()->route('encargados');
    }

    public function edit($id)
    {
        $estados = Estado::where('nombre', '=', 'activo')
            ->orwhere('nombre', '=', 'inactivo')
            ->get();
        $encargado = Encargado::find($id);

        return view('encargados.edit', compact('estados', 'encargado'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:2'],
            'email' => ['email'],
            'telefono' => ['numeric', 'min:0']
        ]);

        $encargado = Encargado::find($id);
        $encargado->nombre = $request->nombre;
        $encargado->email = $request->email;
        $encargado->telefono = $request->telefono;
        $encargado->estado_id = $request->estado;
        $encargado->usuario_id = auth()->user()->id;
        $encargado->update();
        notify()->success('Registro actualizado correctamente', 'Informacion');

        return redirect()->route('encargados');

    }

    public function destroy($id)
    {
        $encargado = Encargado::find($id);
        $encargado->delete();
        notify()->success('Registro eliminado correctamente', 'Informacion');

        return redirect()->route('encargados');

    }
}

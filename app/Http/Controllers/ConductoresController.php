<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use App\Models\Estado;
use Illuminate\Http\Request;

class ConductoresController extends Controller
{
    public function index()
    {
        $conductores = Conductor::orderBy('id', 'desc')->paginate(10);

        return view('conductor.conductores', compact('conductores'));
    }

    public function create(Request $request)
    {
        $estados = Estado::where('nombre', '=', 'activo')
            ->orwhere('nombre', '=', 'inactivo')
            ->get();

        return view('conductor.create', compact('estados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:5'],
            'dui' => ['required', 'string', 'min:5'],
            'telefono' => ['required', 'numeric','min:8'],
            'licencia' => ['required', 'string', 'min:5']
        ]);

        $conductor = new Conductor();
        $conductor->nombre = $request->nombre;
        $conductor->dui = $request->dui;
        $conductor->telefono = $request->telefono;
        $conductor->licencia = $request->licencia;
        $conductor->estado_id = $request->estado;
        $conductor->usuario_id = auth()->user()->id;
        $conductor->save();
        //notify()->success('Registro creado correctamente', 'Informacion');

        return redirect()->route('conductores');
    }

    public function edit(Request $request, $id)
    {
        $conductor = Conductor::find($id);

        $estados = Estado::where('nombre', '=', 'activo')
            ->orwhere('nombre', '=', 'inactivo')
            ->get();

        return view('conductor.edit', compact('conductor', 'estados'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:5'],
            'dui' => ['required', 'string', 'min:5'],
            'telefono' => ['required', 'numeric','min:8'],
            'licencia' => ['required', 'string', 'min:5']
        ]);

        $conductor = Conductor::find($id);
        $conductor = new Conductor();
        $conductor->nombre = $request->nombre;
        $conductor->dui = $request->dui;
        $conductor->telefono = $request->telefono;
        $conductor->licencia = $request->licencia;
        $conductor->estado_id = $request->estado;
        $conductor->usuario_id = auth()->user()->id;
        $conductor->update();

        return redirect()->route('conductores');
    }
}

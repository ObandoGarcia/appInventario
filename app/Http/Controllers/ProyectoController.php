<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Encargado;
use App\Models\Estado;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function index()
    {
        $proyectos = Proyecto::orderBy('id', 'asc')->paginate(10);

        return view('proyecto.proyectos', compact('proyectos'));
    }

    public function create()
    {
        $encargados = Encargado::all();
        $estado = Estado::all();

        return view('proyecto.create', compact('encargados', 'estado'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:2'],
            'ubicacion' => ['required', 'string', 'min:2'],
            'fecha_de_inicio' => ['required', 'date'],
            'fecha_de_finalizacion' => ['nullable']
        ]);

        $proyecto = new Proyecto();
        $proyecto->nombre = $request->nombre;
        $proyecto->ubicacion = $request->ubicacion;
        $proyecto->fecha_de_incio = $request->fecha_de_inicio;
        $proyecto->fecha_de_finalizacion = $request->fecha_de_finalizacion;
        $proyecto->estado_id = $request->estado;
        $proyecto->usuario_id = auth()->user()->id;
        $proyecto->save();
        notify()->success('Registro creado correctamente', 'Informacion');

        return redirect()->route('proyectos');
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}

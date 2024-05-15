<?php

namespace App\Http\Controllers;

use App\Models\Boleto;
use App\Models\Conductor;
use App\Models\Maquinaria;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BoletasController extends Controller
{
    public function index()
    {
        $boletas = Boleto::orderBy('id', 'desc')->paginate(10);

        return view('boletas.boletas', compact('boletas'));
    }

    public function create()
    {
        $conductores = Conductor::all();
        $proyectos = Proyecto::all();
        $maquinarias = Maquinaria::all();

        return view('boletas.create', compact('conductores', 'proyectos', 'maquinarias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => ['required', 'date'],
            'cantidad' => ['required', 'min:0'],
            'descripcion' => ['required', 'string'],
            'entregado' => ['required', 'string', 'min:5'],
            'recibido' => ['required', 'string', 'min:5']
        ]);

        $boleto = new Boleto();
        $boleto->conductor_id = $request->conductor;
        $boleto->fecha = $request->fecha;
        $boleto->proyecto_id = $request->proyecto;
        $boleto->maquinaria_id = $request->maquinaria;
        $boleto->cantidad = $request->cantidad;
        $boleto->descripcion = $request->descripcion;
        $boleto->recibido_por = $request->recibido;
        $boleto->entregado_por= $request->entregado;
        $boleto->numero_de_impresiones = 0;
        $boleto->usuario_id = auth()->user()->id;
        $boleto->save();
        //notify()->success('Registro creado correctamente', 'Informacion');

        return redirect()->route('boletas');
    }

    public function show($id)
    {
        $boleto = Boleto::find($id);

        return view('boletas.show', compact('boleto'));
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

    public function create_pdf($id)
    {
        $boleto = Boleto::find($id);
        $boleto->numero_de_impresiones += 1;
        $boleto->update();

        $pdf = Pdf::loadView('boletas.reporte', compact('boleto'));

        return $pdf->stream();
    }
}

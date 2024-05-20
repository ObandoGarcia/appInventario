<?php

namespace App\Http\Controllers;

use App\Models\Boleto;
use App\Models\Conductor;
use App\Models\Herramientas;
use App\Models\Maquinaria;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Proyecto;
use App\Models\Marca;
use App\Models\Material;
use App\Models\Proveedor;

class PanelController extends Controller
{
    public function index()
    {
        $usuarios = User::count();
        $proyectos = Proyecto::count();
        $marcas = Marca::count();
        $proveedores = Proveedor::count();

        //Materiales
        $materiales_totales = Material::count();
        $valor_materiales = Material::sum('valor_total');

        $maquinarias = Maquinaria::count();
        $herramientas = Herramientas::count();
        $conductores = Conductor::count();
        $boletos = Boleto::count();
        return view('paneles.panel', compact(
            'usuarios',
            'proyectos',
            'marcas',
            'proveedores',
            'materiales_totales',
            'maquinarias',
            'herramientas',
            'conductores',
            'boletos',
            'valor_materiales'
        ));
    }
}

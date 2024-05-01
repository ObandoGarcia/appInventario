<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Proyecto;
use App\Models\Marca;

class PanelController extends Controller
{
    public function index()
    {
        $usuarios = User::count();
        $proyectos = Proyecto::count();
        $marcas = Marca::count();
        return view('paneles.panel', compact(
            'usuarios',
            'proyectos',
            'marcas'
        ));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Editorial;

class EditorialController extends Controller
{
    //Validation rules
    private array $validationRules = [
        'name' => ['required', 'string', 'min:3', 'max:25'],
        'phone' => ['required', 'string', 'min:8', 'max:9']
    ];

    private array $errorMessages = [
        'name.required' => 'El nombre es requerido',
        'phone.required' => 'El telefono es requerido',
        'string' => 'Este campo debe ser texto',
        'name.min' => 'Este campo no debe ser menor a 3 caracteres',
        'phone.min' => 'Este campo no debe ser menor a 8 caracteres',
        'name.max' => 'Este campo no debe ser mayor a 25 caracteres',
        'phone.max' => 'Este campo no debe ser mayor a 9 caracteres'
    ];

    //Index method to call the entire list of editorials
    public function index()
    {
        $editorials = Editorial::all();

        return view('editorials.index', compact('editorials'));
    }

    //Create method to call the create page
    public function create(Request $request)
    {
        $request->validate($this->validationRules, $this->errorMessages);

        $editorial = new Editorial();
        $editorial->name = $request->name;
        $editorial->phone = $request->phone;
        $editorial->user_id = auth()->user()->id;

        $result = $editorial->save();

        if($result)
        {
            return redirect()->route('editorials')->with('success', '[Informacion] Registro creado correctamente');
        } 
        else 
        {
            return redirect()->route('editorials')->with('error', '[Informacion] Operacion fallida');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //Validation rules
    private array $validationRules = [
        'firstname' => ['required', 'string', 'min:3', 'max:25'],
        'lastname' => ['required', 'string', 'min:3', 'max:25'],
        'phone' => ['required', 'string', 'min:8', 'max:9'],
        'code' => ['required', 'string', 'min:8', 'max:12']
    ];

    private array $errorMessages = [
        'firstname.required' => 'El nombre es requerido',
        'lastname.required' => 'El apellido es requirido',
        'phone.required' => 'El telefono es requerido',
        'code.required' => 'El codigo es requerido',
        'string' => 'Este campo debe ser texto',
        'firstname.min' => 'Este campo no debe ser menor a 3 caracteres',
        'lastname.min' => 'Este campo no debe ser menor a 3 caracteres',
        'phone.min' => 'Este campo no debe ser menor a 8 caracteres',
        'code.min' => 'Este campo no debe ser menor a 8 caracteres',
        'firstname.max' => 'Este campo no debe ser mayor a 25 carateres',
        'lastname.max' => 'Este campo no debe ser mayor a 25 caracteres',
        'phone.max' => 'El telfono no debe ser mayor a 9 caracteres incluyendo el guion del centro',
        'code.max' => 'El codigo no deber ser mayor a 12 caracteres'
    ];

    //Index method to call the entire list of customer
    public function index()
    {
        $customers = Customer::all();

        return view('customers.index', compact('customers'));
    }

    //Create method to call create page
    public function create()
    {
        return view('customers.create');
    }

    //Store method to save a record to the database
    public function store(Request $request)
    {
        $request->validate($this->validationRules, $this->errorMessages);

        $customer = new Customer();
        $customer->firstname = $request->firstname;
        $customer->lastname = $request->lastname;
        $customer->phone = $request->phone;
        $customer->code = $request->code;
        $customer->user_id = auth()->user()->id;

        $result = $customer->save();

        if($result)
        {
            return redirect()->route('customers')->with('success', '[Informacion] Registro creado correctamente');
        } 
        else 
        {
            return redirect()->route('customers')->with('error', '[Informacion] Operacion fallida');
        }
    }

    //Edit method to call edit page
    public function edit($customer_id)
    {
        $customer = Customer::find($customer_id);

        if($customer == null)
        {
            return redirect()->route('customers')->with('error', '[Error] El registro solicitado no se encuentra en la base de datos');
        }

        return view('customers.edit', compact('customer'));
    }

    //Update method to update a customer from database
    public function update(Request $request, $customer_id)
    {
        $request->validate($this->validationRules, $this->errorMessages);

        $customer = Customer::find($customer_id);

        if($customer == null)
        {
            return redirect()->route('customers')->with('error', '[Error] El registro solicitado no se encuentra en la base de datos');
        }

        $customer->firstname = $request->firstname;
        $customer->lastname = $request->lastname;
        $customer->phone = $request->phone;
        $customer->code = $request->code;

        $result = $customer->update();

        if($result)
        {
            return redirect()->route('customers')->with('success', '[Informacion] Registro actualizado correctamente');
        }
        else
        {
            return redirect()->route('customers')->with('error', '[Informacion] Operacion fallida');
        }
    }

    //Show method to call show page
    public function show($customer_id)
    {
        $customer = Customer::find($customer_id);

        if($customer == null)
        {
            return redirect()->route('customers')->with('error', '[Error] El registro solicitado no se encuentra en la base de datos');
        }

        return view('customers.show', compact('customer'));
    }
    
    //Delete method
    public function delete($customer_id)
    {
        $customer = Customer::find($customer_id);

        if ($customer != null) {
            $customer->delete();

            return redirect()->route('customers')->with('success', '[Informacion] Registro eliminado correctamente');
        } 
        else
        {
            return redirect()->route('customers')->with('error', '[Error] El registro solicitado no se encuentra en la base de datos');
        }
    }
}



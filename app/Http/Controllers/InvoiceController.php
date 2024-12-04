<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceBook;
use App\Models\Book;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    //Validation rules
    private array $validationRules = [
        'invoice_number' => ['required', 'string'],
        'internal_code' => ['required', 'string'],
        'customers' => ['required']
    ];

    private array $errorMessages = [
        'invoice_number.required' => 'El numero de factura es requerido',
        'invoice_number.string' => 'El numero de factura solo debe contener letras o numeros',
        'internal_code.required' => 'El codigo interno es requerido',
        'internal_code.string' => 'El codiog interno solo debe contener letras o numeros',
        'customers' => 'El cliente es requirido'
    ];

    //Index method to call the entire list of invoices
    public function index()
    {
        $invoices = Invoice::orderBy('id', 'desc')->paginate(10);

        return view('invoices.index', compact('invoices'));
    }

    //Search method
    public function searchInvoice(Request $request)
    {
        $searchField = "";

        if($request->search)
        {
            $searchField = $request->search;
            $invoices = Invoice::search($searchField)->paginate(5);

            return view('invoices.index', compact('invoices'));
        }
    }

    //Create method to call the create page
    public function create()
    {
        $customers = Customer::all();

        return view('invoices.create', compact('customers'));
    }

    //Store method to save a record to the database
    public function store(Request $request)
    {
        $request->validate($this->validationRules, $this->errorMessages);

        $invoice = new Invoice();
        $invoice->invoice_number = $request->invoice_number;
        $invoice->internal_code = $request->internal_code;
        $invoice->state = 'pendiente de pago';
        $invoice->customer_id = $request->customers;
        $invoice->user_id = auth()->user()->id;

        $result = $invoice->save();

        if($result)
        {
            return redirect()->route('invoices')->with('success', '[Informacion] Registro creado correctamente');
        }
        else
        {
            return redirect()->route('invoices')->with('error', '[Informacion] Operacion fallida');
        }
    }

    //Edit method to call edit page
    public function edit($invoice_id)
    {   
        $invoice = Invoice::find($invoice_id);

        $customers = Customer::all();

        if($invoice == null)
        {
            return redirect()->route('invoices')->with('error', '[Error] El registro solicitado no se encuentra en la base de datos');
        }

        return view('invoices.edit', compact('invoice', 'customers'));
    }

    //Update method to update a invoice from database
    public function update(Request $request, $invoice_id)
    {
        $request->validate($this->validationRules, $this->errorMessages);
        
        $invoice = Invoice::find($invoice_id);
        
        if($invoice == null)
        {
            return redirect()->route('invoices')->with('error', '[Error] El registro solicitado no se encuentra en la base de datos');
        }

        $invoice->invoice_number = $request->invoice_number;
        $invoice->internal_code = $request->internal_code;
        $invoice->customer_id = $request->customers;
        $invoice->user_id = auth()->user()->id;

        $result = $invoice->update();

        if($result)
        {
            return redirect()->route('invoices')->with('success', '[Informacion] Registro actualizado correctamente');
        }
        else
        {
            return redirect()->route('invoices')->with('error', '[Informacion] Operacion fallida');
        }
    }    

    //Show method to call show page
    public function show($invoice_id)
    {
        $invoice = Invoice::find($invoice_id);
        
        if($invoice == null)
        {
            return redirect()->route('invoices')->with('error', '[Error] El registro solicitado no se encuentra en la base de datos');
        }

        return view('invoices.show', compact('invoice'));
    }

    //Delete method
    public function delete($invoice_id)
    {
        $invoice = Invoice::find($invoice_id);

        //Ssearch for detail records
        $invoice_books = InvoiceBook::where('invoice_id', $invoice_id);

        if($invoice_books != null)
        {
            foreach($invoice_books as $ib)
            {
                $ib->delete();
            }
        }

        if($invoice != null)
        {
            $invoice->delete();
            
            return redirect()->route('invoices')->with('success', '[Informacion] Registro elimiando correctamente. Sus datos asociados tambien se eliminaron correctamente');
        }else
        {
            return redirect()->route('invoices')->with('error', '[Informacion] Operacion fallida');
        }
    }
    
    //Cancel method to call cancel view
    public function cancel($invoice_id)
    {
        $invoice = Invoice::find($invoice_id);

        if($invoice == null)
        {
            return redirect()->route('invoices')->with('error', '[Error] El registro solicitado no se encuentra en la base de datos');
        }

        return view('invoices.cancel', compact('invoice'));
    }

    //Change state method to set 'anulada' state to a invoice 
    public function changeStateToInvalid($invoice_id)
    {
        $invoice = Invoice::find($invoice_id);

        if($invoice == null)
        {
            return redirect()->route('invoices')->with('error', '[Error] El registro solicitado no se encuentra en la base de datos');
        }

        $invoice->state = "anulada";
        $result = $invoice->update();

        $inovoice_detail = $invoice->invoice_number;

        if($result)
        {
            return redirect()->route('invoices')->with('success', '[Informacion] La factura '.  $inovoice_detail  .' ha sido anulada corectamente correctamente');
        }
        else
        {
            return redirect()->route('invoices')->with('error', '[Informacion] Operacion fallida');
        }
    }

    //Change state method to set 'pagada' state to a invoice
    public function changeStateToPaid($invoice_id)
    {
        $invoice = Invoice::find($invoice_id);

        if($invoice == null)
        {
            return redirect()->route('invoices')->with('error', '[Error] El registro solicitado no se encuentra en la base de datos');
        }

        $invoice->state = 'pagado';
        $result = $invoice->update();

        if($result)
        {
            return redirect()->route('invoices')->with('success', '[Informacion] Registro actualizado correctamente');
        }
        else
        {
            return redirect()->route('invoices')->with('error', '[Informacion] Operacion fallida');
        }

    }
}

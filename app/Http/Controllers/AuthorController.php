<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    //Validation rules
    private array $validationRules = [
        'firstname' => ['required', 'string', 'min:3', 'max:25'],
        'lastname' => ['required', 'string', 'min:3', 'max:25'],
        'nationality' => ['required', 'string', 'min:3', 'max:25']
    ];

    private array $errorMessages = [
        'firstname.required' => 'El nombre es requerido',
        'lastname.required' => 'El apellido es requerido',
        'nationality.required' => 'La nacionalidad es requerida',
        'string' => 'Este campo debe ser texto',
        'min' => 'Este campo debe ser mayor a 3 caracteres',
        'max' => 'Este campo no debe ser mayor a 25 caracteres'
    ];


    //Index method to call the entire list of authors
    public function index()
    {
        $authors = Author::all();

        return view('authors.index', compact('authors'));
    }

    //Create method to call the create page
    public function create()
    {
        return view('authors.create');
    }

    //Store method to save a record to the database
    public function store(Request $request)
    {
        $request->validate($this->validationRules, $this->errorMessages);

        $author = new Author();
        $author->firstname = $request->firstname;
        $author->lastname = $request->lastname;
        $author->nationality = $request->nationality;
        $author->user_id = auth()->user()->id;

        $result = $author->save();

        if($result)
        {
            return redirect()->route('authors')->with('success', '[Informacion] Registro creado correctamente');
        } 
        else 
        {
            return redirect()->route('authors')->with('error', '[Informacion] Operacion fallida');
        }
    }

    //Edit method to call edit page
    public function edit($author_id)
    {
        $author = Author::find($author_id);

        if($author == null)
        {
            return redirect()->route('authors')->with('error', '[Error] El registro solicitado no se encuentra en la base de datos');
        }

        return view('authors.edit', compact('author'));
    }

    //Update method to update an author from database
    public function update(Request $request, $author_id)
    {
        $request->validate($this->validationRules, $this->errorMessages);

        $author = Author::find($author_id);

        if($author == null)
        {
            return redirect()->route('authors')->with('error', '[Error] El registro solicitado ha sido eliminado de la base de datos');
        }

        $author->firstname = $request->firstname;
        $author->lastname = $request->lastname;
        $author->nationality = $request->nationality;
        $author->user_id = auth()->user()->id;
        
        $result = $author->update();

        if($result)
        {
            return redirect()->route('authors')->with('success', '[Informacion] Registro actualizado correctamente');
        }
        else
        {
            return redirect()->route('authors')->with('error', '[Informacion] Operacion fallida');
        }
        
    }

    //Show method to call show page
    public function show($author_id)
    {
        $author = Author::find($author_id);

        if ($author == null) {
            return redirect()->route('authors')->with('error', '[Error] El registro solicitado no se encuentra en la base de datos');
        }

        return view('authors.show', compact('author'));
    }


    //Delete method
    public function delete($author_id)
    {
        $author = Author::find($author_id);

        if ($author != null) {
            $author->delete();

            return redirect()->route('authors')->with('success', '[Informacion] Registro eliminado correctamente');
        } 
        else
        {
            return redirect()->route('authors')->with('error', '[Error] El registro solicitado no se encuentra en la base de datos');
        }
    }
}

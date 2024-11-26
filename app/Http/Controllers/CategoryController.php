<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //Validation rules
    private array $validationRules = [
        'category' => ['required', 'string', 'min:3', 'max:25'],
        'description' => ['required', 'string', 'min:15', 'max:255']
    ];

    private array $errorMessages = [
        'category.required' => 'La categoria es requerida',
        'description.required' => 'La descripcion es requerida',
        'string' => 'Este campo debe ser texto',
        'category.min' => 'Este campo no debe ser menor a 3 caracteres',
        'description.min' => 'Este campo no debe ser menor a 15 caracteres',
        'category.max' => 'Este campo no debe ser mayor a 25 caracteres',
        'description.max' => 'Este campo no debe ser mayor a 255 caracteres'
    ];

    //Index method to call the entire list of categories
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    //Create method to call the create page
    public function create()
    {
        return view('categories.create');
    }

    //Store method to save a record to the database
    public function store(Request $request)
    {
        $request->validate($this->validationRules, $this->errorMessages);

        $category = new Category();
        $category->category = $request->category;
        $category->description = $request->description;
        $category->user_id = auth()->user()->id;

        $result = $category->save();

        if($result)
        {
            return redirect()->route('categories')->with('success', '[Informacion] Registro creado correctamente');
        } 
        else 
        {
            return redirect()->route('categories')->with('error', '[Informacion] Operacion fallida');
        }
    }

    //Edit method to call edit page
    public function edit($category_id)
    {
        $category = Category::find($category_id);

        if($category == null)
        {
            return redirect()->route('categories')->with('error', '[Error] El registro solicitado no se encuentra en la base de datos');
        }

        return view('categories.edit', compact('category'));
    }

    //Update method to update a category from database
    public function update(Request $request, $category_id)
    {
        $request->validate($this->validationRules, $this->errorMessages);

        $category = Category::find($category_id);
        
        if($category == null)
        {
            return redirect()->route('categories')->with('error', '[Error] El registro solicitado no se encuentra en la base de datos');
        }

        $category->category = $request->category;
        $category->description = $request->description;
        $category->user_id = auth()->user()->id;

        $result = $category->update();

        if($result)
        {
            return redirect()->route('categories')->with('success', '[Informacion] Registro actualizado correctamente');
        }
        else
        {
            return redirect()->route('categories')->with('error', '[Informacion] Operacion fallida');
        }
    }

    //Show method to call show page
    public function show($category_id)
    {
        $category = Category::find($category_id);

        if($category == null)
        {
            return redirect('categories')->with('error', '[Error] El registro solicitado no se encuentra en la base de datos');
        }

        return view('categories.show', compact('category'));
    }

    //Delete method
    public function delete($category_id)
    {
        $category = Category::find($category_id);

        if($category != null)
        {
            $category->delete();

            return redirect()->route('categories')->with('success', '[Informacion] Registro eliminado correctamente');
        }
        else
        {
            return redirect()->route('categories')->with('error', '[Informacion] Operacion fallida');
        }
    }
}

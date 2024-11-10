<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Editorial;

class BookController extends Controller
{
    //Profit percentaje per book
    private $profitPercentage = 0.1;

    //Validation rules
    private array $validationRules = [
        'title' => ['required', 'string', 'min:3', 'max:75'],
        'internal_code' => ['nullable', 'string', 'min:5', 'max:15'],
        'isbn' => ['nullable', 'string', 'min:13'],
        'image' => ['max:2048', 'image'],
        'quantity' => ['required', 'numeric', 'min:0'],
        'cost' => ['required', 'min:0'],
        'entry_date' => ['nullable', 'date'],
        'authors' => ['nullable'],
        'categories' => ['nullable'],
        'editorials' => ['nullable']
    ];

    private array $errorMessages = [
        'title.required' => 'El tiltulo es requerido',
        'quantity.required' => 'La cantidad es requerida',
        'cost.required' => 'El costo de compra es requerido',
        'image.max' => 'El tamanio maximo de la imagen es de 2048 mb',
        'string' => 'Este campo debe ser texto',
        'title.min' => 'Este campo debe ser mayor a 3 caracteres',
        'internal_code.min' => 'Este campo debe ser mayor a 5 caracteres',
        'isbn.min' => 'Este campo debe ser mayor a 12 caracteres',
        'quantity.min' => 'Este campo no puede ser menor a 0',
        'cost.min' => 'Este campo no debe ser menor a 0',
        'title.max' => 'Este campo no debe se mayor a 75 caracteres',
        'internal_code.max' => 'Este campo no debe ser mayor a 15 caracteres',
        'numeric' => 'Este campo debe ser numerico',
        'date' => 'Este campo debe ser una fecha',
        'image' => 'El archivo debe ser una imagen'
    ];

    //Index method to call the entire list of books
    public function index()
    {
        $books = Book::orderBy('id', 'desc')->paginate(10);

        return view('books.index', compact('books'));
    }

    //Create method to call the create page
    public function create()
    {
        //Search for all authors
        $authors = Author::all();

        //Search for all categories
        $categories = Category::all();

        //Search for all editorials
        $editorials = Editorial::all();

        return view('books.create', compact('authors', 'categories', 'editorials'));
    }

    //Store method to sava a record to the database
    public function store(Request $request)
    {
        $request->validate($this->validationRules, $this->errorMessages);

        $book = new Book();
        $book->title = $request->title;
        $book->internal_code = $request->internal_code;
        $book->isbn = $request->isbn;
        
        //Image validation
        if($request->hasFile('image'))
        {
            $image_url = $request->file('image')->store('public/img/books');
            $url = Storage::url($image_url);

            $book->image_url = $url;
        }

        $book->quantity = $request->quantity;
        $book->available = $request->quantity;
        $book->cost = $request->cost;
        $book->sale_price = $request->cost + ($request->cost * $this->profitPercentage);
        $book->state = $request->state;
        $book->entry_date = $request->entry_date;
        $book->author_id = $request->authors;
        $book->category_id = $request->categories;
        $book->editorial_id = $request->editorials;
        $book->user_id = auth()->user()->id;

        $result = $book->save();

        if($result)
        {
            return redirect()->route('books')->with('success', '[Informacion] Registro creado correctamente');
        }
        else
        {
            return redirect()->route('books')->with('error', '[Informacion] Operacion fallida');
        }
    }

    //Edit method to call edit page
    public function edit($book_id)
    {
        $book = Book::find($book_id);

        //Search for all authors
        $authors = Author::all();

        //Search for all categories
        $categories = Category::all();

        //Search for all editorials
        $editorials = Editorial::all();

        if($book == null)
        {
            return view('books.index')->with('error', '[Error] El registro solicitado no se encuentra en la base de datos');
        }

        return view('books.edit', compact('book', 'authors', 'categories', 'editorials'));
    }

    //Update method to update a book from database
    public function update(Request $request, $book_id)
    {
        $request->validate($this->validationRules, $this->errorMessages);

        $book = Book::find($book_id);

        if($book == null)
        {
            return view('books.index')->with('error', '[Error] El registro solicitado no se encuentra en la base de datos');
        }

        $book->title = $request->title;
        $book->internal_code = $request->internal_code;
        $book->isbn = $request->isbn;
        
        //Image validation
        if($request->hasFile('image'))
        {
            //Delete current image
            $url = str_replace('/storage', 'public', $book->image_url);
            Storage::delete($url);

            //Store new image
            $image_url = $request->file('image')->store('public/img/books');
            $url = Storage::url($image_url);

            $book->image_url = $url;
        }

        $book->quantity = $request->quantity;
        $book->available = $request->quantity;
        $book->cost = $request->cost;
        $book->sale_price = $request->cost + ($request->cost * $this->profitPercentage);
        $book->state = $request->state;
        $book->entry_date = $request->entry_date;
        $book->author_id = $request->authors;
        $book->category_id = $request->categories;
        $book->editorial_id = $request->editorials;
        $book->user_id = auth()->user()->id;

        $result = $book->update();

        if($result)
        {
            return redirect()->route('books')->with('success', '[Informacion] Registro actualizado correctamente');
        }
        else
        {
            return redirect()->route('books')->with('error', '[Informacion] Operacion fallida');
        }

    }
}

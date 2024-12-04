<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Invoice;
use App\Models\InvoiceBook;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceBookController extends Controller
{
    //Validation rules
    private array $validationRules = [
        'books' => ['required']
    ];

    private array $errorMessages = [
        'books.required' => 'El libro es obligatorio'
    ];

    //Detail methods to call the detail page
    public function invoiceDetail($invoice_id)
    {
        $invoice = Invoice::find($invoice_id);

        $invoice_book = InvoiceBook::where('invoice_id', $invoice_id)->get();

        //Update price for all books on the list
        foreach($invoice_book as $ib)
        {
            $ib->total_price = $ib->quantity * $ib->price;
            $ib->update();
        }

        return view('invoices_books.index', compact('invoice', 'invoice_book'));
    }

    //Method to call add page
    public function addBookInvoice($invoice_id)
    {   
        $invoice = Invoice::find($invoice_id);
        $books = Book::all();

        return view('invoices_books.add', compact('invoice', 'books'));
    }

    //Method to save book detail in to invoice detail
    public function saveBookInvoice(Request $request, $invoice_id)
    {
        $request->validate($this->validationRules, $this->errorMessages);

        $invoice_book = new InvoiceBook();
        $invoice_book->invoice_id = $invoice_id;
        $invoice_book->book_id = $request->books;
        $invoice_book->quantity = 0;

        $invoice_book->price = $this->getBookPrice($request->books);
        $invoice_book->total_price = 0;

        $invoice_book->user_id = auth()->user()->id;

        $invoice_book_saved = InvoiceBook::where('invoice_id', $invoice_id)->get();

        foreach($invoice_book_saved as $ibs)
        {
            if($request->books == $ibs->book_id)
            {
                return redirect()->route('invoice_detail', $invoice_id)->with('error', '[Informacion] El libro ya fue agregado a la lista'); 
            }
        }

        $invoice_book->save();

        return redirect()->route('invoice_detail', ['invoice_id' => $invoice_book->invoice_id])->with('success', '[Informacion] Libro agregado a la factura correctamente'); 
    }

    //Get price invoice detail
    public function getBookPrice($book_id)
    {
        $book = Book::find($book_id);
        $price = $book->sale_price;

        return $price;
    }

    //Method to add book in to invoice
    public function increaseBookQuantityToInvoice(Request $request, $invoice_id)
    {
        $request->validate([
            'quantity' => ['required', 'min:0']
        ]);

        $invoice_book = InvoiceBook::find($invoice_id);
        $invoice_book->quantity += $request->quantity;
        $invoice_book->update();

        $this->updateBookquantity($invoice_book->book_id, $request->quantity);

        return redirect()->route('invoice_detail', $invoice_book->invoice_id)->with('success', '[Informacion] Cantidad agregada correctamente'); 
    }

    //Method to update book quantity then is added form inovice detail
    public function updateBookquantity($book_id, $quantity)
    {
        $book = Book::find($book_id);
        $book->available -= $quantity;
        $book->update();
    }

    //Method to decrement books
    public function decrementBookQuantityToInvoice(Request $request, $invoice_id)
    {
        $request->validate([
            'delquantity' => ['required', 'min:0']
        ]);

        $invoice_book = InvoiceBook::find($invoice_id);
        $invoice_book->quantity -= $request->delquantity;
        $invoice_book->update();

        $this->updateBookquantityReturned($invoice_book->book_id, $request->delquantity);

        return redirect()->route('invoice_detail', $invoice_book->invoice_id)->with('success', '[Informacion] Cantidad quitada correctamente'); 
    }

    //Method to call delete page
    public function delete($invoiceBook_id)
    {
        $invoice_book = InvoiceBook::find($invoiceBook_id);

        return view('invoices_books.remove', compact('invoice_book'));
    }

    //Method to delete book from the invoice list
    public function deleteInvoiceBook($inovice_book_id)
    {
        $invoice_book = InvoiceBook::find($inovice_book_id);

        if($invoice_book == null)
        {
            return redirect()->route('invoice_detail', $invoice_book->invoice_id)->with('success', '[Informacion] El registro que intentas eliminar ya fue eliminado');
        }

        $this->updateBookquantityReturned($invoice_book->book_id, $invoice_book->quantity);

        $invoice_book->delete();

        return redirect()->route('invoice_detail', $invoice_book->invoice_id)->with('success', '[Informacion] El registro se quito correctamente');
    }

    //Method to update book quantity then is deleted from invoice detail
    public function updateBookquantityReturned($book_id, $quantity)
    {
        $book = Book::find($book_id);
        $book->available += $quantity;
        $book->update();
    }

    //Create PDF document
    public function createPDF($invoice_id)
    {
        $invoice_book = InvoiceBook::where('invoice_id', $invoice_id)->get();
        $invoice = Invoice::find($invoice_id);
        $invoice_total_price = InvoiceBook::where('invoice_id', $invoice_id)->sum('total_price');

        date_default_timezone_set("America/El_Salvador");
        $fecha = date("Y-m-d H:m:s");

        $pdf = Pdf::loadView('invoices_books.invoice', compact('invoice_book', 'invoice', 'invoice_total_price', 'fecha'));

        return $pdf->stream();
    }
}

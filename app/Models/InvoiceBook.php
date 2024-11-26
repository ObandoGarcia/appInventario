<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceBook extends Model
{
    use HasFactory;

    protected $table = 'invoices_books';

    //Creating relationships to database tables
    //Relationship between the "invoices_books" table and the "users" table
    public function users():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    //Relationship between the "invoices_books" table and the "invoices" table
    public function invoices():BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id')->withDefault();
    }

    //Relationship between the "invoices_books" table and the "books" table
    public function books():BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id')->withDefault();
    }
}

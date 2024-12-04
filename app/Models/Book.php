<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Book extends Model
{
    use HasFactory;
    use Searchable;

    protected $table = 'books';

    //Using Laravel Scout
    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
            'internal_code' => $this->internal_code,
            'isbn' => $this->isbn,
            'entry_date' => $this->entry_date
        ];
    }

    //Creating relationships to database tables
    //Relationship between the "books" table and the "users" table
    public function users():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    //Relationship between the "books" table and the "authors" table
    public function authors():BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id')->withDefault();
    }

    //Relationship between the "0books" table and the "categories" table
    public function categories():BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault();
    }

    //Relationship between the "books" table and the "editorials" table
    public function editorials():BelongsTo
    {
        return $this->belongsTo(Editorial::class, 'editorial_id')->withDefault();
    }
}

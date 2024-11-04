<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    //Creating relationships to database tables
    //Relationship between the "categories" table and the "users" table
    public function users():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
}

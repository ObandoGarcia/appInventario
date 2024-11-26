<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    //Creating relationships to database tables
    //Relationship between the "authors" table and the "users" table
    public function users():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
}


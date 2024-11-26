<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    //Creating relationships to database tables
    //Relationship between the "invoices" table and the "users" table
    public function users():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    //Relationship between the "invoices" table and the "customers" table
    public function customers():BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id')->withDefault();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Invoice extends Model
{
    use HasFactory;
    use Searchable;

    protected $table = 'invoices';

    public function toSearchableArray(): array
    {
        return [
            'invoice_number' => $this->invoice_number,
            'internal_code' => $this->internal_code,
            'created_at' => $this->created_at
        ];
    }

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

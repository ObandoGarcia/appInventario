<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'estados';

    //Relaciones
    //Relacion estado usuario
    public function usuario():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //Relacion material y estado
    public function estado():HasMany
    {
        return $this->hasMany(Material::class);
    }
}

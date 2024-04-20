<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Marca extends Model
{
    use HasFactory;

    protected $table = 'marcas';

    //Relaciones
    //Relacion de uno a muchos entre marcas y usuario
    public function usuario():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //Relacion de uno a muchos entre marca y materiales
    public function marcas():HasMany
    {
        return $this->hasMany(Marca::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conductor extends Model
{
    use HasFactory;

    protected $table = 'conductores';

    //Relaciones
    //Relacion entre conductores y usuarios
    public function usuarios():BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id')->withDefault();
    }

    //Relacion entre conductores y estados
    public function estados():BelongsTo
    {
        return $this->belongsTo(Estado::class, 'estado_id')->withDefault();
    }

    //Relacion entre conductores y boletas
    public function boletas():HasMany
    {
        return $this->hasMany(Boleto::class);
    }
}

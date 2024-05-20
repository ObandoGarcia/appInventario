<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';

    //Relaciones
    //Relacion entre estado y usuario
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id')->withDefault();
    }

    //Relacion entre encargados y proyectos
    public function encargados(): BelongsTo
    {
        return $this->belongsTo(Encargado::class, 'encargado_id')->withDefault();
    }

    //Relacion entre estado y proyectos
    public function estado(): BelongsTo
    {
        return $this->belongsTo(Estado::class, 'estado_id')->withDefault();
    }

    //Relacion entre proyecto y boletas
    public function boletas():HasMany
    {
        return $this->hasMany(Boleto::class);
    }

    //Relacion entre proyectos y materiales
    public function proyectos_materiales():HasMany
    {
        return $this->hasMany(ProyectosMateriales::class);
    }
}

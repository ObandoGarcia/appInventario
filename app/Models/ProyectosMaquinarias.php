<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProyectosMaquinarias extends Model
{
    use HasFactory;

    protected $table = 'projectos_maquinaria';

    //Relaciones
    //Relaciones entre proyectos y maquinaria
    public function proyectos(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id')->withDefault();
    }

    //Relacion entre maquinarias
    public function maquinarias(): BelongsTo
    {
        return $this->belongsTo(Maquinaria::class, 'maquinaria_id')->withDefault();
    }
}

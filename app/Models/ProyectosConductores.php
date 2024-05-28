<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProyectosConductores extends Model
{
    use HasFactory;

    protected $table = 'proyectos_conductores';

    //Relaciones
    //Relacion entre proyectos conductores y proyectos
    public function proyectos(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id')->withDefault();
    }

    //Relacion entre proyectos conductores y conductores
    public function conductores(): BelongsTo
    {
        return $this->belongsTo(Conductor::class, 'conductor_id')->withDefault();
    }
}

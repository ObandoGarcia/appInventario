<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProyectosHerramientas extends Model
{
    use HasFactory;

    protected $table = 'proyectos_herramientas';

    //Relaciones
    //Relaciones entre proyectos herramientas y proyecto
    public function proyectos(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id')->withDefault();
    }

    //Relacion entre proyectos herramientas y herramientas
    public function herramientas(): BelongsTo
    {
        return $this->belongsTo(Herramientas::class, 'herramienta_id')->withDefault();
    }
}

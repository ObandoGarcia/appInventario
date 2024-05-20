<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProyectosMateriales extends Model
{
    use HasFactory;

    protected $table = 'projectos_materiales';

    //Relaciones
    //Relacion entre proyectos y materiales
    public function proyectos(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id')->withDefault();
    }

    public function materiales(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'material_id')->withDefault();
    }
}

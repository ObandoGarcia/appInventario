<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Encargado extends Model
{
    use HasFactory;

    protected $table = 'encargados_de_proyectos';

    //Relaciones
    //Relacione entre usuario y encargados
    public function usuario():BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id')->withDefault();
    }

    //Relaciones entre estados y encargados de proyecto
    public function estados():BelongsTo
    {
        return $this->belongsTo(Estado::class, 'estado_id')->withDefault();
    }

    //Relacion entre
    public function proyectos():HasMany
    {
        return $this->hasMany(Proyecto::class);
    }
}

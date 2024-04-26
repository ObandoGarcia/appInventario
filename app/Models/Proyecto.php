<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';

    //Relaciones
    //Relacion entre encargados y proyectos
    public function encargados():BelongsTo
    {
        return $this->belongsTo(Encargado::class, 'encargado_id')->withDefault();
    }

    //Relacion entre estado y proyectos
    public function estado():BelongsTo
    {
        return $this->belongsTo(Estado::class, 'estado_id')->withDefault();
    }

    //Relacion entre estado y usuario
    public function usuario():BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id')->withDefault();
    }
}

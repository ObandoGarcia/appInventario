<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Boleto extends Model
{
    use HasFactory;

    protected $table = 'boletas';

    //Relaciones
    //Relacion entre Boletas y conductores
    public function conductor():BelongsTo
    {
        return $this->belongsTo(Conductor::class, 'conductor_id')->withDefault();
    }

    //Relacion entre Boletas y proyecto
    public function proyecto():BelongsTo
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id')->withDefault();
    }

    ///Relacion entre Boletas y Maquinarias
    public function maquinaria():BelongsTo
    {
        return $this->belongsTo(Maquinaria::class, 'maquinaria_id')->withDefault();
    }

    //Relacion entre Boletas y usuarios
    public function usuarios():BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id')->withDefault();
    }
}

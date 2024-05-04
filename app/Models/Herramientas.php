<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Herramientas extends Model
{
    use HasFactory;

    protected $table = 'herramientas';

    //Relaciones
    //Relacion entre herramientas y marcas
    public function marcas():BelongsTo
    {
        return $this->belongsTo(Marca::class, 'marca_id')->withDefault();
    }

    //Relacion entre herramientas y estados
    public function estados():BelongsTo
    {
        return $this->belongsTo(Estado::class, 'estado_id')->withDefault();
    }

    ///Relacion entre herramientas y proveedores
    public function proveedores():BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id')->withDefault();
    }

    //Relacion entre herramientas y usuarios
    public function usuarios():BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id')->withDefault();
    }
}

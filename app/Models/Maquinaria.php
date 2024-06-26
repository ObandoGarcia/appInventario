<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Maquinaria extends Model
{
    use HasFactory;

    protected $table = 'maquinarias';

    //Relaciones entre las tablas
    //Relacion entre maquinarias y marcas
    public function marcas():BelongsTo
    {
        return $this->belongsTo(Marca::class, 'marca_id')->withDefault();
    }

    //Relacion entre maquinaria y estado
    public function estados():BelongsTo
    {
        return $this->belongsTo(Estado::class, 'estado_id')->withDefault();
    }

    //Relacines entre maquinarias y proveedores
    public function proveedores():BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id')->withDefault();
    }

    //Relaciones entre maquinarias y estados
    public function usuarios():BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id')->withDefault();
    }

    //Relacione entre maquinaria y boletas
    public function boletas():HasMany
    {
        return $this->hasMnay(Boleto::class);
    }

    //Relacion entre proyectos y maquinarias
    public function proyectos_maquinarias():HasMany
    {
        return $this->hasMany(ProyectosMaquinarias::class);
    }
}


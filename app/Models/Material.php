<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materiales';

    //Relaciones
    //Relacion de uno a muchos entre materiales y usuarios
    public function usuario():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //Relacion de uno a muchos entre materiales y marca
    public function marcas():BelongsTo
    {
        return $this->belongsTo(Marca::class, 'marca_id')->withDefault();
    }

    //Relacion de uno a muchos entre materiales y estados
    public function estados():BelongsTo
    {
        return $this->belongsTo(Estado::class, 'estado_id')->withDefault();
    }

    //Relacion entre materiales y proveedores
    public function proveedores():BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id')->withDefault();
    }
}

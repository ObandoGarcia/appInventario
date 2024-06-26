<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Material extends Model
{
    use HasFactory;
    use Searchable;

    protected $table = 'materiales';

    public function toSearchableArray(): array
    {
        return [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'medida' => $this->medida
        ];
    }

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

    //Relacion entre materiales y proyectos
    public function proyectos_materiales():HasMany
    {
        return $this->hasMany(ProyectosMateriales::class);
    }
}

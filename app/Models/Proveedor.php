<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    //Relaciones
    //Relacion de uno a muchos entre usuario y proveedores
    public function usuario():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //Relacion entre proveedor y material
    public function material():HasMany
    {
        return $this->hasMany(Material::class);
    }

    //Relacione entre proveedor y maquinarias
    public function maquinarias():HasMany
    {
        return $this->hasMany(Maquinaria::class);
    }

    //Relacion entre proveedor y herramientas
    public function herramientas():HasMany
    {
        return $this->hasMany(Herramientas::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'estados';

    //Relaciones
    //Relacion estado usuario
    public function usuario():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //Relacion material y estado
    public function material():HasMany
    {
        return $this->hasMany(Material::class);
    }

    //Relacion entre encargado y estado
    public function encargado():HasMany
    {
        return $this->hasMany(Encargado::class);
    }

    //Relacion entre estados y proyectos
    public function proyectos():HasMany
    {
        return $this->hasMany(Proyecto::class);
    }

    //Relacion entre estados y maqunarias
    public function maquinarias():HasMany
    {
        return $this->hasMany(Maquinaria::class);
    }
}

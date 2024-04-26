<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Marcas
    public function marcas():HasMany
    {
        return $this->hasMany(Marca::class);
    }

    //Estados
    public function estados():HasMany
    {
        return $this->hasMany(Estado::class);
    }

    //Proveedores
    public function proveedores():HasMany
    {
        return $this->hasMany(Proveedor::class);
    }

    //Materiales
    public function materiales():HasMany
    {
        return $this->hasMany(Material::class);
    }

    //Encargados de proyecto
    public function encargados():HasMany
    {
        return $this->hasMany(Encargado::class);
    }

    //Proyectos
    public function proyectos():HasMany
    {
        return $this->hasMany(Proyecto::class);
    }
}

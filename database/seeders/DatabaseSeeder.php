<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Estado;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $usuario = new User();
        $usuario->name = 'Jose Obando';
        $usuario->email = 'obandogarcia10635@gmail.com';
        $usuario->password = Hash::make('ecuacion');
        $usuario->save();

        $rol1 = Role::create(['name' => 'administrador']);
        $rol2 = Role::create(['name' => 'editor']);
        $rol3 = Role::create(['name' => 'usuario']);

        $usuario = User::find(1);
        $usuario->assignRole($rol1);

        $estado = Estado::create(['nombre' => 'activo', 'usuario_id' => 1]);
        $estado1 = Estado::create(['nombre' => 'inactivo', 'usuario_id' => 1]);
        $estado2 = Estado::create(['nombre' => 'completado', 'usuario_id' => 1]);
        $estado3 = Estado::create(['nombre' => 'cancelado', 'usuario_id' => 1]);
        $estado4 = Estado::create(['nombre' => 'nuevo', 'usuario_id' => 1]);
        $estado5 = Estado::create(['nombre' => 'usado', 'usuario_id' => 1]);
        $estado6 = Estado::create(['nombre' => 'alquiler', 'usuario_id' => 1]);
    }
}

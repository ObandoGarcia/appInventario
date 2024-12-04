<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $usuario = new User();
        $usuario->name = 'Administrador';
        $usuario->email = 'administrador@admin.com';
        $usuario->password = Hash::make('administrador');
        $usuario->save();

        $usuario2 = new User();
        $usuario2->name = 'Usuario';
        $usuario2->email = 'usuario@user.com';
        $usuario2->password = Hash::make('usuario');
        $usuario2->save();

        $rol1 = Role::create(['name' => 'administrador']);
        $rol2 = Role::create(['name' => 'usuario']);

        $usuario = User::find(1);
        $usuario->assignRole($rol1);

        $usuario2 = User::find(2);
        $usuario2->assignRole($rol2);
    }
}

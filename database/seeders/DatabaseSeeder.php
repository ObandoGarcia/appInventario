<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function iniciar_sesion(Request $request)
    {
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        $credenciales = request()->only('email', 'password');

        if(Auth::attempt($credenciales))
        {
            request()->session()->regenerateToken();
            //notify()->success('Has iniciado sesion correctamente', 'Informacion');
            return redirect('dashboard');
        }

        return view('login');
    }

    public function cerrar_sesion(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        request()->session()->regenerateToken();
        //notify()->success('Has cerrado sesion', 'Informacion');

        return redirect()->route('bienvenido');
    }

    public function index()
    {
        $usuarios = User::paginate(10);

        return view('user.usuarios', compact('usuarios'));
    }

    //Editar usuario
    public function update(Request $request, $usuarioId)
    {
        $request->validate([
            'email' => ['required','email'],
            'name' => ['required']
        ]);

        $usuario = User::find($usuarioId);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->update();

        return redirect()->route('usuarios');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function start_session(Request $request):mixed
    {
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        $credentials = request()->only('email', 'password');

        if(Auth::attempt($credentials))
        {
            request()->session()->regenerateToken();
            return redirect('dashboard')->with('success', 'Bienvenido. Has iniciado sesion correctamente.');
        }

        return back()->with('fail', 'El correo electronico o la contrasenia ingresados son incorrectos. Intente de nuevo');
    }

    public function close_session(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('welcome')->with('success', 'Has cerrado sesion correctamente');
    }
  
}

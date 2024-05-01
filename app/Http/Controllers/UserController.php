<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            notify()->success('Has iniciado sesion correctamente', 'Informacion');
            return redirect('paneles');
        }

        return view('login');
    }

    public function cerrar_sesion(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        request()->session()->regenerateToken();
        notify()->success('Has cerrado sesion', 'Informacion');

        return redirect()->route('bienvenido');
    }
}

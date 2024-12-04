<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //Validation rules
    private array $validationRules = [
        'name' => ['required', 'min:7', 'max:15'],
        'email' => ['required', 'email'],
        'password' => ['required']
    ];

    private array $errorMessages = [
        'name.required' => 'El nombre es requerido',
        'email.required' => 'El email es requerido',
        'password.required' => 'La contrasenia es requerida',
        'name.min' => 'Este campo no debe ser menor a 7 caracteres',
        'name.max' => 'Este campo no debe ser mayor a 15 caracteres',
        'email.email' => 'Debes ingresar un email con formato valido'
    ];

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

    //Index method to get all users from database
    public function index()
    {
        $users = User::paginate(10);

        return view('users.index', compact('users'));
    }

    //Create method to call create page
    public function create()
    {
        return view('users.create');
    }

    //Store method to save one user
    public function store(Request $request)
    {
        $request->validate($this->validationRules, $this->errorMessages);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $result = $user->save();

        if($result)
        {
            return redirect()->route('users')->with('success', '[Informacion] Usuario creado correctamente');
        } 
        else 
        {
            return redirect()->route('users')->with('error', '[Informacion] Operacion fallida');
        }
    }

    //Edit method to call edit page
    public function edit($user_id)
    {
        $user = User::find($user_id);

        if($user == null)
        {
            return redirect()->route('users')->with('error', '[Error] El registro solicitado no se encuentra en la base de datos');
        }

        return view('users.edit', compact('user'));

    }

    //Update methd to update a record from database
    public function update(Request $request, $user_id)
    {
        $request->validate($this->validationRules, $this->errorMessages);

        $user = User::find($user_id);

        if($user == null)
        {
            return redirect()->route('users')->with('error', '[Error] El registro solicitado no se encuentra en la base de datos');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $result = $user->update();

        if($result)
        {
            return redirect()->route('users')->with('success', '[Informacion] Usuario actualizado correctamente');
        } 
        else 
        {
            return redirect()->route('users')->with('error', '[Informacion] Operacion fallida');
        }

    }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::view('/', 'welcome')->name('bienvenido');
Route::view('login', 'login')->name('login')->middleware('guest');
Route::view('dashboard', 'dashboard')->name('dashboard')->middleware('auth');

Route::post('iniciar_sesion', [UserController::class, 'iniciar_sesion'])->name('iniciar_sesion');
Route::get('cerrar_sesion', [UserController::class, 'cerrar_sesion'])->name('cerrar_sesion');



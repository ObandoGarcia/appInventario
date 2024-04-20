<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\EstadosController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\MaterialesController;

Route::view('/', 'welcome')->name('bienvenido');
Route::view('login', 'login')->name('login')->middleware('guest');
Route::view('dashboard', 'dashboard')->name('dashboard')->middleware('auth');

Route::post('iniciar_sesion', [UserController::class, 'iniciar_sesion'])->name('iniciar_sesion');
Route::get('cerrar_sesion', [UserController::class, 'cerrar_sesion'])->name('cerrar_sesion');

//Marcas
Route::get('marcas',[MarcasController::class, 'index'])->name('marcas')->middleware('auth');
Route::get('crear_marca', [MarcasController::class, 'create'])->name('crear_marca')->middleware('auth');
Route::post('guardar_marca', [MarcasController::class, 'store'])->name('guardar_marca')->middleware('auth');
Route::get('editar_marca/{id}', [MarcasController::class, 'edit'])->name('editar_marca')->middleware('auth');
Route::put('actualizar_marca{id}', [MarcasController::class, 'update'])->name('actualizar_marca')->middleware('auth');
Route::delete('eliminar_marca{id}', [MarcasController::class, 'destroy'])->name('eliminar_marca')->middleware('auth');

//Proveedores
Route::get('proveedores',[ProveedoresController::class, 'index'])->name('proveedores')->middleware('auth');
Route::get('crear_proveedor', [ProveedoresController::class, 'create'])->name('crear_proveedor')->middleware('auth');
Route::post('guardar_proveedor', [ProveedoresController::class, 'store'])->name('guardar_proveedor')->middleware('auth');
Route::get('editar_proveedor/{id}', [ProveedoresController::class, 'edit'])->name('editar_proveedor')->middleware('auth');
Route::put('actualizar_proveedor{id}', [ProveedoresController::class, 'update'])->name('actualizar_proveedor')->middleware('auth');
Route::delete('eliminar_proveedor{id}', [ProveedoresController::class, 'destroy'])->name('eliminar_proveedor')->middleware('auth');

//Materiales
Route::get('materiales',[MaterialesController::class, 'index'])->name('materiales')->middleware('auth');
Route::get('ver_material/{id}', [MaterialesController::class, 'show'])->name('ver_material')->middleware('auth');
Route::get('crear_material', [MaterialesController::class, 'create'])->name('crear_material')->middleware('auth');
Route::post('guardar_material', [MaterialesController::class, 'store'])->name('guardar_material')->middleware('auth');
Route::get('editar_material/{id}', [MaterialesController::class, 'edit'])->name('editar_material')->middleware('auth');
Route::put('actualizar_material{id}', [MaterialesController::class, 'update'])->name('actualizar_material')->middleware('auth');
Route::delete('eliminar_material{id}', [MaterialesController::class, 'destroy'])->name('eliminar_material')->middleware('auth');


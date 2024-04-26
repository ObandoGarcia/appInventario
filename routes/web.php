<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\MaterialesController;
use App\Http\Controllers\EncargadosController;
use App\Http\Controllers\ProyectoController;

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
Route::put('actualizar_marca/{id}', [MarcasController::class, 'update'])->name('actualizar_marca')->middleware('auth');
Route::delete('eliminar_marca/{id}', [MarcasController::class, 'destroy'])->name('eliminar_marca')->middleware('auth');

//Proveedores
Route::get('proveedores',[ProveedoresController::class, 'index'])->name('proveedores')->middleware('auth');
Route::get('crear_proveedor', [ProveedoresController::class, 'create'])->name('crear_proveedor')->middleware('auth');
Route::post('guardar_proveedor', [ProveedoresController::class, 'store'])->name('guardar_proveedor')->middleware('auth');
Route::get('editar_proveedor/{id}', [ProveedoresController::class, 'edit'])->name('editar_proveedor')->middleware('auth');
Route::put('actualizar_proveedor/{id}', [ProveedoresController::class, 'update'])->name('actualizar_proveedor')->middleware('auth');
Route::delete('eliminar_proveedor/{id}', [ProveedoresController::class, 'destroy'])->name('eliminar_proveedor')->middleware('auth');

//Materiales
Route::get('materiales',[MaterialesController::class, 'index'])->name('materiales')->middleware('auth');
Route::get('ver_material/{id}', [MaterialesController::class, 'show'])->name('ver_material')->middleware('auth');
Route::get('crear_material', [MaterialesController::class, 'create'])->name('crear_material')->middleware('auth');
Route::post('guardar_material', [MaterialesController::class, 'store'])->name('guardar_material')->middleware('auth');
Route::get('editar_material/{id}', [MaterialesController::class, 'edit'])->name('editar_material')->middleware('auth');
Route::put('actualizar_material/{id}', [MaterialesController::class, 'update'])->name('actualizar_material')->middleware('auth');
Route::delete('eliminar_material/{id}', [MaterialesController::class, 'destroy'])->name('eliminar_material')->middleware('auth');

//Encargados
Route::get('encargados',[EncargadosController::class, 'index'])->name('encargados')->middleware('auth');
Route::get('crear_encargado', [EncargadosController::class, 'create'])->name('crear_encargado')->middleware('auth');
Route::post('guardar_encargado', [EncargadosController::class, 'store'])->name('guardar_encargado')->middleware('auth');
Route::get('editar_encargado/{id}', [EncargadosController::class, 'edit'])->name('editar_encargado')->middleware('auth');
Route::put('actualizar_encargado/{id}', [EncargadosController::class, 'update'])->name('actualizar_encargado')->middleware('auth');
Route::delete('eliminar_encargado/{id}', [EncargadosController::class, 'destroy'])->name('eliminar_encargado')->middleware('auth');

//Proyectos
Route::get('proyectos',[ProyectoController::class, 'index'])->name('proyectos')->middleware('auth');
Route::get('crear_proyecto', [ProyectoController::class, 'create'])->name('crear_proyecto')->middleware('auth');
Route::post('guardar_proyecto', [ProyectoController::class, 'store'])->name('guardar_proyecto')->middleware('auth');
Route::get('editar_proyecto/{id}', [ProyectoController::class, 'edit'])->name('editar_proyecto')->middleware('auth');
Route::put('actualizar_proyecto/{id}', [ProyectoController::class, 'update'])->name('actualizar_proyecto')->middleware('auth');
Route::delete('eliminar_proyecto/{id}', [ProyectoController::class, 'destroy'])->name('eliminar_proyecto')->middleware('auth');

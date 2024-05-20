<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\MaterialesController;
use App\Http\Controllers\EncargadosController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\MaquinariasController;
use App\Http\Controllers\HerramientasController;
use App\Http\Controllers\ConductoresController;
use App\Http\Controllers\BoletasController;

Route::view('/', 'welcome')->name('bienvenido');
Route::view('login', 'login')->name('login')->middleware('guest');
Route::view('dashboard', 'dashboard')->name('dashboard')->middleware('auth');
Route::get('paneles', [PanelController::class, 'index'])->name('paneles')->middleware('auth');

Route::post('iniciar_sesion', [UserController::class, 'iniciar_sesion'])->name('iniciar_sesion');
Route::get('cerrar_sesion', [UserController::class, 'cerrar_sesion'])->name('cerrar_sesion');

//User
Route::get('usuarios', [UserController::class, 'index'])->name('usuarios')->middleware('auth');

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
Route::get('detalle_proyecto/{id}', [ProyectoController::class, 'detail'])->name('detalle_proyecto')->middleware('auth');
Route::get('agregar_detalle_material/{proyectoId}', [ProyectoController::class, 'create_material_detail'])->name('agregar_detalle_material')->middleware('auth');
Route::post('validar_cantidad_material/{proyectoId}', [ProyectoController::class, 'validar_cantidad_material'])->name('validar_cantidad_materiales')->middleware('auth');
Route::put('guardar_detalle_material/proyecto/{proyectoId}/material/{materialId}', [ProyectoController::class, 'store_material_detail'])->name('guardar_detalle_material')->middleware('auth');

//Maquinarias
Route::get('maquinarias',[MaquinariasController::class, 'index'])->name('maquinarias')->middleware('auth');
Route::get('ver_maquinaria/{id}', [MaquinariasController::class, 'show'])->name('ver_maquinaria')->middleware('auth');
Route::get('crear_maquinaria', [MaquinariasController::class, 'create'])->name('crear_maquinaria')->middleware('auth');
Route::post('guardar_maquinaria', [MaquinariasController::class, 'store'])->name('guardar_maquinaria')->middleware('auth');
Route::get('editar_maquinaria/{id}', [MaquinariasController::class, 'edit'])->name('editar_maquinaria')->middleware('auth');
Route::put('actualizar_maquinaria/{id}', [MaquinariasController::class, 'update'])->name('actualizar_maquinaria')->middleware('auth');
Route::put('actualizar_maquinaria_disponible/{id}', [MaquinariasController::class, 'update_disponible'])->name('actualizar_maquinaria_disponible')->middleware('auth');

//Herramientas
Route::get('herramientas',[HerramientasController::class, 'index'])->name('herramientas')->middleware('auth');
Route::get('crear_herramienta', [HerramientasController::class, 'create'])->name('crear_herramienta')->middleware('auth');
Route::post('guardar_herramienta', [HerramientasController::class, 'store'])->name('guardar_herramienta')->middleware('auth');
Route::get('editar_herramienta/{id}', [HerramientasController::class, 'edit'])->name('editar_herramienta')->middleware('auth');
Route::put('actualizar_herramienta/{id}', [HerramientasController::class, 'update'])->name('actualizar_herramienta')->middleware('auth');

//Conductores
Route::get('conductores',[ConductoresController::class, 'index'])->name('conductores')->middleware('auth');
Route::get('crear_conductor', [ConductoresController::class, 'create'])->name('crear_conductor')->middleware('auth');
Route::post('guardar_conductor', [ConductoresController::class, 'store'])->name('guardar_conductor')->middleware('auth');
Route::get('editar_conductor/{id}', [ConductoresController::class, 'edit'])->name('editar_conductor')->middleware('auth');
Route::put('actualizar_conductor/{id}', [ConductoresController::class, 'update'])->name('actualizar_conductor')->middleware('auth');

//Boletas
Route::get('boletas',[BoletasController::class, 'index'])->name('boletas')->middleware('auth');
Route::get('ver_boleta/{id}', [BoletasController::class, 'show'])->name('ver_boleta')->middleware('auth');
Route::get('crear_boleta', [BoletasController::class, 'create'])->name('crear_boleta')->middleware('auth');
Route::post('guardar_boleta', [BoletasController::class, 'store'])->name('guardar_boleta')->middleware('auth');
Route::get('editar_boleta/{id}', [BoletasController::class, 'edit'])->name('editar_boleta')->middleware('auth');
Route::put('actualizar_boleta/{id}', [BoletasController::class, 'update'])->name('actualizar_boleta')->middleware('auth');
Route::get('reporte_combustible/{id}', [BoletasController::class, 'create_pdf'])->name('reporte_combustible')->middleware('auth');

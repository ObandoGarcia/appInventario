<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;

//Start routes
Route::view('/', 'welcome')->name('welcome');
Route::view('login', 'login')->name('login')->middleware('guest');
Route::view('dashboard', 'dashboard')->name('dashboard')->middleware('auth');

//User routes
Route::post('iniciar_sesion', [UserController::class, 'start_session'])->name('start_session');
Route::get('cerrar_sesion', [UserController::class, 'close_session'])->name('close_session');

//Author routes
Route::get('autores', [AuthorController::class, 'index'])->name('authors')->middleware('auth');
Route::get('crear_autor', [AuthorController::class, 'create'])->name('create_author')->middleware('auth');
Route::post('guardar_autor', [AuthorController::class, 'store'])->name('save_author')->middleware('auth');
Route::get('editar_autor/{author_id}', [AuthorController::class, 'edit'])->name('edit_author')->middleware('auth');
Route::put('actualizar_autor/{author_id}', [AuthorController::class, 'update'])->name('update_author')->middleware('auth');
Route::get('ver_autor/{author_id}', [AuthorController::class, 'show'])->name('show_author')->middleware('auth');
Route::delete('eliminar_autor/{author_id}', [AuthorController::class, 'delete'])->name('delete_author')->middleware('auth');

//Category routes
Route::get('categorias', [CategoryController::class, 'index'])->name('categories')->middleware('auth');
Route::get('crear_categoria', [CategoryController::class, 'create'])->name('create_category')->middleware('auth');
Route::post('guardar_categoria', [CategoryController::class, 'store'])->name('save_category')->middleware('auth');
Route::get('editar_categoria/{category_id}', [CategoryController::class, 'edit'])->name('edit_category')->middleware('auth');
Route::put('actualizar_categoria/{category_id}', [CategoryController::class, 'update'])->name('update_category')->middleware('auth');
Route::get('ver_categoria/{category_id}', [CategoryController::class, 'show'])->name('show_category')->middleware('auth');
Route::delete('eliminar_categoria/{category_id}', [CategoryController::class, 'delete'])->name('delete_category')->middleware('auth');

//Editorial routes
Route::get('categorias', [CategoryController::class, 'index'])->name('categories')->middleware('auth');
Route::get('crear_categoria', [CategoryController::class, 'create'])->name('create_category')->middleware('auth');
Route::post('guardar_categoria', [CategoryController::class, 'store'])->name('save_category')->middleware('auth');
Route::get('editar_categoria/{category_id}', [CategoryController::class, 'edit'])->name('edit_category')->middleware('auth');
Route::put('actualizar_categoria/{category_id}', [CategoryController::class, 'update'])->name('update_category')->middleware('auth');
Route::get('ver_categoria/{category_id}', [CategoryController::class, 'show'])->name('show_category')->middleware('auth');
Route::delete('eliminar_categoria/{category_id}', [CategoryController::class, 'delete'])->name('delete_category')->middleware('auth');
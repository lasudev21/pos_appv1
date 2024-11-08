<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('auth');

//CONFIGURACION
Route::get('/admin/configuracion', [EmpresaController::class, 'edit'])->name('admin.configuracion.edit')->middleware('auth');
Route::post('/admin/configuracion/{id}', [EmpresaController::class, 'update'])->name('admin.configuracion.update');

//ROLES
Route::get('/admin/roles', [RoleController::class, 'index'])->name('admin.roles.index')->middleware('auth');
Route::get('/admin/roles/create', [RoleController::class, 'create'])->name('admin.roles.create')->middleware('auth');
Route::post('/admin/roles/store', [RoleController::class, 'store'])->name('admin.roles.store')->middleware('auth');
Route::get('/admin/roles/{id}', [RoleController::class, 'show'])->name('admin.roles.show')->middleware('auth');
Route::get('/admin/roles/{id}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit')->middleware('auth');
Route::post('/admin/roles/{id}', [RoleController::class, 'update'])->name('admin.roles.update')->middleware('auth');
Route::delete('/admin/roles/{id}', [RoleController::class, 'destroy'])->name('admin.roles.destroy')->middleware('auth');

//USUARIOS
Route::get('/admin/usuarios', [UserController::class, 'index'])->name('admin.usuarios.index')->middleware('auth');
Route::get('/admin/usuarios/create', [UserController::class, 'create'])->name('admin.usuarios.create')->middleware('auth');
Route::post('/admin/usuarios/store', [UserController::class, 'store'])->name('admin.usuarios.store')->middleware('auth');
Route::get('/admin/usuarios/{id}', [UserController::class, 'show'])->name('admin.usuarios.show')->middleware('auth');
Route::get('/admin/usuarios/{id}/edit', [UserController::class, 'edit'])->name('admin.usuarios.edit')->middleware('auth');
Route::post('/admin/usuarios/{id}', [UserController::class, 'update'])->name('admin.usuarios.update')->middleware('auth');
Route::delete('/admin/usuarios/{id}', [UserController::class, 'destroy'])->name('admin.usuarios.destroy')->middleware('auth');

//CATEGORIAS
Route::get('/admin/categorias', [CategoriaController::class, 'index'])->name('admin.categorias.index')->middleware('auth');
Route::get('/admin/categorias/create', [CategoriaController::class, 'create'])->name('admin.categorias.create')->middleware('auth');
Route::post('/admin/categorias/store', [CategoriaController::class, 'store'])->name('admin.categorias.store')->middleware('auth');
Route::get('/admin/categorias/{id}', [CategoriaController::class, 'show'])->name('admin.categorias.show')->middleware('auth');
Route::get('/admin/categorias/{id}/edit', [CategoriaController::class, 'edit'])->name('admin.categorias.edit')->middleware('auth');
Route::post('/admin/categorias/{id}', [CategoriaController::class, 'update'])->name('admin.categorias.update')->middleware('auth');
Route::delete('/admin/categorias/{id}', [CategoriaController::class, 'destroy'])->name('admin.categorias.destroy')->middleware('auth');

//PRODUCTOS
Route::get('/admin/productos', [ProductoController::class, 'index'])->name('admin.productos.index')->middleware('auth');
Route::get('/admin/productos/create', [ProductoController::class, 'create'])->name('admin.productos.create')->middleware('auth');
Route::post('/admin/productos/store', [ProductoController::class, 'store'])->name('admin.productos.store')->middleware('auth');
Route::get('/admin/productos/{id}', [ProductoController::class, 'show'])->name('admin.productos.show')->middleware('auth');
Route::get('/admin/productos/{id}/edit', [ProductoController::class, 'edit'])->name('admin.productos.edit')->middleware('auth');
Route::post('/admin/productos/{id}', [ProductoController::class, 'update'])->name('admin.productos.update')->middleware('auth');
Route::delete('/admin/productos/{id}', [ProductoController::class, 'destroy'])->name('admin.productos.destroy')->middleware('auth');

//PROVEEDOR
Route::get('/admin/proveedores', [ProveedorController::class, 'index'])->name('admin.proveedores.index')->middleware('auth');
Route::get('/admin/proveedores/create', [ProveedorController::class, 'create'])->name('admin.proveedores.create')->middleware('auth');
Route::post('/admin/proveedores/store', [ProveedorController::class, 'store'])->name('admin.proveedores.store')->middleware('auth');
Route::get('/admin/proveedores/{id}', [ProveedorController::class, 'show'])->name('admin.proveedores.show')->middleware('auth');
Route::get('/admin/proveedores/{id}/edit', [ProveedorController::class, 'edit'])->name('admin.proveedores.edit')->middleware('auth');
Route::post('/admin/proveedores/{id}', [ProveedorController::class, 'update'])->name('admin.proveedores.update')->middleware('auth');
Route::delete('/admin/proveedores/{id}', [ProveedorController::class, 'destroy'])->name('admin.proveedores.destroy')->middleware('auth');


Route::get('/crear-empresa', [EmpresaController::class, 'create'])->name('admin.empresas.create');
Route::post('/crear-empresa/create', [EmpresaController::class, 'store'])->name('admin.empresas.store');

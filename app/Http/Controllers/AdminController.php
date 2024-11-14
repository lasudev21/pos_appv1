<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Compra;
use App\Models\Empresa;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    function index()
    {
        $empresa_id = Auth::check() ? Auth::user()->empresa_id : redirect()->route('login');
        $empresa = Empresa::where('id', $empresa_id)->first();
        $roles = Role::count();
        $usuarios = User::where('empresa_id', $empresa_id)->count();
        $categorias = Categoria::where('empresa_id', $empresa_id)->count();
        $productos = Producto::where('empresa_id', $empresa_id)->count();
        $proveedores = Proveedor::where('empresa_id', $empresa_id)->count();
        $compras = Compra::where('empresa_id', $empresa_id)->count();
        $clientes = Cliente::where('empresa_id', $empresa_id)->count();
        return view('admin.index', compact('empresa', 'roles', 'usuarios', 'categorias', 'productos', 'proveedores', 'compras', 'clientes'));
    }
}

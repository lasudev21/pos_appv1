<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::where('empresa_id', Auth::user()->empresa_id)->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get();
        return view('admin.usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required:unique:users',
            'password' => 'required',
        ]);

        $usuario = new User();
        $usuario->name = $request->nombre;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->empresa_id = Auth::user()->empresa_id;

        $usuario->save();

        $usuario->assignRole($request->rol);

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario registrado exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = User::find($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = Role::get();
        $usuario = User::find($id);
        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|unique:users,email,' . $id,
        ]);

        $usuario = User::find($id);
        $usuario->name = $request->nombre;
        $usuario->email = $request->email;
        $usuario->empresa_id = Auth::user()->empresa_id;
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }
        $usuario->save();
        $usuario->syncRoles($request->rol);

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario modificado exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = User::destroy($id);

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario eliminado exitosamente')
            ->with('icono', 'success');
    }
}

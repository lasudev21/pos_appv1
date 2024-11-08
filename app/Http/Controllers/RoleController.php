<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::get();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:roles,name',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El nombre del rol ya existe. Por favor, elige otro nombre.',
        ]);

        $role = new Role();
        $role->name = $request->nombre;
        $role->guard_name = 'web';

        $role->save();

        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Rol registrado exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|unique:roles,name,' . $id,
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El nombre del rol ya existe. Por favor, elige otro nombre.',
        ]);

        $role = Role::find($id);
        $role->name = $request->nombre;
        $role->save();

        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Rol modificado exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::destroy($id);

        return redirect()->route('admin.roles.index')
            ->with('mensaje', 'Rol eliminado exitosamente')
            ->with('icono', 'success');
    }
}

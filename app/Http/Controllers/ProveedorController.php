<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedor::where('empresa_id', Auth::user()->empresa_id)->orderBy('created_at', 'desc')->get();
        return view('admin.proveedores.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nit' => 'required',
            'nombre_contacto' => 'required',
            'empresa' => 'required',
            'email' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
        ], [
            'nit.required' => 'El campo identificación es obligatorio.',
            'nombre_contacto.required' => 'El campo nombre del proveedor es obligatorio.',
            'empresa.required' => 'El campo nombre empresa es obligatorio.',
            'email.required' => 'El campo email es obligatorio.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'direccion.required' => 'El campo dirección es obligatorio.',
        ]);

        $proveedor = new Proveedor();
        $proveedor->nit = $request->nit;
        $proveedor->nombre_contacto = $request->nombre_contacto;
        $proveedor->empresa = $request->empresa;
        $proveedor->email = $request->email;
        $proveedor->telefono = $request->telefono;
        $proveedor->direccion = $request->direccion;


        $proveedor->empresa_id = Auth::user()->empresa_id;

        $proveedor->save();

        return redirect()->route('admin.proveedores.index')
            ->with('mensaje', 'Proveedor registrado exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $proveedor = Proveedor::find($id);
        return view('admin.proveedores.show', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $proveedor = Proveedor::find($id);
        return view('admin.proveedores.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nit' => 'required',
            'nombre_contacto' => 'required',
            'empresa' => 'required',
            'email' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
        ], [
            'nit.required' => 'El campo identificación es obligatorio.',
            'nombre_contacto.required' => 'El campo nombre del proveedor es obligatorio.',
            'empresa.required' => 'El campo nombre empresa es obligatorio.',
            'email.required' => 'El campo email es obligatorio.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'direccion.required' => 'El campo dirección es obligatorio.',
        ]);

        $proveedor = Proveedor::find($id);
        $proveedor->nit = $request->nit;
        $proveedor->nombre_contacto = $request->nombre_contacto;
        $proveedor->empresa = $request->empresa;
        $proveedor->email = $request->email;
        $proveedor->telefono = $request->telefono;
        $proveedor->direccion = $request->direccion;

        $proveedor->save();

        return redirect()->route('admin.proveedores.index')
            ->with('mensaje', 'Proveedor modificado exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = Proveedor::destroy($id);

        return redirect()->route('admin.proveedores.index')
            ->with('mensaje', 'Proveedor eliminado exitosamente')
            ->with('icono', 'success');
    }
}

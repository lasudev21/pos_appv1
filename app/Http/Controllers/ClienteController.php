<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::where('empresa_id', Auth::user()->empresa_id)->orderBy('created_at', 'desc')->get();
        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'identificacion' => 'required|unique:clientes,identificacion',
            'telefono' => 'required',
            'email' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'identificacion.required' => 'El campo identificación es obligatorio.',
            'identificacion.unique' => 'La identificación ya existe. Por favor, elige otra.',
            'telefono.required' => 'El campo teléfono 1 es obligatorio.',
            'email.required' => 'El campo email es obligatorio.',
        ]);

        $cliente = new Cliente();
        $cliente->nombre = strtoupper($request->nombre);
        $cliente->identificacion = $request->identificacion;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->telefono2 = $request->telefono2;
        $cliente->direccion = $request->direccion;

        $cliente->empresa_id = Auth::user()->empresa_id;

        $cliente->save();

        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Cliente registrado exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::find($id);
        return view('admin.clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cliente = Cliente::find($id);
        return view('admin.clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'identificacion' => 'required|unique:clientes,identificacion,' . $id,
            'telefono' => 'required',
            'email' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'identificacion.required' => 'El campo identificación es obligatorio.',
            'identificacion.unique' => 'La identificación ya existe. Por favor, elige otra.',
            'telefono.required' => 'El campo teléfono 1 es obligatorio.',
            'email.required' => 'El campo email es obligatorio.',
        ]);

        $cliente = Cliente::find($id);
        $cliente->nombre = strtoupper($request->nombre);
        $cliente->identificacion = $request->identificacion;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->telefono2 = $request->telefono2;
        $cliente->direccion = $request->direccion;

        $cliente->save();

        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Cliente modificado exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = Cliente::destroy($id);

        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Cliente eliminado exitosamente')
            ->with('icono', 'success');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::where('empresa_id', Auth::user()->empresa_id)->orderBy('created_at', 'desc')->get();
        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:categorias,nombre',
            'descripcion' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'descripcion.required' => 'El campo descripción es obligatorio.',
            'nombre.unique' => 'El nombre del la categoria ya existe. Por favor, elige otro nombre.',
        ]);

        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->empresa_id = Auth::user()->empresa_id;

        $categoria->save();

        return redirect()->route('admin.categorias.index')
            ->with('mensaje', 'Categoría registrada exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = Categoria::find($id);
        return view('admin.categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categoria = Categoria::find($id);
        return view('admin.categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|unique:categorias,nombre,' . $id,
            'descripcion' => 'required',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.unique' => 'El nombre del la categoria ya existe. Por favor, elige otro nombre.',
            'descripcion.required' => 'El campo descripción es obligatorio.',
        ]);

        $categoria = Categoria::find($id);
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->empresa_id = Auth::user()->empresa_id;

        $categoria->save();

        return redirect()->route('admin.categorias.index')
            ->with('mensaje', 'Categoría modificada exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = Categoria::destroy($id);

        return redirect()->route('admin.categorias.index')
            ->with('mensaje', 'Categoría eliminada exitosamente')
            ->with('icono', 'success');
    }
}

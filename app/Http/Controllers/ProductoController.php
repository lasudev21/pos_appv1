<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::where('empresa_id', Auth::user()->empresa_id)->orderBy('created_at', 'desc')->get();
        return view('admin.productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::where('empresa_id', Auth::user()->empresa_id)->get();
        return view('admin.productos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:productos,codigo',
            'nombre' => 'required',
            'stock' => 'required',
            'stock_minimo' => 'required',
            'stock_maximo' => 'required',
            'precio_compra' => 'required',
            'precio_venta' => 'required',
            'fecha_ingreso' => 'required',
        ], [
            'codigo.required' => 'El campo codigo es obligatorio.',
            'codigo.unique' => 'El codigo del producto ya existe. Por favor, elige otro.',
            'nombre.required' => 'El campo nombre es obligatorio.',
            'stock.required' => 'El campo stock es obligatorio.',
            'stock_minimo.required' => 'El campo stock minimo es obligatorio.',
            'stock_maximo.required' => 'El campo stock máximo es obligatorio.',
            'precio_compra.required' => 'El campo precio de compra es obligatorio.',
            'precio_venta.required' => 'El campo precio de venta es obligatorio.',
            'fecha_ingreso.required' => 'El campo fecha de ingreso es obligatorio.',
        ]);

        $producto = new Producto();
        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        if ($request->filled('descripcion')) {
            $producto->descripcion = $request->descripcion;
        }
        $producto->stock = $request->stock;
        $producto->stock_minimo = $request->stock_minimo;
        $producto->stock_maximo = $request->stock_maximo;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->fecha_ingreso = $request->fecha_ingreso;


        $producto->empresa_id = Auth::user()->empresa_id;
        $producto->categoria_id = $request->categoria_id;

        if ($request->hasFile('imagen')) {
            $producto->imagen = $request->file('imagen')->store('productos', 'public');
        }

        $producto->save();

        return redirect()->route('admin.productos.index')
            ->with('mensaje', 'Producto registrado exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $producto = Producto::with('categoria')->find($id);
        return view('admin.productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $producto = Producto::find($id);
        $categorias = Categoria::where('empresa_id', Auth::user()->empresa_id)->get();
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo' => 'required|unique:productos,codigo,' . $id,
            'nombre' => 'required',
            'stock' => 'required',
            'stock_minimo' => 'required',
            'stock_maximo' => 'required',
            'precio_compra' => 'required',
            'precio_venta' => 'required',
            'fecha_ingreso' => 'required',
        ], [
            'codigo.required' => 'El campo codigo es obligatorio.',
            'codigo.unique' => 'El codigo del producto ya existe. Por favor, elige otro.',
            'nombre.required' => 'El campo nombre es obligatorio.',
            'stock.required' => 'El campo stock es obligatorio.',
            'stock_minimo.required' => 'El campo stock minimo es obligatorio.',
            'stock_maximo.required' => 'El campo stock máximo es obligatorio.',
            'precio_compra.required' => 'El campo precio de compra es obligatorio.',
            'precio_venta.required' => 'El campo precio de venta es obligatorio.',
            'fecha_ingreso.required' => 'El campo fecha de ingreso es obligatorio.',
        ]);

        $producto = Producto::find($id);
        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        if ($request->filled('descripcion')) {
            $producto->descripcion = $request->descripcion;
        }
        $producto->stock = $request->stock;
        $producto->stock_minimo = $request->stock_minimo;
        $producto->stock_maximo = $request->stock_maximo;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->fecha_ingreso = $request->fecha_ingreso;


        $producto->empresa_id = Auth::user()->empresa_id;
        $producto->categoria_id = $request->categoria_id;

        if ($request->hasFile('imagen')) {
            Storage::delete('public/' . $producto->imagen);
            $producto->imagen = $request->file('imagen')->store('productos', 'public');
        }

        $producto->save();

        return redirect()->route('admin.productos.index')
            ->with('mensaje', 'Producto modificado exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = Producto::destroy($id);

        return redirect()->route('admin.productos.index')
            ->with('mensaje', 'Producto eliminado exitosamente')
            ->with('icono', 'success');
    }
}

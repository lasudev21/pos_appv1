<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Http\Controllers\Controller;
use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\TempCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::with('detalles')->where('empresa_id', Auth::user()->empresa_id)->orderBy('created_at', 'desc')->get();
        return view('admin.compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::where('empresa_id', Auth::user()->empresa_id)->orderBy('created_at', 'desc')->get();
        $proveedores = Proveedor::where('empresa_id', Auth::user()->empresa_id)->orderBy('created_at', 'desc')->get();

        $session_id = session()->getId();
        $tem_compras = TempCompra::with('producto')->where('session_id', $session_id)->get();

        return view('admin.compras.create', compact('productos', 'proveedores', 'tem_compras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'proveedor_id' => 'required',
            'fecha' => 'required',
            'comprobante' => 'required',
            'precio_total' => 'required|numeric|min:1',
        ], [
            'proveedor_id.required' => 'El campo codigo es obligatorio.',
            'fecha.required' => 'El campo fecha es obligatorio.',
            'comprobante.required' => 'El campo nombre es obligatorio.',
            'precio_total.required' => 'El precio total es obligatorio',
            'precio_total.min' => 'El precio total debe ser mayor a 0',
        ]);

        $compra = new Compra();
        $compra->proveedor_id = $request->proveedor_id;
        $compra->fecha = $request->fecha;
        $compra->comprobante = $request->comprobante;
        $compra->precio_total = $request->precio_total;
        $compra->empresa_id = Auth::user()->empresa_id;
        $compra->save();

        $temp_compras = TempCompra::where('session_id', session()->getId())->get();

        foreach ($temp_compras as $key => $temp) {
            $producto = Producto::find($temp->producto_id);
            $detalle_compra = new DetalleCompra();
            $detalle_compra->cantidad = $temp->cantidad;
            $detalle_compra->precio_compra = $producto->precio_compra;
            $detalle_compra->producto_id = $temp->producto_id;
            $detalle_compra->compra_id = $compra->id;
            $detalle_compra->save();

            //Actualizamos el stock del producto
            $producto->stock += $temp->cantidad;
            $producto->save();
        }

        TempCompra::where('session_id', session()->getId())->delete();

        return redirect()->route('admin.compras.index')
            ->with('mensaje', 'Compra registrada exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $compra = Compra::with(['detalles.producto', 'proveedor'])->find($id);
        return view('admin.compras.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $compra = Compra::with('detalles', 'proveedor')->findOrFail($id);
        $productos = Producto::where('empresa_id', Auth::user()->empresa_id)->orderBy('created_at', 'desc')->get();
        $proveedores = Proveedor::where('empresa_id', Auth::user()->empresa_id)->orderBy('created_at', 'desc')->get();
        return view('admin.compras.edit', compact('compra', 'productos', 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $datos = $request->all();
        // return response()->json($datos);
        $request->validate([
            'proveedor_id' => 'required',
            'fecha' => 'required',
            'comprobante' => 'required',
            'precio_total' => 'required|numeric|min:1',
        ], [
            'proveedor_id.required' => 'El campo codigo es obligatorio.',
            'fecha.required' => 'El campo fecha es obligatorio.',
            'comprobante.required' => 'El campo nombre es obligatorio.',
            'precio_total.required' => 'El precio total es obligatorio',
            'precio_total.min' => 'El precio total debe ser mayor a 0',
        ]);

        $compra = Compra::find($id);
        $compra->proveedor_id = $request->proveedor_id;
        $compra->fecha = $request->fecha;
        $compra->comprobante = $request->comprobante;
        $compra->precio_total = $request->precio_total;
        $compra->empresa_id = Auth::user()->empresa_id;
        $compra->save();

        return redirect()->route('admin.compras.index')
            ->with('mensaje', 'Compra modificada exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        $compra = Compra::find($id);

        $temp_compra = DetalleCompra::with('producto')->where('compra_id', $compra->id)->get();
        foreach ($temp_compra as $key => $temp) {
            $producto = Producto::find($temp->producto->id);
            $producto->stock -= $temp->cantidad;
            $producto->save();
        }

        Compra::destroy($id);
        DB::commit();


        return redirect()->route('admin.compras.index')
            ->with('mensaje', 'Compra eliminado exitosamente')
            ->with('icono', 'success');
    }
}

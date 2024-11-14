<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\DetalleCompra;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\TempVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::with('detalles.producto')->where('empresa_id', Auth::user()->empresa_id)->orderBy('created_at', 'desc')->get();
        return view('admin.ventas.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::where('empresa_id', Auth::user()->empresa_id)->orderBy('created_at', 'desc')->get();
        $clientes = Cliente::where('empresa_id', Auth::user()->empresa_id)->orderBy('created_at', 'desc')->get();

        $session_id = session()->getId();
        $tem_ventas = TempVenta::with('producto')->where('session_id', $session_id)->get();

        return view('admin.ventas.create', compact('productos', 'clientes', 'tem_ventas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required',
            'fecha' => 'required',
            'precio_total' => 'required|numeric|min:1',
        ], [
            'cliente_id.required' => 'El campo cliente es obligatorio.',
            'fecha.required' => 'El campo fecha es obligatorio.',
            'precio_total.required' => 'El precio total es obligatorio',
            'precio_total.min' => 'El precio total debe ser mayor a 0',
        ]);

        $venta = new Venta();
        $venta->cliente_id = $request->cliente_id;
        $venta->fecha = $request->fecha;
        $venta->precio_total = $request->precio_total;
        $venta->empresa_id = Auth::user()->empresa_id;
        $venta->save();

        $temp_ventas = TempVenta::where('session_id', session()->getId())->get();

        foreach ($temp_ventas as $key => $temp) {
            $producto = Producto::find($temp->producto_id);
            $detalle_venta = new DetalleVenta();
            $detalle_venta->cantidad = $temp->cantidad;
            $detalle_venta->precio_venta = $producto->precio_venta;
            $detalle_venta->producto_id = $temp->producto_id;
            $detalle_venta->venta_id = $venta->id;
            $detalle_venta->save();

            //Actualizamos el stock del producto
            $producto->stock -= $temp->cantidad;
            $producto->save();
        }

        TempVenta::where('session_id', session()->getId())->delete();

        return redirect()->route('admin.ventas.index')
            ->with('mensaje', 'Venta registrada exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $venta = Venta::with(['detalles.producto', 'cliente'])->find($id);
        return view('admin.ventas.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $venta = Venta::with('detalles', 'cliente')->findOrFail($id);
        $productos = Producto::where('empresa_id', Auth::user()->empresa_id)->orderBy('created_at', 'desc')->get();
        $clientes = Cliente::where('empresa_id', Auth::user()->empresa_id)->orderBy('created_at', 'desc')->get();
        return view('admin.ventas.edit', compact('venta', 'productos', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'required',
            'fecha' => 'required',
            'precio_total' => 'required|numeric|min:1',
        ], [
            'cliente_id.required' => 'El campo codigo es obligatorio.',
            'fecha.required' => 'El campo fecha es obligatorio.',
            'precio_total.required' => 'El precio total es obligatorio',
            'precio_total.min' => 'El precio total debe ser mayor a 0',
        ]);

        $venta = Venta::find($id);
        $venta->cliente_id = $request->cliente_id;
        $venta->fecha = $request->fecha;
        $venta->precio_total = $request->precio_total;
        $venta->empresa_id = Auth::user()->empresa_id;
        $venta->save();

        return redirect()->route('admin.ventas.index')
            ->with('mensaje', 'Venta modificada exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        $venta = Venta::find($id);

        $temp_compra = DetalleCompra::with('producto')->where('compra_id', $venta->id)->get();
        foreach ($temp_compra as $key => $temp) {
            $producto = Producto::find($temp->producto->id);
            $producto->stock += $temp->cantidad;
            $producto->save();
        }

        Venta::destroy($id);
        DB::commit();


        return redirect()->route('admin.ventas.index')
            ->with('mensaje', 'Venta eliminado exitosamente')
            ->with('icono', 'success');
    }
}

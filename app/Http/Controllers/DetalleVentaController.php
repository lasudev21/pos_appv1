<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetalleVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function store(Request $request)
    {
        $producto = Producto::where([['codigo', $request->codigo], ['empresa_id', Auth::user()->empresa_id]])->first();

        if ($producto) {
            $existe_compra = DetalleVenta::where([['producto_id', $producto->id], ['venta_id', $request->venta_id]])->first();
            $detalleCompra = new DetalleVenta();

            if ($existe_compra) {
                $detalleCompra = $existe_compra;
                $detalleCompra->cantidad = $detalleCompra->cantidad + $request->cantidad;
            } else {
                $detalleCompra->cantidad = $request->cantidad;
                $detalleCompra->producto_id = $producto->id;
                $detalleCompra->precio_venta = $producto->precio_venta;
                $detalleCompra->venta_id = $request->venta_id;
            }

            $detalleCompra->save();

            $producto->stock -= $request->cantidad;
            $producto->save();

            $temp_compra = DetalleVenta::with('producto')->where('venta_id', $request->venta_id)->get();

            return response()->json(['success' => true, 'message' => 'Producto incorporado', 'data' => $temp_compra]);
        } else
            return response()->json(['success' => false, 'message' => 'Producto no encontrado']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $det = DetalleVenta::find($id);

        $producto = Producto::find($det->producto_id);
        $producto->stock += $det->cantidad;
        $producto->save();

        DetalleVenta::destroy($id);

        $temp_compra = DetalleVenta::with('producto')->where('venta_id', $det->venta_id)->get();

        return response()->json(['success' => true, 'message' => 'Producto eliminado', 'data' => $temp_compra]);
    }
}

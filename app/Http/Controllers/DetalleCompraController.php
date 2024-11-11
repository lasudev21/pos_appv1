<?php

namespace App\Http\Controllers;

use App\Models\DetalleCompra;
use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetalleCompraController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $producto = Producto::where([['codigo', $request->codigo], ['empresa_id', Auth::user()->empresa_id]])->first();

        if ($producto) {
            $existe_compra = DetalleCompra::where([['producto_id', $producto->id], ['compra_id', $request->compra_id]])->first();
            $detalleCompra = new DetalleCompra();

            if ($existe_compra) {
                $detalleCompra = $existe_compra;
                $detalleCompra->cantidad = $detalleCompra->cantidad + $request->cantidad;
            } else {
                $detalleCompra->cantidad = $request->cantidad;
                $detalleCompra->producto_id = $producto->id;
                $detalleCompra->precio_compra = $producto->precio_compra;
                $detalleCompra->compra_id = $request->compra_id;
            }

            $detalleCompra->save();

            $producto->stock += $request->cantidad;
            $producto->save();

            $temp_compra = DetalleCompra::with('producto')->where('compra_id', $request->compra_id)->get();

            return response()->json(['success' => true, 'message' => 'Producto incorporado', 'data' => $temp_compra]);
        } else
            return response()->json(['success' => false, 'message' => 'Producto no encontrado']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $det = DetalleCompra::find($id);

        $producto = Producto::find($det->producto_id);
        $producto->stock -= $det->cantidad;
        $producto->save();

        DetalleCompra::destroy($id);

        $temp_compra = DetalleCompra::with('producto')->where('compra_id', $det->compra_id)->get();

        return response()->json(['success' => true, 'message' => 'Producto eliminado', 'data' => $temp_compra]);
    }
}

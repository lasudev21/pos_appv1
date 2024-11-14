<?php

namespace App\Http\Controllers;

use App\Models\TempVenta;
use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TempVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function tmp_ventas(Request $request)
    {
        $producto = Producto::where([['codigo', $request->codigo], ['empresa_id', Auth::user()->empresa_id]])->first();

        if ($producto) {
            $existe_temp_compra = TempVenta::where([['producto_id', $producto->id], ['session_id', session()->getId()]])->first();
            $tmpCompra = new TempVenta();

            if ($existe_temp_compra) {
                $tmpCompra = $existe_temp_compra;
                $tmpCompra->cantidad = $tmpCompra->cantidad + $request->cantidad;
            } else {
                $tmpCompra->cantidad = $request->cantidad;
                $tmpCompra->producto_id = $producto->id;
                $tmpCompra->session_id = session()->getId();
            }

            $tmpCompra->save();
            $temp_venta = TempVenta::with('producto')->where('session_id', session()->getId())->get();

            return response()->json(['success' => true, 'message' => 'Producto incorporado', 'data' => $temp_venta]);
        } else
            return response()->json(['success' => false, 'message' => 'Producto no encontrado']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        TempVenta::destroy($id);
        $temp_venta = TempVenta::with('producto')->where('session_id', session()->getId())->get();
        return response()->json(['success' => true, 'message' => 'Producto eliminado', 'data' => $temp_venta]);
    }
}

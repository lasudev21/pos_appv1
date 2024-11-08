<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paises = DB::table('countries')->get();
        $monedas = DB::table('currencies')->get();
        return view('admin.empresas.create', compact('paises', 'monedas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pais' => 'required',
            'nombre' => 'required',
            'nit' => 'required|unique:empresas',
            'telefono' => 'required',
            'correo' => 'required|unique:empresas',
            'cantidad_impuesto' => 'required',
            'nombre_impuesto' => 'required',
            'moneda' => 'required',
            'direccion' => 'required',
            'codigo_postal' => 'required',
            // 'logo' => 'required|image|mimes:jpg, jpeg, png',
            'logo' => 'required|image',
        ]);

        $empresa = new Empresa();
        $empresa->pais = $request->pais;
        $empresa->nombre = $request->nombre;
        $empresa->nit = $request->nit;
        $empresa->telefono = $request->telefono;
        $empresa->correo = $request->correo;
        $empresa->cantidad_impuesto = $request->cantidad_impuesto;
        $empresa->nombre_impuesto = $request->nombre_impuesto;
        $empresa->moneda = $request->moneda;
        $empresa->direccion = $request->direccion;
        $empresa->codigo_postal = $request->codigo_postal;
        $empresa->logo = $request->file('logo')->store('logos', 'public');
        $empresa->save();

        $user = new User();
        $user->name = "ADMIN";
        $user->email = $request->correo;
        $user->empresa_id = $empresa->id;
        $user->password = Hash::make($request['nit']);
        $user->save();

        $user->assignRole("ADMINISTRADOR");

        Auth::login($user);
        return redirect()->route('admin.index')->with('mensaje', 'Empresa registrada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        $paises = DB::table('countries')->get();
        $monedas = DB::table('currencies')->get();
        $empresa = Empresa::where('id', Auth::user()->empresa_id)->first();
        return view('admin.configuraciones.edit', compact('paises', 'monedas', 'empresa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pais' => 'required',
            'nombre' => 'required',
            'nit' => 'required|unique:empresas,nit,' . $id,
            'telefono' => 'required',
            'correo' => 'required|unique:empresas,correo,' . $id,
            'cantidad_impuesto' => 'required',
            'nombre_impuesto' => 'required',
            'moneda' => 'required',
            'direccion' => 'required',
            'codigo_postal' => 'required',
        ]);

        $empresa = Empresa::find($id);
        $empresa->pais = $request->pais;
        $empresa->nombre = $request->nombre;
        $empresa->nit = $request->nit;
        $empresa->telefono = $request->telefono;
        $empresa->correo = $request->correo;
        $empresa->cantidad_impuesto = $request->cantidad_impuesto;
        $empresa->nombre_impuesto = $request->nombre_impuesto;
        $empresa->moneda = $request->moneda;
        $empresa->direccion = $request->direccion;
        $empresa->codigo_postal = $request->codigo_postal;
        if ($request->hasFile('logo')) {
            Storage::delete('public/' . $empresa->logo);
            $empresa->logo = $request->file('logo')->store('logos', 'public');
        }

        $empresa->save();

        $user = User::find(Auth::user()->id);
        $user->name = "ADMIN";
        $user->email = $request->correo;
        $user->empresa_id = $empresa->id;
        $user->password = Hash::make($request['nit']);
        $user->save();

        return redirect()->route('admin.configuracion.edit')
            ->with('mensaje', 'Empresa modificada exitosamente')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}

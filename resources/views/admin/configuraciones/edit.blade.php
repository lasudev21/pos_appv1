@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Administrar configuración</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Configuración</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-body card-body">
            <form action="{{ url('/admin/configuracion', $empresa->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" id="logo" name="logo" accept=".jpg, .png, .jpeg"
                                class="form-control">
                            @error('logo')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                        <br>
                        <output id="list" style="    text-align: center; width: 100%;">
                            <img src="{{ asset('storage/' . $empresa->logo) }}" class="thumb thumbail border" width="70%"
                                alt="Logo" />
                        </output>
                        <script>
                            function archivo(evt) {
                                var files = evt.target.files; //file List objet
                                //Obtenemos la imagen del campo "file"
                                for (var i = 0, f; f = files[i]; i++) {
                                    //solo admitimos imagenes
                                    if (!f.type.match('image.*')) {
                                        continue;
                                    }
                                    var reader = new FileReader();
                                    reader.onload = (function(theFile) {
                                        return function(e) {
                                            //insertamos la imagen
                                            document.getElementById("list").innerHTML = ['<img class="thumb thumbail" src="', e
                                                .target.result, '" width="100%"  title="', escape(theFile.name), '"/>'
                                            ].join('');
                                        };
                                    })(f);
                                    reader.readAsDataURL(f);

                                }

                            }
                            document.getElementById('logo').addEventListener('change', archivo, false);
                        </script>
                    </div>
                    <div class="col-md-9">
                        <div class="row col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pais">País</label>
                                    <select name="pais" id="pais" class="form-control">
                                        @foreach ($paises as $pais)
                                            <option value="{{ $pais->name }}"
                                                {{ $empresa->pais == $pais->name ? 'selected' : '' }}>
                                                {{ $pais->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre">Nombre empresa</label>
                                    <input type="text" name="nombre" id="nombre" value="{{ $empresa->nombre }}"
                                        class="form-control">
                                    @error('nombre')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nit">NIT/RUC</label>
                                    <input type="text" name="nit" id="nit" value="{{ $empresa->nit }}"
                                        class="form-control">
                                    @error('nit')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input type="number" name="telefono" id="telefono" value="{{ $empresa->telefono }}"
                                        class="form-control">
                                    @error('telefono')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="correo">Email</label>
                                    <input type="email" name="correo" id="correo" value="{{ $empresa->correo }}"
                                        class="form-control">
                                    @error('correo')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cantidad_impuesto">Cantidad impuesto</label>
                                    <input type="number" name="cantidad_impuesto" id="cantidad_impuesto"
                                        value="{{ $empresa->cantidad_impuesto }}" class="form-control">
                                    @error('cantidad_impuesto')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre_impuesto">Nombre impuesto</label>
                                    <input type="text" name="nombre_impuesto" id="nombre_impuesto"
                                        value="{{ $empresa->nombre_impuesto }}" class="form-control">
                                    @error('nombre_impuesto')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="moneda">Moneda</label>
                                    <select name="moneda" id="moneda" class="form-control">
                                        @foreach ($monedas as $moneda)
                                            <option value="{{ $moneda->code }}"
                                                {{ $empresa->moneda == $moneda->code ? 'selected' : '' }}>
                                                {{ $moneda->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <input type="text" name="direccion" id="direccion"
                                        value="{{ $empresa->direccion }}" class="form-control">
                                    @error('direccion')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="codigo_postal">Identificador teléfonico</label>
                                    <select name="codigo_postal" id="codigo_postal" class="form-control">
                                        @foreach ($paises as $pais)
                                            <option value="{{ $pais->phone_code }}"
                                                {{ $empresa->codigo_postal == $pais->phone_code ? 'selected' : '' }}>
                                                {{ $pais->phone_code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
@stop

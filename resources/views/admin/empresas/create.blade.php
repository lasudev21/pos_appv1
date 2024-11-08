@extends('adminlte::master')

@php($dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home'))

@if (config('adminlte.use_route_url', false))
    @php($dashboard_url = $dashboard_url ? route($dashboard_url) : '')
@else
    @php($dashboard_url = $dashboard_url ? url($dashboard_url) : '')
@endif

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body'){{ ($auth_type ?? 'login') . '-page' }}@stop

@section('body')
    <div class="{{ $auth_type ?? 'login' }}-box" style="width: 50vw">

        {{-- Card Box --}}
        <div class="card {{ config('adminlte.classes_auth_card', 'card-outline card-primary') }}"
            style="box-shadow: 5px 5px 5px 0px #cccccc;">

            {{-- Card Header --}}
            <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
                <h3 class="card-title float-none text-center">
                    Registrar empresa
                </h3>
            </div>

            {{-- Card Body --}}
            <div class="card-body card-body">
                <form action="{{ url('crear-empresa/create') }}" method="POST" enctype="multipart/form-data">
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
                            <output id="list"></output>
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
                                                    .target.result, '" width="100%" style="" title="', escape(theFile.name), '"/>'
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
                                                <option value="{{ $pais->name }}">{{ $pais->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre">Nombre empresa</label>
                                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"
                                            class="form-control">
                                        @error('nombre')
                                            <small style="color: red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nit">NIT/RUC</label>
                                        <input type="text" name="nit" id="nit" value="{{ old('nit') }}"
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
                                        <input type="number" name="telefono" id="telefono" value="{{ old('telefono') }}"
                                            class="form-control">
                                        @error('telefono')
                                            <small style="color: red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="correo">Email</label>
                                        <input type="email" name="correo" id="correo" value="{{ old('correo') }}"
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
                                            value="{{ old('cantidad_impuesto') }}" class="form-control">
                                        @error('cantidad_impuesto')
                                            <small style="color: red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre_impuesto">Nombre impuesto</label>
                                        <input type="text" name="nombre_impuesto" id="nombre_impuesto"
                                            value="{{ old('nombre_impuesto') }}" class="form-control">
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
                                                <option value="{{ $moneda->code }}">{{ $moneda->name }}</option>
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
                                            value="{{ old('direccion') }}" class="form-control">
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
                                                <option value="{{ $pais->phone_code }}">{{ $pais->phone_code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <button type="submit" class="btn btn-primary btn-block">Guardar</button>

                </form>
            </div>

        </div>

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop

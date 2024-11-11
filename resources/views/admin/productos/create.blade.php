@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Comercial</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.productos.index') }}">Productos</a></li>
                    <li class="breadcrumb-item active">Crear</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h5>Crear nuevo producto</h5>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.productos.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="imagen">Imagen</label>
                            <input type="file" id="imagen" name="imagen" accept=".jpg, .png, .jpeg"
                                class="form-control">
                        </div>
                        <br>
                        <output id="list"
                            style="display: flex; flex-wrap: nowrap; align-content: center; justify-content: center; align-items: center; flex-direction: row;"></output>
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
                                                .target.result, '" width="50%"  title="', escape(theFile.name), '"/>'
                                            ].join('');
                                        };
                                    })(f);
                                    reader.readAsDataURL(f);

                                }

                            }
                            document.getElementById('imagen').addEventListener('change', archivo, false);
                        </script>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="categoria_id">Categoría<span class="text-red">*</span></label>
                                    <select name="categoria_id" id="categoria_id" class="form-control">
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="codigo">Código producto<span class="text-red">*</span></label>
                                    <input type="text" id="codigo" name="codigo" value="{{ old('codigo') }}"
                                        class="form-control">
                                    @error('codigo')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre">Nombre producto<span class="text-red">*</span></label>
                                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                                        class="form-control">
                                    @error('nombre')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea id="descripcion" name="descripcion" value="{{ old('descripcion') }}" class="form-control"></textarea>
                                    @error('descripcion')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="stock">Stock <span class="text-red">*</span> </label>
                                    <input type="number" id="stock" name="stock" value="{{ old('stock') }}"
                                        class="form-control">
                                    @error('stock')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="stock_minimo">Stock MIN<span class="text-red">*</span> </label>
                                    <input type="number" id="stock_minimo" name="stock_minimo"
                                        value="{{ old('stock_minimo') }}" class="form-control">
                                    @error('stock_minimo')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="stock_maximo">Stock MAX<span class="text-red">*</span> </label>
                                    <input type="number" id="stock_maximo" name="stock_maximo"
                                        value="{{ old('stock_maximo') }}" class="form-control">
                                    @error('stock_maximo')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="precio_compra">Compra <span class="text-red">*</span> </label>
                                    <input type="number" id="precio_compra" name="precio_compra"
                                        value="{{ old('precio_compra') }}" class="form-control">
                                    @error('precio_compra')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="precio_venta">Venta <span class="text-red">*</span> </label>
                                    <input type="number" id="precio_venta" name="precio_venta"
                                        value="{{ old('precio_venta') }}" class="form-control">
                                    @error('precio_venta')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="fecha_ingreso">Fecha ingreso<span class="text-red">*</span> </label>
                                    <input type="date" id="fecha_ingreso" name="fecha_ingreso"
                                        value="{{ old('fecha_ingreso') }}" class="form-control">
                                    @error('fecha_ingreso')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="col-md-12 d-flex justify-content-end">
                    <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary mr-2">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Regresar al listado
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk mr-2"></i>Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')

@stop

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
                    <li class="breadcrumb-item active">Visualizar</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h5>Datos registrados</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.productos.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group" style="text-align: -webkit-center;">
                            <label for="imagen">Imagen</label>
                            <hr />
                            <div
                                style="width: 100px;height: 100px;display: flex;flex-direction: row;flex-wrap: nowrap;align-content: center;justify-content: center;align-items: center;">
                                @if ($producto->imagen)
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" class="thumb thumbail"
                                        width="100%" alt="Producto" />
                                @else
                                    <i class="fa-solid fa-image" aria-label="Sin imagen disponible"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="categoria_id">Categoría<span class="text-red">*</span></label>
                                    <p>{{ $producto->categoria->nombre }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="codigo">Código producto<span class="text-red">*</span></label>
                                    <p>{{ $producto->codigo }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre">Nombre producto<span class="text-red">*</span></label>
                                    <p>{{ $producto->nombre }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <p>{{ $producto->descripcion }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="stock">Stock <span class="text-red">*</span> </label><br>
                                    <input type="text"
                                        style="width: 70px; text-align: center;background-color: rgba(233, 231, 16, 0.15)"
                                        value="{{ $producto->stock }}" readonly />
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="stock_minimo">Stock MIN<span class="text-red">*</span> </label>
                                    <p>{{ $producto->stock_minimo }}</p>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="stock_maximo">Stock MAX<span class="text-red">*</span> </label>
                                    <p>{{ $producto->stock_maximo }}</p>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="precio_compra">Compra <span class="text-red">*</span> </label>
                                    <p>{{ $producto->precio_compra }}</p>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="precio_venta">Venta <span class="text-red">*</span> </label>
                                    <p>{{ $producto->precio_venta }}</p>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="fecha_ingreso">Fecha ingreso<span class="text-red">*</span> </label>
                                    <p>{{ $producto->fecha_ingreso }}</p>
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
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop

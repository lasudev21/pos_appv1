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
                    <li class="breadcrumb-item"><a href="{{ route('admin.compras.index') }}">Ventas</a></li>
                    <li class="breadcrumb-item active">Visualizar</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="dataTable" class="table table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Precio venta</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $contador = 1; ?>
                                    @foreach ($venta->detalles as $comp)
                                        <tr>
                                            <th scope="row">
                                                {{ $contador++ }}</th>
                                            </td>
                                            <td>{{ $comp->producto->nombre }}</td>
                                            <td>{{ $comp->cantidad }}</td>
                                            <td>{{ $comp->precio_venta }}</td>
                                            <td>{{ $comp->cantidad * $comp->precio_venta }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="cliente_id">Cliente</label>
                                <input type="text" name="cliente_id" id="cliente_id"
                                    value="{{ $venta->cliente->nombre }}"
                                    class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cliente_id">Identificación</label>
                                <input type="text" name="cliente_id" id="cliente_id" value="{{ $venta->cliente->identificacion }}"
                                    class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input type="date" name="fecha" id="fecha" value="{{ $venta->fecha }}"
                                    class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="precio_total">Total factura</label>
                                <input type="number" name="precio_total" id="precio_total"
                                    value="{{ $venta->precio_total }}"
                                    style="background-color: rgba(233, 231, 16, 0.15);" class="form-control text-center"
                                    disabled />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
            <div class="col-md-12 d-flex justify-content-end">
                <a href="{{ route('admin.compras.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Regresar al listado
                </a>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop

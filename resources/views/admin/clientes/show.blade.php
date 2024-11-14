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
                    <li class="breadcrumb-item"><a href="{{ route('admin.clientes.index') }}">Clientes</a></li>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombre">Nombre completo<span class="text-red">*</span></label>
                                <p>{{ $cliente->nombre }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="identificacion">Identificación<span class="text-red">*</span></label>
                                <p>{{ $cliente->identificacion }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email<span class="text-red">*</span></label>
                                <p>{{ $cliente->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono">Teléfono 1<span class="text-red">*</span></label>
                                <p>{{ $cliente->telefono }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono2">Teléfono 2</label>
                                <p>{{ $cliente->telefono2 }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <p>{{ $cliente->direccion }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
            <div class="col-md-12 d-flex justify-content-end">
                <a href="{{ route('admin.clientes.index') }}" class="btn btn-secondary">
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

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
                    <li class="breadcrumb-item"><a href="{{ route('admin.categorias.index') }}">Categorías</a></li>
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
                                <label for="nombre_contacto">Nombre proveedor</label>
                                <p>{{ $proveedor->nombre_contacto }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="empresa">Nombre Empresa</label>
                                <p>{{ $proveedor->empresa }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nit">NIT/RUC/CC</label>
                                <p>{{ $proveedor->nit }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="direccion">Dirección </label>
                                <p>{{ $proveedor->direccion }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <p>{{ $proveedor->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <p>{{ $proveedor->telefono }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
            <div class="col-md-12 d-flex justify-content-end">
                <a href="{{ route('admin.proveedores.index') }}" class="btn btn-secondary mr-2">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Volver atrás
                </a>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop

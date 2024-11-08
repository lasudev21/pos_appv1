@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Bienvenido a {{ $empresa->nombre }}</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $roles }}</h3>

                        <p>Roles</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                    <a href="{{ route('admin.roles.index') }}" class="small-box-footer">
                        Ver más <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $usuarios }}</h3>

                        <p>Usuarios</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <a href="{{ route('admin.usuarios.index') }}" class="small-box-footer">
                        Ver más <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $categorias }}</h3>

                        <p>Categorias</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-tags"></i>
                    </div>
                    <a href="{{ route('admin.categorias.index') }}" class="small-box-footer">
                        Ver más <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $productos }}</h3>
                        <p>Productos</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-rectangle-list"></i>
                    </div>
                    <a href="{{ route('admin.productos.index') }}" class="small-box-footer">
                        Ver más <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $proveedores }}</h3>

                        <p>Proveedores</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-people-group"></i>
                    </div>
                    <a href="{{ route('admin.usuarios.index') }}" class="small-box-footer">
                        Ver más <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $categorias }}</h3>

                        <p>Categorias</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-tags"></i>
                    </div>
                    <a href="{{ route('admin.categorias.index') }}" class="small-box-footer">
                        Ver más <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $roles }}</h3>

                        <p>Roles</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                    <a href="{{ route('admin.roles.index') }}" class="small-box-footer">
                        Ver más <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop

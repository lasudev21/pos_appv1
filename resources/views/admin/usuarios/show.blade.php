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
                    <li class="breadcrumb-item"><a href="{{ route('admin.usuarios.index') }}">Usuarios</a></li>
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
                    <div class="form-group">
                        <label for="nombre">Nombre completo</label>
                        <p>{{ $usuario->name }}</p>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <p>{{ $usuario->email }}</p>
                    </div>
                    <div class="form-group">
                        <label for="email">Rol</label>
                        <p>{{ $usuario->roles->pluck('name')->implode(', ') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="email">Fecha de creación</label>
                        <p>{{ $usuario->created_at }}</p>
                    </div>
                    <div class="form-group">
                        <label for="email">Última modificación</label>
                        <p>{{ $usuario->updated_at }}</p>
                    </div>
                </div>
                <hr />
                <div class="col-md-12 d-flex justify-content-end">
                    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left mr-2"></i>Volver atrás
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
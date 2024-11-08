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
                    <li class="breadcrumb-item active">Crear</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h5>Crear nuevo rol</h5>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.usuarios.update', $usuario->id) }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" value="{{ $usuario->name }}"
                                class="form-control">
                            @error('nombre')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ $usuario->email }}"
                                class="form-control">
                            @error('email')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="rol">Rol</label>
                            <select name="rol" id="rol" class="form-control">
                                @foreach ($roles as $rol)
                                    <option value="{{ $rol->name }}" {{ $rol->name == $usuario->roles->pluck('name')->implode(', ') ? 'selected' : '' }}>
                                        {{ $rol->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="text" id="password" name="password" class="form-control">
                            @error('password')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr />
                <div class="col-md-12 d-flex justify-content-end">
                    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary mr-2">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Volver atrás
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk mr-2"></i>Actualizar
                    </button>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
@stop

@section('css')
@stop

@section('js')

@stop

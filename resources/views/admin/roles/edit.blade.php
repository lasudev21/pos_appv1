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
                    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
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
            <form method="POST" action="{{ route('admin.roles.update', $role->id) }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nombre">Nombre rol</label>
                            <input type="text" id="nombre" name="nombre" value="{{ $role->name }}"
                                class="form-control">
                            @error('nombre')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <hr />
                    <div class="col-md-12 d-flex justify-content-end">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary mr-2">
                            <i class="fa-solid fa-arrow-left mr-2"></i> Volver atrás
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk mr-2"></i>Actualizar
                        </button>
                    </div>
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

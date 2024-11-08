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
                    <li class="breadcrumb-item active">Crear</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h5>Crear nueva categoría</h5>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.categorias.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="nombre">Nombre categoría</label>
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                                class="form-control">
                            @error('nombre')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea id="descripcion" name="descripcion" value="{{ old('descripcion') }}" class="form-control"></textarea>
                            @error('descripcion')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr />
                <div class="col-md-12 d-flex justify-content-end">
                    <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary mr-2">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Volver atrás
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk mr-2"></i>Guardar
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

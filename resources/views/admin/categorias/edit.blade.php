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
                    <li class="breadcrumb-item active">Actualizar</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h5>Actualizar categoría</h5>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.categorias.update', $categoria->id) }}">
                @csrf
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="nombre">Nombre categoría</label>
                            <input type="text" id="nombre" name="nombre" value="{{ $categoria->nombre }}"
                                class="form-control">
                            @error('nombre')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea id="descripcion" name="descripcion" class="form-control">{{ $categoria->descripcion }}</textarea>
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

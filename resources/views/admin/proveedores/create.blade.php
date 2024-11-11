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
                    <li class="breadcrumb-item"><a href="{{ route('admin.proveedores.index') }}">Proveedores</a></li>
                    <li class="breadcrumb-item active">Crear</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h5>Crear nuevo proveedor</h5>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.proveedores.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre_contacto">Nombre proveedor<span class="text-red">*</span></label>
                                    <input type="text" id="nombre_contacto" name="nombre_contacto"
                                        value="{{ old('nombre_contacto') }}" class="form-control">
                                    @error('nombre_contacto')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="empresa">Nombre Empresa<span class="text-red">*</span></label>
                                    <input type="text" id="empresa" name="empresa" value="{{ old('empresa') }}"
                                        class="form-control">
                                    @error('empresa')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nit">NIT/RUC/CC<span class="text-red">*</span></label>
                                    <input type="text" id="nit" name="nit" value="{{ old('nit') }}"
                                        class="form-control">
                                    @error('nit')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="direccion">Dirección<span class="text-red">*</span> </label>
                                    <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}"
                                        class="form-control">
                                    @error('direccion')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email<span class="text-red">*</span></label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                        class="form-control">
                                    @error('email')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="telefono">Teléfono<span class="text-red">*</span></label>
                                    <input type="number" id="telefono" name="telefono" value="{{ old('telefono') }}"
                                        class="form-control">
                                    @error('telefono')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="col-md-12 d-flex justify-content-end">
                    <a href="{{ route('admin.proveedores.index') }}" class="btn btn-secondary mr-2">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Regresar al listado
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk mr-2"></i>Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')

@stop

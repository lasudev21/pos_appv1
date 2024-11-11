@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Administrar Productos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Comercial</a></li>
                    <li class="breadcrumb-item active">Productos</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary" style="margin-bottom:0px !important;">
                <div class="card-header">
                    <div class="card-tools">
                        <a href="{{ route('admin.productos.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nuevo
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="dataTable" class="table table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Código</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Stock</th>
                                <th scope="col">$Compra</th>
                                <th scope="col">$Venta</th>
                                <th scope="col">Imagen</th>
                                <th scope="col" style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <th scope="row">
                                        {{ $producto->id }}</th>
                                    <td>{{ $producto->codigo }}</td>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>{{ $producto->descripcion }}</td>
                                    <td
                                        style="text-align: center; vertical-align: middle; background-color: rgba(233, 231, 16, 0.15)">
                                        {{ $producto->stock }}</td>
                                    <td>{{ $producto->precio_compra }}
                                    </td>
                                    <td>{{ $producto->precio_venta }}
                                    </td>
                                    <td style="text-align: -webkit-center !important;">
                                        <div
                                            style="width: 100px;height: 100px;display: flex;flex-direction: row;flex-wrap: nowrap;align-content: center;justify-content: center;align-items: center;">
                                            @if ($producto->imagen)
                                                <img src="{{ asset('storage/' . $producto->imagen) }}"
                                                    class="thumb thumbail" width="100%" alt="Producto" />
                                            @else
                                                <i class="fa-solid fa-image" aria-label="Sin imagen disponible"></i>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Acciones">
                                            <a href="{{ route('admin.productos.show', $producto->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.productos.edit', $producto->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('admin.productos.destroy', $producto->id) }}"
                                                method="POST" onclick="Confirmar{{ $producto->id }}(event)"
                                                id="formDelete{{ $producto->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    style="border-radius: 0px 5px 5px 0px;">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                            <script>
                                                function Confirmar{{ $producto->id }}(event) {
                                                    event.preventDefault();
                                                    Swal.fire({
                                                        title: "¿Desea eliminar este registro?",
                                                        showCancelButton: true,
                                                        confirmButtonText: "Eliminar",
                                                        confirmButtonColor: '#a5161d'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            var form = $('#formDelete{{ $producto->id }}');
                                                            form.submit();
                                                        }
                                                    });
                                                }
                                            </script>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop

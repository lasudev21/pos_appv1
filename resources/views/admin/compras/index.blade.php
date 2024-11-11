@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Administrar Compras</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Comercial</a></li>
                    <li class="breadcrumb-item active">Compras</li>
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
                        <a href="{{ route('admin.compras.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nuevo
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="dataTable" class="table table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Proveedor</th>
                                <th scope="col">Precio total</th>
                                <th scope="col">Comprobante</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Productos</th>
                                <th scope="col" style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($compras as $compra)
                                <tr>
                                    <th scope="row">
                                        {{ $compra->id }}</th>
                                    </td>
                                    <td>{{ $compra->proveedor->nombre_contacto }}</td>
                                    <td>{{ $compra->precio_total }}</td>
                                    <td>{{ $compra->comprobante }}</td>
                                    <td>{{ $compra->fecha }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($compra->detalles as $detalle)
                                            <li class="text-left">{{$detalle->producto->nombre}} - {{$detalle->cantidad}} Und</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        <div class="btn-group" role="group" aria-label="Acciones">
                                            <a href="{{ route('admin.compras.show', $compra->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.compras.edit', $compra->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('admin.compras.destroy', $compra->id) }}" method="POST"
                                                onclick="Confirmar{{ $compra->id }}(event)"
                                                id="formDelete{{ $compra->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    style="border-radius: 0px 5px 5px 0px;">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                            <script>
                                                function Confirmar{{ $compra->id }}(event) {
                                                    event.preventDefault();
                                                    Swal.fire({
                                                        title: "¿Desea eliminar este registro?",
                                                        showCancelButton: true,
                                                        confirmButtonText: "Eliminar",
                                                        confirmButtonColor: '#a5161d'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            var form = $('#formDelete{{ $compra->id }}');
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

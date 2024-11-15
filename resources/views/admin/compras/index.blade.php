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
                                <th scope="col"></th>
                                <th scope="col">#</th>
                                <th scope="col">Proveedor</th>
                                <th scope="col">Precio total</th>
                                <th scope="col">Comprobante</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Cantidad productos</th>
                                <th scope="col" style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($compras as $index => $compra)
                                <tr>
                                    <td class="details-control" data-index="{{ $index }}">
                                        <i class="fas fa-plus-circle"></i>
                                    </td>
                                    <td scope="row">{{ $compra->id }}</td>
                                    <td>{{ $compra->proveedor->nombre_contacto }}</td>
                                    <td>{{ $compra->precio_total }}</td>
                                    <td>{{ $compra->comprobante }}</td>
                                    <td>{{ $compra->fecha }}</td>
                                    <td>
                                        {{ $compra->detalles->count() }}
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
    <style>
        .details-control {
            cursor: pointer;
            text-align: center;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            function format(detalles) {
                let detalleHtml =
                    '<table class="table table-striped table-hover table-sm" cellpadding="5" cellspacing="0" border="0" style="padding:10px;">';
                detalleHtml += '<tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Total</th></tr>';
                console.log(detalles)

                detalles.forEach(detalle => {
                    console.log(detalle)
                    detalleHtml += `<tr>
                    <td>${detalle.producto.nombre}</td>
                    <td>${detalle.cantidad}</td>
                    <td>${detalle.producto.precio_compra}</td>
                    <td>${(detalle.cantidad * detalle.producto.precio_compra).toFixed(2)}</td>
                </tr>`;
                });

                detalleHtml += '</table>';
                return detalleHtml;
            }

            $('#dataTable tbody').on('click', 'td.details-control', function() {
                const tr = $(this).closest('tr');
                const table = $('#dataTable').DataTable();
                const row = table.row(tr);
                const index = $(this).data('index');
                const icon = $(this).find('i');

                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');
                    icon.removeClass('fa-minus-circle').addClass('fa-plus-circle');
                } else {
                    const detalles = @json($compras->pluck('detalles')->toArray());
                    const detallesVenta = detalles[index] || [];
                    console.log(detallesVenta, index, $(this))

                    row.child(format(detallesVenta)).show();
                    tr.addClass('shown');
                    icon.removeClass('fa-plus-circle').addClass('fa-minus-circle');
                }
            });
        });
    </script>
@stop

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
                    <li class="breadcrumb-item"><a href="#">Comercial</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.compras.index') }}">Compras</a></li>
                    <li class="breadcrumb-item active">Crear</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h5>Crear nuevo compra</h5>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.compras.store') }}" id="formCompra" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="cantidad">Cantidad<span class="text-red">*</span></label>
                                    <input type="number" id="cantidad" name="cantidad" value="1"
                                        class="form-control text-center">
                                    @error('cantidad')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-10">
                                <label for="codigo">Código<span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-barcode"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="codigo" name="codigo" class="form-control">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary btn-flat" data-toggle="modal"
                                            data-target="#search">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                        <a href="{{ route('admin.productos.create') }}" class="btn btn-success">
                                            <i class="fa-solid fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table id="tableDetalles" class="table table-striped table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Codigo</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Producto</th>
                                            <th scope="col">Valor</th>
                                            <th scope="col">Total</th>
                                            <th scope="col" style="text-align: center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $contador = 1;
                                        $cantidad = 0;
                                        $compra = 0; ?>
                                        @foreach ($tem_compras as $temp)
                                            <tr>
                                                <td>{{ $contador++ }}</td>
                                                <td>{{ $temp->producto->codigo }}</td>
                                                <td>{{ $temp->producto->nombre }}</td>
                                                <td>{{ $temp->cantidad }}</td>
                                                <td>{{ $temp->producto->precio_compra }}</td>
                                                <td>{{ $costo = $temp->producto->precio_compra * $temp->cantidad }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                        data-id="{{ $temp->id }}">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </td>
                                                @php
                                                    $cantidad += $temp->cantidad;
                                                    $compra += $costo;
                                                @endphp
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2"><b>Total cantidad</b></td>
                                            <td><b>{{ $cantidad }}</b></td>
                                            <td colspan="2"><b>Total compra</b></td>
                                            <td><b>{{ $compra }}</b></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="proveedor_id">Proveedor<span class="text-red">*</span></label>
                                    <select id="proveedor_id" name="proveedor_id" class="form-control" style="width: 100%;">
                                        <option value="" selected disabled>Seleccione un proveedor...</option>
                                    </select>
                                    @error('proveedor_id')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha">Fecha<span class="text-red">*</span></label>
                                    <input type="date" id="fecha" name="fecha" value="{{ old('fecha') }}"
                                        class="form-control">
                                    @error('fecha')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="comprobante">Comprobante<span class="text-red">*</span></label>
                                    <input type="text" id="comprobante" name="comprobante"
                                        value="{{ old('comprobante') }}" class="form-control">
                                    @error('comprobante')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="precio_total">Precio Total<span class="text-red">*</span></label>
                                    <input type="number" id="precio_total" name="precio_total"
                                        value="{{ $compra }}" class="form-control text-center"
                                        style="background-color: rgba(233, 231, 16, 0.15);" readonly>
                                    @error('precio_total')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fa-solid fa-floppy-disk mr-2"></i>Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.compras.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Regresar al listado
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listado de productos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="dataTable" class="table table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">#</th>
                                        <th scope="col">Código</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Imagen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $contador = 1; ?>
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm add-btn" title="Print"
                                                    data-codigo="{{ $producto->codigo }}">
                                                    <i class="fa-solid fa-circle-check"></i>
                                                </button>
                                            </td>
                                            <th scope="row">
                                                {{ $contador++ }}</th>
                                            <td>{{ $producto->codigo }}</td>
                                            <td>{{ $producto->nombre }}</td>
                                            <td>{{ $producto->descripcion }}</td>
                                            <td
                                                style="text-align: center; vertical-align: middle; background-color: rgba(233, 231, 16, 0.15)">
                                                {{ $producto->stock }}</td>
                                            <td>{{ $producto->precio_venta }}
                                            </td>
                                            <td style="text-align: -webkit-center !important;">
                                                <div
                                                    style="width: 100px;height: 100px;display: flex;flex-direction: row;flex-wrap: nowrap;align-content: center;justify-content: center;align-items: center;">
                                                    @if ($producto->imagen)
                                                        <img src="{{ asset('storage/' . $producto->imagen) }}"
                                                            class="thumb thumbail" width="100%" alt="Producto" />
                                                    @else
                                                        <i class="fa-solid fa-image"
                                                            aria-label="Sin imagen disponible"></i>
                                                    @endif
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
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var proveedores = {!! $proveedores !!};
            var id = {{ old('proveedor_id') }}
            $('#proveedor_id').select2({
                placeholder: "Seleccione un proveedor...",
                allowClear: true,
                width: '100%',
                data: proveedores.map(proveedor => ({
                    id: proveedor.id,
                    text: `${proveedor.empresa} - (${proveedor.nombre_contacto})`
                }))
            });

            if (id) {
                $('#proveedor_id').val(id).trigger('change');
            }

            $('#codigo').focus();

            $('.add-btn').click(function() {
                var codigo = $(this).data('codigo');
                $('#search').modal('hide');
                AgregarProductoLista(codigo);
            })

            $('.delete-btn').click(function() {
                var id = $(this).data('id');
                if (id) {
                    EliminarProductoLista(id)
                }
            })

            $('#formCompra').on('keypress', function(e) {
                if (e.keyCode === 13) {
                    e.preventDefault();
                }
            });

            $('#search').on('shown.bs.modal', function() {
                $('#dataTable').DataTable().columns.adjust().responsive.recalc();
            });

            $('#codigo').on('keyup', function(e) {
                if (e.which === 13) {
                    let codigo = $(this).val();
                    if (codigo.length > 0) {
                        AgregarProductoLista(codigo)
                    }
                }
            });

            function AgregarProductoLista(codigo) {
                $.ajax({
                    url: "{{ route('admin.compras.tmp_compras') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        codigo: codigo,
                        cantidad: $('#cantidad').val()
                    },
                    success: function(response) {
                        if (response.success) {
                            MensajeConfirmacion('success', response.message);
                            actualizarTablaDetalles(response.data)
                        } else {
                            MensajeConfirmacion('warning', response.message);
                        }
                        $('#codigo').val(null);
                        $('#cantidad').val(1);
                    },
                    error: function(error) {
                        alert(error)
                    }
                });
            }

            function EliminarProductoLista(id) {
                Swal.fire({
                    title: "¿Desea eliminar este producto?",
                    showCancelButton: true,
                    confirmButtonText: "Eliminar",
                    confirmButtonColor: '#a5161d'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `{{ url('/admin/compras/create/temp/${id}') }}`,
                            method: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                _method: "DELETE"
                            },
                            success: function(response) {
                                if (response.success) {
                                    MensajeConfirmacion('success', response.message);
                                    console.log(response.data)
                                    actualizarTablaDetalles(response.data);
                                }
                            },
                            error: function(error) {
                                alert(error)
                            }
                        });
                    }
                });
            }

            function MensajeConfirmacion(icon, mensaje) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: icon,
                    text: mensaje,
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                });
            }


            function actualizarTablaDetalles(tem_compras) {
                var tbody = $('#tableDetalles tbody');
                tbody.empty()

                var totalCantidad = 0;
                var totalCompra = 0;
                var contador = 1;

                tem_compras.forEach(function(temp) {
                    var costo = temp.producto.precio_compra * temp.cantidad;
                    totalCantidad += temp.cantidad;
                    totalCompra += costo;

                    var row = `<tr>
                                <td>${contador++}</td>
                                <td>${temp.producto.codigo}</td>
                                <td>${temp.producto.nombre}</td>
                                <td>${temp.cantidad}</td>
                                <td>${temp.producto.precio_compra}</td>
                                <td>${costo.toFixed(2)}</td>
                                <td><button type="button" class="btn btn-danger btn-sm delete-btn" data-id="${temp.id}"><i class="fa-solid fa-trash-can"></i></button></td>
                            </tr>`;

                    tbody.append(row);
                });

                // Actualizar el pie de la tabla con los totales
                $('#tableDetalles tfoot').html(`<tr>
                                                    <td colspan="2"><b>Total cantidad</b></td>
                                                    <td><b>${totalCantidad}</b></td>
                                                    <td colspan="2"><b>Total compra</b></td>
                                                    <td><b>${totalCompra.toFixed(2)}</b></td>
                                                </tr>`);
                $('#precio_total').val(totalCompra.toFixed(2));

                $('#tableDetalles tbody').on('click', '.delete-btn', function() {
                    var id = $(this).data('id');
                    EliminarProductoLista(id);
                });
            }
        });
    </script>
@stop

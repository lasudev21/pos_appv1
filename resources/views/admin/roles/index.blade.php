@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Administrar Roles</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Roles</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <div class="card-tools">
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nuevo
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="dataTable" class="table table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col" style="text-align: center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <th scope="row">{{ $role->id }}</th>
                                    <td>{{ $role->name }}</td>
                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Acciones">
                                            <a href="{{ route('admin.roles.show', $role->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                                onclick="Confirmar{{ $role->id }}(event)"
                                                id="formDelete{{ $role->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    style="border-radius: 0px 5px 5px 0px;">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                            <script>
                                                function Confirmar{{ $role->id }}(event) {
                                                    event.preventDefault();
                                                    Swal.fire({
                                                        title: "¿Desea eliminar este registro?",
                                                        showCancelButton: true,
                                                        confirmButtonText: "Eliminar",
                                                        confirmButtonColor: '#a5161d'
                                                    }).then((result) => {
                                                        console.log(result)
                                                        if (result.isConfirmed) {
                                                            var form = $('#formDelete{{ $role->id }}');
                                                            console.log(form)

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

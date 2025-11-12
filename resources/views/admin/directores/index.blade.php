@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 18pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/directores') }}">Directores</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listado de Directores</li>
        </ol>
    </nav>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"> <b>Directores Registradas</b></h3>

                    <div class="card-tools">
                        <a class="btn btn-primary" href="{{ url('/admin/directores/create') }}">Crear nuevo</a>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body  " style="display: block;">

                    <div class="card-body table-responsive " style="">
                        <table id="example1" class="table table-head-fixed text-nowrap table-hover">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>N° DNI</th>
                                    <th>Fecha de inicio</th>
                                    <th>Fecha de fin</th>
                                    <th>Observaciones</th>
                                    <th>Estado</th>

                                    <th style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($directores as $director)
                                    <tr>
                                        <td style="text-align: center">{{ $loop->iteration }}</td>
                                        <td>{{ $director->nombre }}</td>
                                        <td>{{ $director->apellido }}</td>
                                        <td>{{ $director->dni }}</td>
                                        <td>{{ $director->fecha_inicio }}</td>
                                        <td>{{ $director->fecha_fin }}</td>
                                        <td>
                                            <span class="text-truncate d-inline-block" style="max-width: 100px;"
                                                title="{{ strip_tags($director->observaciones) }}">
                                                {{ preg_replace('/\s+/', ' ', strip_tags($director->observaciones)) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($director->estado == '1')
                                                <span class="badge badge-success">Activo</span>
                                            @else
                                                <span class="badge badge-danger">Inactivo</span>
                                            @endif
                                        </td>

                                        <td style="text-align: center">
                                            <div class="btn-group" role="group">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-info" data-toggle="modal"
                                                    data-target="#ModalShow{{ $director->id }}">
                                                    <i class="fas fa-eye"></i>Ver
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="ModalShow{{ $director->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header"
                                                                style="background-color: #6da3dd; color: white;">
                                                                <h5 class="modal-title" id="exampleModalLabel">Datos del
                                                                    director</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                @csrf
                                                                <div class="row">



                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="nombre">Nombre:</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">

                                                                                </div>
                                                                                <input type="text"
                                                                                    value="{{ old('nombre', $director->nombre) }}"
                                                                                    class="card card-body bg-white shadow-sm"
                                                                                    id="nombre" name="nombre"
                                                                                    placeholder="Ingrese el nombre del director"
                                                                                    readonly>
                                                                            </div>
                                                                            @error('nombre')
                                                                                <small
                                                                                    style="color: red">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="apellido">Apellido:</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">

                                                                                </div>
                                                                                <input type="text"
                                                                                    value="{{ old('apellido', $director->apellido) }}"
                                                                                    class="card card-body bg-white shadow-sm"
                                                                                    id="apellido" name="apellido"
                                                                                    placeholder="Ingrese el apellido"
                                                                                    readonly>
                                                                            </div>
                                                                            @error('apellido')
                                                                                <small
                                                                                    style="color: red">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="dni">dni:</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">

                                                                                </div>
                                                                                <input type="text"
                                                                                    value="{{ old('dni', $director->dni) }}"
                                                                                    class="card card-body bg-white shadow-sm"
                                                                                    id="dni" name="dni"
                                                                                    placeholder="Ingrese el dni" readonly>
                                                                            </div>
                                                                            @error('dni')
                                                                                <small
                                                                                    style="color: red">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="fecha_inicio">Fecha_inicio:</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">

                                                                                </div>
                                                                                <input type="date"
                                                                                    value="{{ old('fecha_inicio', $director->fecha_inicio) }}"
                                                                                    class="card card-body bg-white shadow-sm"
                                                                                    id="fecha_inicio" name="fecha_inicio"
                                                                                    placeholder="Ingrese el fecha_inicio"
                                                                                    readonly>
                                                                            </div>
                                                                            @error('fecha_inicio')
                                                                                <small
                                                                                    style="color: red">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="fecha_fin">Fecha de fin:</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">

                                                                                </div>
                                                                                <input type="date"
                                                                                    value="{{ old('fecha_fin', $director->fecha_fin) }}"
                                                                                    class="card card-body bg-white shadow-sm"id="fecha_fin"
                                                                                    name="fecha_fin"
                                                                                    placeholder="Ingrese el fecha_fin"
                                                                                    readonly>
                                                                            </div>
                                                                            @error('fecha_fin')
                                                                                <small
                                                                                    style="color: red">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="observaciones">Observaciones:</label>
                                                                            <div class="card border rounded shadow-sm">
                                                                                <div class="card-body"
                                                                                    style="max-height: 200px; overflow-y: auto; background: #f8f9fa;">
                                                                                    @if (!empty($director->observaciones))
                                                                                        {!! $director->observaciones !!}
                                                                                    @else
                                                                                        <em class="text-muted">Sin
                                                                                            observaciones</em>
                                                                                    @endif
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label for="estado">Estado:</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-prepend">

                                                                                        </div>
                                                                                        <select name="estado"
                                                                                            id="estado"
                                                                                            class="card card-body bg-white shadow-sm"disabled>
                                                                                            <option value="">
                                                                                                Seleccionar una opcion
                                                                                            </option>
                                                                                            <option
                                                                                                value="1"{{ old('estado', $director->estado) == '1' ? 'selected' : '' }}>
                                                                                                Activo</option>
                                                                                            <option
                                                                                                value="0"{{ old('estado', $director->estado) == '0' ? 'selected' : '' }}>
                                                                                                Inactivo</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    @error('estado')
                                                                                        <small
                                                                                            style="color: red">{{ $message }}</small>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">Volver</button>

                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                        <!--editar-->
                                                        <a href="{{ url('/admin/directores/' . $director->id . '/edit') }}"
                                                            class="btn btn-success"><i class="fas fa-pencil-alt"></i>
                                                            Editar</a>

                                                        <form action="{{ url('/admin/directores/' . $director->id) }}"
                                                            id="formulario{{ $director->id }}" method="POST"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"
                                                                onclick="preguntar{{ $director->id }}(event)">
                                                                <i class="fas fa-trash-alt"></i> Eliminar
                                                            </button>
                                                        </form>
                                                        <script>
                                                            function preguntar{{ $director->id }}(event) {
                                                                event.preventDefault();

                                                                Swal.fire({
                                                                    title: "Desea eliminar este reguistro",
                                                                    text: "",
                                                                    icon: "question",
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: "#3085d6",
                                                                    cancelButtonColor: "#d33",
                                                                    confirmButtonText: "Si, Eliminar"
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        Swal.fire({
                                                                            title: "Eliminado",
                                                                            text: "Se elimino Correctamente",
                                                                            icon: "success"

                                                                        });
                                                                        document.getElementById("formulario{{ $director->id }}").submit();
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
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

@stop

@section('css')

    <style>
        .modal .form-group label {
            text-align: left !important;
            display: block;
            font-weight: 600;
        }

        .modal-content {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            background: linear-gradient(90deg, #007bff, #0056b3);
            color: white;
            font-weight: bold;
        }

        .modal-body {
            background-color: #f9f9f9;
        }

        .modal.fade .modal-dialog {
            transform: translateY(-50px);
            opacity: 0;
            transition: all 0.3s ease-out;
        }

        .modal.show .modal-dialog {
            transform: translateY(0);
            opacity: 1;
        }
    </style>

    <style>
        /* Fondo transparente y sin borde en el contenedor */
        #example1_wrapper .dt-buttons {
            background-color: transparent;
            box-shadow: none;
            border: none;
            display: flex;
            justify-content: center;
            /* Centrar los botones */
            gap: 10px;
            /* Espaciado entre botones */
            margin-bottom: 15px;
            /* Separar botones de la tabla */
        }

        /* Estilo personalizado para los botones */
        #example1_wrapper .btn {
            color: #fff;
            /* Color del texto en blanco */
            border-radius: 4px;
            /* Bordes redondeados */
            padding: 5px 15px;
            /* Espaciado interno */
            font-size: 14px;
            /* TamaÃ±o de fuente */
        }

        /* Colores por tipo de botÃ³n */
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-info {
            background-color: #17a2b8;
            border: none;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #212529;
            border: none;
        }

        .btn-default {
            background-color: #6e7176;
            color: #212529;
            border: none;
        }

        #example1 th {
            white-space: normal !important;
            /* Permite salto de línea */
            word-wrap: break-word;
            /* Ajusta palabras largas */
            max-width: 120px;
            /* Controla el ancho máximo de cada columna */
            text-align: center;
            /* Centra el texto */
            vertical-align: middle;
            /* Centra verticalmente */
        }
    </style>

@stop

@section('js')
    @if ($errors->any())
        <script>
            @if (session('modal_id'))
                var modalId = session('modal_id');
                $('#ModalEdit' + modalId).modal('show');
            @else
                $('#ModalCreate').modal('show');
            @endif
        </script>
    @endif
    <script>
        $(function() {
        $("#example1").DataTable({
            "pageLength": 10,
            "language": {
                "emptyTable": "No hay informacion",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Directores",
                "infoEmpty": "Mostrando 0 a 0 de 0 Directores",
                "infoFiltered": "(Filtrado de _MAX_ total Directores)",
                "lengthMenu": "Mostrar _MENU_ Directores",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            buttons: [
                {
                    text: '<i class="fas fa-copy"></i> COPIAR',
                    extend: 'copy',
                    className: 'btn btn-default',
                    exportOptions: {
                        columns: ':not(:last-child)' // Excluye columna Acciones
                    }
                },
                {
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    extend: 'pdf',
                    className: 'btn btn-danger',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
                {
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    extend: 'csv',
                    className: 'btn btn-info',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
                {
                    text: '<i class="fas fa-file-excel"></i> EXCEL',
                    extend: 'excel',
                    className: 'btn btn-success',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
                {
                    text: '<i class="fas fa-print"></i> IMPRIMIR',
                    extend: 'print',
                    className: 'btn btn-warning',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                }
            ]
        }).buttons().container().appendTo('#example1_wrapper .row:eq(0)');
    });
    </script>
@stop

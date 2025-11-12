@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 18pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/usuarios') }}">Usuarios</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listado de Usuarios</li>
        </ol>
    </nav>
@stop

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12" >
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"> <b>Usuarios reguistrados</b></h3>

                    <div class="card-tools">
                        <a class="btn btn-primary" href="{{ url('/admin/usuarios/create') }}">Crear nuevo</a>
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
                                    <th>Rol del usuario</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Tipo documento</th>
                                    <th>Nro documento</th>
                                    <th>Celular</th>
                                    <th>Estado</th>

                                    <th style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td style="text-align: center">{{ $loop->iteration }}</td>
                                        <td>{{ $usuario->roles->pluck('name')->implode(',') }}</td>
                                        <td>{{ $usuario->nombres }}</td>
                                        <td>{{ $usuario->apellidos }}</td>
                                        <td>{{ $usuario->tipo_documento }}</td>
                                        <td>{{ $usuario->numero_documento }}</td>
                                        <td>{{ $usuario->celular }}</td>
                                        <td style="text-align: center">
                                            @if ($usuario->estado == 1)
                                                <span class="badge badge-success">Activo</span>
                                            @else
                                                <span class="badge badge-danger">Inactivo</span>
                                            @endif
                                        </td>
                                        

                                        <td  class="d-flex justify-content-center">

                                            @if (!($usuario->deleted_at))
                                                <a href="{{ url('/admin/usuarios/' . $usuario->id ) }}"
                                                            class="btn btn-info"><i class="fas fa-eye"></i>
                                                            Ver</a>
                                                        <a href="{{ url('/admin/usuarios/' . $usuario->id . '/edit') }}"
                                                            class="btn btn-success"><i class="fas fa-pencil-alt"></i>
                                                            Editar</a>

                                                        <form action="{{ url('/admin/usuarios/' . $usuario->id) }}"
                                                            id="formulario{{ $usuario->id }}" method="POST"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"
                                                                onclick="preguntar{{ $usuario->id }}(event)">
                                                                <i class="fas fa-trash-alt"></i> Eliminar
                                                            </button>
                                                            
                                                        <script>
                                                            function preguntar{{ $usuario->id }}(event) {
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
                                                                        document.getElementById("formulario{{ $usuario->id }}").submit();
                                                                    }
                                                                });
                                                            }
                                                        </script>
                                                        </form>

                                                        @else
                                                        <form action="{{ url('/admin/usuarios/' . $usuario->id. '/restaurar') }}"
                                                          method="POST" id="formulario{{ $usuario->id }}" >
                                                          @csrf
                                                          <button type="submit" class="btn btn-warning btn-sm"
                                                              onclick="preguntar{{ $usuario->id }}(event)">
                                                              <i class="fas fa-save"></i> Restaurar usuario
                                                          </button>
                                                          <script>
                                                            function preguntar{{ $usuario->id }}(event) {
                                                                event.preventDefault();

                                                                Swal.fire({
                                                                    title: "Desea restaurar este reguistro",
                                                                    text: "",
                                                                    icon: "question",
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: "#3085d6",
                                                                    cancelButtonColor: "#d33",
                                                                    confirmButtonText: "Si, Restaurar"
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        Swal.fire({
                                                                            title: "Restaurado",
                                                                            text: "Se restauró Correctamente",
                                                                            icon: "success"

                                                                        });
                                                                        document.getElementById("formulario{{ $usuario->id }}").submit();
                                                                    }
                                                                });
                                                            }
                                                        </script>

                                                        </form>
                                            @endif

                                                    
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                "lengthMenu": "Mostrar _MENU_ Usuarios",
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

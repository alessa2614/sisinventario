@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 18pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/bienes') }}">Bienes</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                @if (isset($categoriaEncontrada))
                    Bienes de {{ $categoriaEncontrada->nombre }}
                @else
                    Listado de Bienes
                @endif
            </li>

        </ol>
    </nav>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card  card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <b>
                            @if (isset($categoriaEncontrada))
                                Bienes de {{ $categoriaEncontrada->nombre }}
                            @else
                                Bienes Registrados
                            @endif
                        </b>
                    </h3>
                    
                </div>
                
                <div class="card-body table-responsive">
                    <div class="card-tools">
                        <a class="btn btn-primary" href="{{ url('/admin/bienes/create') }}"><i class="fas fa-plus"></i> Crear nuevo</a>
                    </div>
                    <!-- Encabezado visible en la vista -->
                    <div class="reporte-encabezado text-center mb-4">
                        <h2 class="fw-bold mb-1">DIRECCIÓN REGIONAL DE EDUCACIÓN - PUNO</h2>
                        <h4 class="mb-1">UGEL - SAN ROMÁN</h4>
                        <h3 class="mb-1"><b>IES. "INCA GARCILASO DE LA VEGA"</b></h3>
                        <p class="text-muted"><i>Generado el {{ \Carbon\Carbon::now()->format('d/m/Y') }}</i></p>
                    </div>

                    <div class="text-center mb-4">
                    {{-- Botones Excel / PDF --}}
                    <a class="btn btn-success"
                        href="{{ isset($categoriaEncontrada)
                            ? route('reportes.bienes.categoria.excel', $categoriaEncontrada->nombre)
                            : route('reportes.bienes.excel') }}">Excel</a>

                    <a class="btn btn-danger"
                        href="{{ isset($categoriaEncontrada)
                            ? route('reportes.bienes.categoria.pdf', $categoriaEncontrada->nombre)
                            : route('reportes.bienes.pdf') }}">PDF</a>

                </div>

                    <!-- /.card-tools -->
                </div>

                <!-- /.card-header -->
                <div class="card-body  " style="display: block;">

                    <div class="card-body table-responsive " style="">
                        <table id="example1" class="table table-head-fixed text-nowrap  table-hover">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Codigo patrimonial</th>
                                    <th>Descripcion del Bien</th>
                                    <th>Area-Ubicacion del Bien</th>
                                    <th>Estado</th>
                                    <th>Fecha de adquisicion</th>
                                    <th>Nro de Documento</th>
                                    <th>Tipo de Documento</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Nro de serie</th>
                                    <th>Medidas</th>
                                    <th>Color</th>
                                    <th>Valor de adquisicion</th>
                                    <th>Devaluacion</th>
                                    <th>Responsable</th>
                                    <th>Observaciones</th>

                                    <th class="no-export" style="text-align: center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bienes as $bien)
                                    <tr>
                                        <td style="text-align: center">{{ $loop->iteration }}</td>
                                        <td>{{ $bien->codigo_patrimonial }}</td>
                                        <td>{{ $bien->descripcion }}</td>
                                        <td>{{ $bien->area?->nombre ?? 'Sin área' }}</td>
                                        <td>{{ $bien->estado?->nombre ?? 'Sin estado' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($bien->fecha_adquisicion)->format('d/m/Y') }}</td>
                                        <td>{{ $bien->numero_doc }}</td>
                                        <td>{{ $bien->tipo_documento }}</td>
                                        <td>{{ $bien->marca }}</td>
                                        <td>{{ $bien->modelo }}</td>
                                        <td>{{ $bien->serial }}</td>
                                        <td>{{ $bien->medidas }}</td>
                                        <td>{{ $bien->color }}</td>
                                        <td>S/. {{ $bien->valor_inicial }}</td>
                                        <td> {{ $bien->depreciacion }}</td>
                                        <td>{{ $bien->director?->nombre . ' ' . $bien->director?->apellido ?? 'Sin director' }}
                                        </td>
                                        <td>
                                            <span class="text-truncate d-inline-block" style="max-width: 100px;"
                                                title="{{ strip_tags($bien->observaciones) }}">
                                                {{ preg_replace('/\s+/', ' ', strip_tags($bien->observaciones)) }}
                                            </span>
                                        </td>


                                        <td style="text-align: center">
                                            <div class="btn-group" role="group">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-info" data-toggle="modal"
                                                    data-target="#ModalShow{{ $bien->id }}">
                                                    <i class="fas fa-eye"></i>Ver
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="ModalShow{{ $bien->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header"
                                                                style="background-color: #6da3dd; color: white;">
                                                                <h5 class="modal-title" id="exampleModalLabel">Datos del
                                                                    Bien</h5>
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
                                                                            <label for="codigo_patrimonial">Codigo
                                                                                patrimonial:</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">

                                                                                </div>
                                                                                <input type="text"
                                                                                    value="{{ old('codigo_patrimonial', $bien->codigo_patrimonial) }}"
                                                                                    class="card card-body bg-white shadow-sm"
                                                                                    id="codigo_patrimonial"
                                                                                    name="codigo_patrimonial" readonly>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="descripcion">Descripcion:</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">

                                                                                </div>
                                                                                <input type="text"
                                                                                    value="{{ old('descripcion', $bien->descripcion) }}"
                                                                                    class="card card-body bg-white shadow-sm"
                                                                                    id="descripcion" name="descripcion"
                                                                                    readonly>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="area_id">Area:</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">

                                                                                </div>
                                                                                <input type="text"
                                                                                    value="{{ old('area_id', $bien->area?->nombre ?? 'Sin área') }}"
                                                                                    class="card card-body bg-white shadow-sm"
                                                                                    id="area_id" name="area_id"readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="estado_id">Estado:</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">

                                                                                </div>
                                                                                <input type="text"
                                                                                    value="{{ old('estado_id', $bien->estado?->nombre ?? 'Sin estado') }}"
                                                                                    class="card card-body bg-white shadow-sm"
                                                                                    id="estado_id"
                                                                                    name="estado_id"readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="fecha_adquision">Fecha de
                                                                                adquision:</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">

                                                                                </div>
                                                                                <input type="text"
                                                                                    value="{{ \Carbon\Carbon::parse($bien->fecha_adquisicion)->format('d/m/Y') }}"
                                                                                    class="card card-body bg-white shadow-sm"
                                                                                    id="fecha_adquision"
                                                                                    name="fecha_adquision" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="numero_doc">Numero de
                                                                                documento:</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">

                                                                                </div>
                                                                                <input type="text"
                                                                                    value="{{ old('numero_doc', $bien->numero_doc) }}"
                                                                                    class="card card-body bg-white shadow-sm"
                                                                                    id="numero_doc" name="numero_doc"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="tipo_documento">Tipo de
                                                                                documento
                                                                                fuente:</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">

                                                                                </div>
                                                                                <input type="text"
                                                                                    value="{{ old('tipo_documento', $bien->tipo_documento) }}"
                                                                                    class="card card-body bg-white shadow-sm"
                                                                                    id="tipo_documento"
                                                                                    name="tipo_documento" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="marca">Marca:</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">

                                                                                </div>
                                                                                <input type="text"
                                                                                    value="{{ old('marca', $bien->marca) }}"
                                                                                    class="card card-body bg-white shadow-sm"
                                                                                    id="marca" name="marca"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="modelo">Modelo:</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">

                                                                                </div>
                                                                                <input type="text"
                                                                                    value="{{ old('modelo', $bien->modelo) }}"
                                                                                    class="card card-body bg-white shadow-sm"
                                                                                    id="modelo" name="modelo"readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="serial">Numero de
                                                                                Serie:</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">

                                                                                </div>
                                                                                <input type="text"
                                                                                    value="{{ old('serial', $bien->serial) }}"
                                                                                    class="card card-body bg-white shadow-sm"
                                                                                    id="serial" name="serial"readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="medidas">Medidas:</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">

                                                                                </div>
                                                                                <input type="text"
                                                                                    value="{{ old('medidas', $bien->medidas) }}"
                                                                                    class="card card-body bg-white shadow-sm"
                                                                                    id="medidas" name="medidas"readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="color">Color:</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">

                                                                                </div>
                                                                                <input type="text"
                                                                                    value="{{ old('color', $bien->color) }}"
                                                                                    class="card card-body bg-white shadow-sm"
                                                                                    id="color" name="color"readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="categoria_id">Categoria:</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">

                                                                                </div>
                                                                                <input type="text"
                                                                                    value="{{ old('categoria_id', $bien->categoria?->nombre ?? 'Sin categoria') }}"
                                                                                    class="card card-body bg-white shadow-sm"
                                                                                    id="categoria_id"
                                                                                    name="categoria_id"readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="valor_inicial">Precio de
                                                                                adquisicion:</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">

                                                                                </div>
                                                                                <input type="text"
                                                                                    value="S/ {{ old('valor_inicial', $bien->valor_inicial) }}"
                                                                                    class="card card-body bg-white shadow-sm"
                                                                                    id="valor_inicial"
                                                                                    name="valor_inicial"readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="depreciacion">Depreciacion:</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">

                                                                                </div>
                                                                                <input type="number"
                                                                                    value="S/ {{ old('depreciacion', $bien->depreciacion) }}"
                                                                                    class="card card-body bg-white shadow-sm"
                                                                                    id="depreciacion"
                                                                                    name="depreciacion"readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>



                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="director_id">Responsable del
                                                                                bien:</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">

                                                                                </div>
                                                                                <input type="text"
                                                                                    value="{{ old('director_id', $bien->director?->nombre . ' ' . $bien->director?->apellido ?? 'Sin director') }}"
                                                                                    class="card card-body bg-white shadow-sm"
                                                                                    id="director_id"
                                                                                    name="director_id"readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="observaciones">Observaciones:</label>
                                                                            <div class="card border rounded shadow-sm">
                                                                                <div class="card-body"
                                                                                    style="max-height: 200px; overflow-y: auto; background: #f8f9fa;">
                                                                                    @if (!empty($bien->observaciones))
                                                                                        {!! $bien->observaciones !!}
                                                                                    @else
                                                                                        <em class="text-muted">Sin
                                                                                            observaciones</em>
                                                                                    @endif
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
                                            <a href="{{ url('/admin/bienes/' . $bien->id . '/edit') }}"
                                                class="btn btn-success"><i class="fas fa-pencil-alt"></i>
                                                Editar</a>

                                            <form action="{{ url('/admin/bienes/' . $bien->id) }}"
                                                id="formulario{{ $bien->id }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="preguntar{{ $bien->id }}(event)">
                                                    <i class="fas fa-trash-alt"></i> Eliminar
                                                </button>
                                            </form>
                                            <script>
                                                function preguntar{{ $bien->id }}(event) {
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
                                                            document.getElementById("formulario{{ $bien->id }}").submit();
                                                        }
                                                    });
                                                }
                                            </script>
                    </div>
                    </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="17" class="text-center text-muted">
                            No hay bienes registrados en esta categoría
                        </td>
                    </tr>
                    @endforelse


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
         body {
                font-family: Arial, sans-serif;
                font-size: 12pt;
            }

            .reporte-encabezado {
                text-align: center;
                margin-bottom: 20px;
            }

            .reporte-encabezado img {
                margin-bottom: 10px;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }
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
        #example1_wrapper .dt-buttons {
            background-color: transparent;
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        #example1_wrapper .btn {
            color: #fff;
            border-radius: 4px;
            padding: 5px 15px;
            font-size: 14px;
        }

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
            color: #fff;
            border: none;
        }

        #example1 th {
            white-space: normal !important;
            word-wrap: break-word;
            max-width: 120px;
            text-align: center;
            vertical-align: middle;
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
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "language": {
                    "search": "Buscador:",
                    "emptyTable": "No hay informacion",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Bienes",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Bienes",
                    "infoFiltered": "(Filtrado de _MAX_ total Bienes)",
                    "lengthMenu": "Mostrar _MENU_ Bienes",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
            });
        });
    </script>
@stop

@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 18pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Movimientos de Bienes</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="text" id="buscador" class="form-control"
                placeholder="Buscar por código, serie o descripción...">
        </div>
    </div>

    <!-- Tabla de Bienes -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><b>Resultados de Búsqueda / Bienes Registrados</b></h3>
        </div>
        <div class="card-body table-responsive">
            <table id="tabla-bienes" class="table  table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nro</th>
                        <th>Código Patrimonial</th>
                        <th>Descripción del Bien</th>
                        <th>Área Actual</th>
                        <th>Estado</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>N° Serie</th>
                        <th>Director</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bienes as $bien)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bien->codigo_patrimonial }}</td>
                            <td>{{ $bien->descripcion }}</td>
                            <td>{{ $bien->area?->nombre ?? 'Sin área' }}</td>
                            <td>{{ $bien->estado?->nombre ?? 'Sin estado' }}</td>
                            <td>{{ $bien->marca }}</td>
                            <td>{{ $bien->modelo }}</td>
                            <td>{{ $bien->serial }}</td>
                            <td>{{ ($bien->director?->nombre ?? '') . ' ' . ($bien->director?->apellido ?? '') }}</td>
                            <td>
                                <button class="btn btn-primary btn-mover" data-id="{{ $bien->id }}" data-toggle="modal"
                                    data-target="#modalMovimiento">Mover</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal de Movimiento -->
    <div class="modal fade" id="modalMovimiento" tabindex="-1" aria-labelledby="modalMovimientoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formMovimiento" method="POST" action="">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="modalMovimientoLabel">Registrar Movimiento</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="bien_id" id="bien_id">
                        <div class="form-group">
                            <label for="area_nueva">Nueva Área:</label>
                            <select name="area_nueva" id="area_nueva" class="form-control" required>
                                <option value="">-- Seleccionar --</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="observaciones">Observaciones:</label>
                            <textarea name="observaciones" id="observaciones" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Registrar Movimiento</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Historial de Movimientos -->
    <div class="card card-primary mt-4">
        <div class="card-header">
            <h3 class="card-title"><b>Historial de Movimientos de Bienes</b></h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3">
                    <select id="filtro-anio" class="form-control">
                        <option value="">Todos los años</option>
                        @foreach ($anios as $anio)
                            <option value="{{ $anio }}" {{ $anioSeleccionado == $anio ? 'selected' : '' }}>
                                {{ $anio }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mt-2 mt-md-0">
                    <span><b>Total movimientos: {{ $totalMovimientos }}</b></span>
                </div>
            </div>

            <div class="table-responsive">
            <table id="tabla-movimientos" class="table  table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nro</th>
                        <th>Fecha de Movimiento</th>
                        <th>Código Patrimonial</th>
                        <th>Descripción del Bien</th>
                        <th>N° Serie</th>
                        <th>Área Anterior</th>
                        <th>Área Nueva</th>
                        <th>Director Responsable</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movimientosFiltrados as $mov)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mov->fecha }}</td>
                            <td>{{ $mov->codigo_patrimonial }}</td>
                            <td>{{ $mov->descripcion }}</td>
                            <td>{{ $mov->serial }}</td>
                            <td>{{ $mov->area_anterior }}</td>
                            <td>{{ $mov->area_nueva }}</td>
                            <td>{{ $mov->director ?? 'Sin director' }}</td>
                            <td>{{ $mov->observaciones ?? '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Inicializar DataTables
            var tablaBienes = $('#tabla-bienes').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 25],
                "language": {
                    "search": "Buscar:",
                    "emptyTable": "No hay bienes registrados",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "columnDefs": [{
                        "width": "5%",
                        "targets": 0
                    }, // Nro
                    {
                        "width": "9%",
                        "targets": 1
                    }, // Código Patrimonial
                    {
                        "width": "23%",
                        "targets": 2
                    }, // Descripción del Bien
                    {
                        "width": "10%",
                        "targets": 3
                    }, // Área Actual
                    {
                        "width": "9%",
                        "targets": 4
                    }, // Estado
                    {
                        "width": "9%",
                        "targets": 5
                    }, // Marca
                    {
                        "width": "8%",
                        "targets": 6
                    }, // Modelo
                    {
                        "width": "10%",
                        "targets": 7
                    }, // Serie
                    {
                        "width": "15%",
                        "targets": 8
                    }, // Director
                    {
                        "width": "12%",
                        "targets": 9
                    } // Acciones
                ],
                "autoWidth": false // importante: evita que DataTables reasigne tamaños automáticamente
            });


            var tablaMovimientos = $('#tabla-movimientos').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 25],
                "language": {
                    "search": "Buscar:",
                    "emptyTable": "No hay movimientos registrados",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });

            // Filtrar por año
            $('#filtro-anio').on('change', function() {
                var anio = $(this).val();
                window.location.href = "{{ route('movimientos.index') }}" + (anio ? '?anio=' + anio : '');
            });

            // Modal de movimiento
            $(document).on('click', '.btn-mover', function() {
                let id = $(this).data('id'); // id del bien
                let baseUrl = "{{ url('admin/movimientos') }}";
                $('#formMovimiento').attr('action', baseUrl + '/' + id + '/store');
                $('#modalMovimiento').modal('show');
            });

            // Buscador en tiempo real
            $('#buscador').on('keyup', function() {
                let query = $(this).val().trim();

                $.getJSON("{{ url('admin/movimientos/buscar') }}", {
                    q: query
                }, function(data) {
                    tablaBienes.clear().draw();
                    if (data.status === 'ok') {
                        $.each(data.bienes, function(i, bien) {
                            let btn =
                                '<button class="btn btn-primary btn-mover" data-id="' + bien
                                .id +
                                '" data-toggle="modal" data-target="#modalMovimiento">Mover</button>';

                            tablaBienes.row.add([
                                i + 1,
                                bien.codigo_patrimonial ?? '',
                                bien.descripcion ?? '',
                                bien.area ?? 'Sin área',
                                bien.estado ?? 'Sin estado',
                                bien.marca ?? '',
                                bien.modelo ?? '',
                                bien.serial ?? '',
                                bien.director ?? '',
                                btn
                            ]).draw(false);
                        });
                    }
                });
            });
        });
    </script>
@stop

@extends('adminlte::page')

@section('content_header')
    <nav aria-label="breadcrumb" style="font-size: 18pt">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bajas de Bienes</li>
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


    <div class="card  card-primary">
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
                        <th>Área-Ubicacion</th>
                        <th>Estado</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>N° Serie</th>
                        <th>Color</th>
                        <th>Director Responsable</th>
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
                            <td>{{ $bien->color }}</td>
                            <td>{{ ($bien->director?->nombre ?? '') . ' ' . ($bien->director?->apellido ?? '') }}</td>
                            <td>
                                @php
                                    $yaBaja = $bien->bajas()->exists() || $bien->estado?->nombre === 'Malo';
                                @endphp

                                @if ($yaBaja)
                                    <span class="badge badge-secondary">Ya dado de baja</span>
                                @else
                                    <button class="btn btn-danger btn-baja" data-id="{{ $bien->id }}"
                                        data-toggle="modal" data-target="#modalBaja">Dar de Baja</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal de Baja -->
    <div class="modal fade" id="modalBaja" tabindex="-1" aria-labelledby="modalBajaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formBaja" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="modalBajaLabel">Dar de Baja al Bien</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="bien_id" id="bien_id">
                        <div class="form-group">
                            <label for="motivo">Motivo de Baja:</label>
                            <textarea name="motivo" id="motivo" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="director_id">Responsable que autoriza:</label>
                            <select name="director_id" id="director_id" class="form-control" required>
                                <option value="">-- Seleccionar --</option>
                                @foreach ($directores as $director)
                                    <option value="{{ $director->id }}">{{ $director->nombre }} {{ $director->apellido }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="observaciones">Observaciones:</label>
                            <textarea name="observaciones" id="observaciones" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Dar de Baja</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="card  card-danger mt-4">
        <div class="card-header">
            <h3 class="card-title"><b>Historial de Bajas de Bienes</b></h3>
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
                    <span><b>Total bienes dados de baja: {{ $totalBienes }}</b></span>
                </div>
            </div>

            <div class="table-responsive">

            <table id="tabla-bajas" class="table  table-hover">
                <thead>
                    <tr>
                        <th>Nro</th>
                        <th>Fecha de Baja</th>
                        <th>Código Patrimonial</th>
                        <th>Descripción del Bien</th>
                        <th>Área-Ubicacion</th>
                        <th>Estado</th>
                        <th>N° Serie</th>
                        <th>Director Responsable</th>
                        <th>Motivo de Baja</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bajas as $index => $baja)
                        @if ($baja->fecha_baja || (!$anioSeleccionado && $baja->estado === 'Malo'))
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $baja->fecha_baja }}</td>
                                <td>{{ $baja->codigo_patrimonial }}</td>
                                <td>{{ $baja->descripcion }}</td>
                                <td>{{ $baja->area }}</td>
                                <td>{{ $baja->estado }}</td>
                                <td>{{ $baja->serial }}</td>
                                <td>{{ $baja->director_baja ?? 'Sin director' }}</td>
                                <td>{{ $baja->motivo_baja }}</td>
                                <td>{{ $baja->observaciones ?? '' }}</td>
                            </tr>
                        @endif
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
                    },
                    {
                        "width": "9%",
                        "targets": 1
                    },
                    {
                        "width": "20%",
                        "targets": 2
                    },
                    {
                        "width": "10%",
                        "targets": 3
                    },
                    {
                        "width": "8%",
                        "targets": 4
                    },
                    {
                        "width": "8%",
                        "targets": 5
                    },
                    {
                        "width": "8%",
                        "targets": 6
                    },
                    {
                        "width": "8%",
                        "targets": 7
                    },
                    {
                        "width": "8%",
                        "targets": 8
                    },
                    {
                        "width": "10%",
                        "targets": 9
                    },
                    {
                        "width": "8%",
                        "targets": 10
                    }
                ],
                "autoWidth": false
            });


            var tablaBajas = $('#tabla-bajas').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 25],
                "language": {
                    "search": "Buscar:",
                    "emptyTable": "No hay bajas registradas",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });

            // Filtrar por año
            $('#filtro-anio').on('change', function() {
                var anio = $(this).val();
                window.location.href = "{{ route('bajas.index') }}" + (anio ? '?anio=' + anio : '');
            });

            // Modal de baja
            $(document).on('click', '.btn-baja', function() {
                const id = $(this).data('id');
                const action = "{{ url('/admin/bajas') }}/" + id + "/baja";
                $('#formBaja').attr('action', action);
                $('#modalBaja').modal('show');
            });

            // Buscador en tiempo real
            $('#buscador').on('keyup', function() {
                let query = $(this).val().trim();

                $.getJSON("{{ url('admin/bajas/buscar') }}", {
                    q: query
                }, function(data) {
                    tablaBienes.clear().draw();
                    if (data.status === 'ok') {
                        $.each(data.bienes, function(i, bien) {
                            let btn = '';
                            if (!bien.ya_baja && bien.estado != 'Malo') {
                                btn = '<button class="btn btn-danger btn-baja" data-id="' +
                                    bien.id +
                                    '" data-toggle="modal" data-target="#modalBaja">Dar de Baja</button>';
                            } else {
                                btn =
                                    '<span class="badge badge-secondary">Ya dado de baja</span>';
                            }

                            tablaBienes.row.add([
                                i + 1,
                                bien.codigo_patrimonial ?? '',
                                bien.descripcion ?? '',
                                bien.area ?? 'Sin área',
                                bien.estado ?? 'Sin estado',
                                bien.marca ?? '',
                                bien.modelo ?? '',
                                bien.serial ?? '',
                                bien.color ?? '',
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
